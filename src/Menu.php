<?php

namespace EmilMoe\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use EmilMoe\Permission\Permission;
use Illuminate\Support\Facades\Event;

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

        $menu = Menu::withoutGlobalScope('permitted')->updateOrCreate([
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
        ]);

        $menu->touch();

        $menu->permissions()->detach();
        $menu->permissions()->attach(Permission::whereIn('key', $permissions)->pluck('id'));
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
                $builder->whereDoesntHave('permissions');
                return;
            }

            if (Auth::user()->is_admin) {
                return;
            }

            $builder->whereHas('permissions', function($query) {
                    $query->whereIn('key', Auth::user()->permissions());
                })
                ->orWhereDoesntHave('permissions');
        });
    }

    /**
     * Permissions required to view the menu. Null means no requirements.
     *
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'base_menu_permission', 'base_menu_id')
            ->withTimestamps();
    }
}