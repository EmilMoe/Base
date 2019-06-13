<?php

namespace EmilMoe\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

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
        'active' => 'array',
        'link'   => 'array',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'module',
        'text',
        'priority',
        'link',
        'active',
        'icon',
    ];

    /**
     * Register menu item.
     *
     * @param string $text
     * @param string $icon
     * @param string $link
     * @param array $active
     * @param int $priority
     * @return void
     */
    public static function registerItem(string $text, string $icon, array $link, array $active, int $priority = null): void
    {
        $module = strtolower(explode('\\', debug_backtrace()[1]['class'])[1]);

        Menu::updateOrCreate([
            'module' => $module,
            'text'   => $text
        ], [
            'module'   => $module,
            'text'     => $text,
            'priority' => $priority ?? 100,
            'icon'     => $icon,
            'link'     => $link,
            'active'   => $active,
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
        return Cache::remember('base.menu', env('APP_ENV') === 'production' ? 600 : 0, function() use ($columns) {
            return parent::all($columns);
        });
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('priority', 'desc');
        });
    }
}