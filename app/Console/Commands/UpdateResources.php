<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Model\Resource;

use App\Helper\SMHCrawer;

class UpdateResources extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update-resources';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Resources information';

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
        $newInfos = json_decode(SMHCrawer::latest(), true);
        // print_r($newInfos);

        foreach ($resources as &$res) {
            $book = UpdateResources::findBook($res['bid'], $newInfos);
            $res->update([
                'status' => $book['status'],
                'update' => $book['update']
            ]);
            echo $book['name'] . ' ' . $book['bid'] . ' update success.', "\n";
        }

        // foreach ($resources as &$res) {
        //     // $newInfo = json_decode(SMHCrawer::book($res['bid']), true);
        //     // print_r($newInfo);
        //     $res->update([
        //         'name' => $newInfo['name'],
        //         'author' => join(',', $newInfo['author']),
        //         'status' => $newInfo['status'],
        //         'update' => $newInfo['update']
        //     ]);
        //     echo $newInfo['name'] . ' ' . $newInfo['bid'] . ' update success.', "\n";
        // }
    }

    private function findBook($bid, $books)
    {
        $res = NULL;
        foreach ($books as $book)
            if ($book['bid'] == $bid)
                return $book;
        return NULL;
    }
}
