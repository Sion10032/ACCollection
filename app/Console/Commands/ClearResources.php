<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Model\Resource;
use App\Model\Favorite;

class ClearResources extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear-resources';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear resources that no user favorited.';

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
        $resources = Resource::all();
        foreach ($resources as &$res) {
            if ($res->favorite->isEmpty()) {
                echo 'Delete ', $res['name'], ' ', $res['bid'], ".\n"; 
                $res->delete();
            }
        }
    }
}
