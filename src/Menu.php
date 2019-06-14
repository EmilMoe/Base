<?php

namespace EmilMoe\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Collection;

class Menu extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'base_menu';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'active'      => 'array',
        'link'        => 'array',
        'permissions' =>  'array',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'module',
        'key',
        'text',
        'priority',
        'link',
        'active',
        'icon',
        'permissions',
    ];

    /**
     * Register menu item.
     *
     * @param int $key
     * @param string $text
     * @param string $icon
     * @param string $link
     * @param array $active
     * @param int $priority
     * @return void
     */
    public static function registerItem(int $key, string $text, string $icon, array $link, array $active, array $permissions = [], int $priority = null): void
    {
        if (! Schema::hasTable(with(new static)->getTable())) {
            return;
        }

        $module = strtolower(explode('\\', debug_backtrace()[1]['class'])[1]);

        Menu::withoutGlobalScope('permitted')->updateOrCreate([
            'module' => $module,
            'key'     => $key,
        ], [
            'module'      => $module,
            'key'         => $key,
            'text'        => $text,
            'priority'    => $priority ?? 100,
            'icon'        => $icon,
            'link'        => $link,
            'active'      => $active,
            'permissions' => $permissions,
        ]);
    }

    /**
     * Get all of the models from the database.
     *
     * @param  array|mixed  $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function all($columns = ['*'])
    {
        return Cache::remember('base.menu.'. Auth::id(), env('APP_ENV') === 'production' ? 600 : 0, function() use ($columns) {
            return parent::all($columns);
        });
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('priority', 'desc');
        });

        static::addGlobalScope('permitted', function (Builder $builder) {
            if (! Auth::check()) {
                $builder->where('permissions', '[]');
                return;
            }

            $builder->where(function ($query) {
                $query->where('permissions', '[]');

                collect(Auth::user()->permissions())->each(function ($permission) use ($query) {
                    $query->orWhere('permissions', 'LIKE', '%"'. $permission .'"%');
                });
            });
        });
    }
}