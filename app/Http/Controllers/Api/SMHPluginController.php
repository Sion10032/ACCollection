<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Helper\SMHCrawer;

class SMHPluginController extends Controller
{
    public function search($name) {
        return SMHCrawer::search($name);
    }

    public function book($bid){
        return SMHCrawer::book($bid);
    }

    public function chapter($bid, $cid){
        return SMHCrawer::chapter($bid, $cid);
    }
}
