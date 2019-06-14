<?php

namespace EmilMoe\Base\Console\Commands;

use Illuminate\Console\Command;
use EmilMoe\Base\Menu;
use Carbon\Carbon;

class Cleanup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'base:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update menu entries.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        event('base.menu.update', Menu::class);
        Menu::where('updated_at', '<', Carbon::now()->subMinutes(15))->delete();
    }
}
