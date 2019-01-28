<?php

namespace App\Http\Controllers\Api;

use App\Model\Favorite;
use App\Model\Resource;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index($uid)
    {
        $favs = Favorite::where('userId', $uid)->get();
        $re = [];
        foreach ($favs as $fav) {
            $res = Resource::find($fav['resId']);
            array_push($re, [
                'id' => $fav['id'],
                'bid' => $res['bid'],
                'name' => $res['name'],
                'lastChapter' => $fav['lastChapter'],
            ]);
        }

        return $re;
    }

    public function show($uid, $id)
    {
        if (!$this->validateUser($uid))
            return response([
                'message' => '403 Forbidden',
                'status_code' => 403
            ], 403);

        return Favorite::find($id);
    }

    public function store(Request $request, $uid)
    {
        if (!$this->validateUser($uid))
            return response([
                'message' => '403 Forbidden',
                'status_code' => 403
            ], 403);

        $bid = $request->all()['bid'];
        $res = Resource::firstOrCreate(
            ['bid' => $bid],
            [
                'name' => $request->all()['name'],
                'lastChapter' => $request->all()['lastChapter']
            ]
        );
        
        $fav = Favorite::create([
            'lastChapter' => $res->lastChapter,
            'userId' => Auth::user()->id,
            'resId' => $res->id,
        ]);

        if ($fav->save()) {
            return response([
                "message" => 'Success',
                "status_code" => 201,
            ], 201);
        }
        else {
            return response([
                'message' => 'Failed', 
                'status_code' => 404,
            ], 404);
        }
    }

    public function update(Request $request, $uid, $id)
    {
        if (!$this->validateUser($uid))
            return response([
                'message' => '403 Forbidden',
                'status_code' => 403
            ], 403);

        $fav = Favorite::find($id);
        $fav->update($request->all());

        return $fav;
    }

    public function delete(Request $request, $uid, $id)
    {
        if (!$this->validateUser($uid))
            return response([
                'message' => '403 Forbidden',
                'status_code' => 403
            ], 403);

        $favorite = Favorite::findOrFail($id);
        $favorite->delete();

        return response([
            'message' => 'Delete Success', 
            'status_code' => 200,
        ], 200);
    }

    protected function validateUser($uid)
    {
        if ($uid == strval(Auth::user()->id))
            return true;
        else
            return false;
    }
}
