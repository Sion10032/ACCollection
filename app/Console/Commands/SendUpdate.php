<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Mail;

use App\Model\User;
use App\Model\Favorite;
use App\Model\Resource;

class SendUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send updated items to users';

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
        $users = User::all();

        foreach ($users as $user) {
            $updatedItems = [];
            foreach ($user->favorite as $fav)
                if ($fav->resource['update'] == date('Y-m-d'))
                    array_push($updatedItems, $fav->resource);
            if (!empty($updatedItems)) {
                Mail::send(
                    'updatemail', 
                    [
                        'user' => $user, 
                        'updatedItems' => $updatedItems
                    ],
                    function($message) use($user){
                        $to = $user->email;
                        $message
                            ->to($to)
                            ->subject('更新提醒');
                    }
                );
            }
        }
    }
}
