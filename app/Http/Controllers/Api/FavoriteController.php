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
                'author' => explode(',', $res['author']),
                'status' => $res['status'],
                'update' => $res['update'],
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
        $res = Resource::updateOrCreate(
            ['bid' => $bid],
            [
                'name' => $request->all()['name'],
                'lastChapter' => $request->all()['lastChapter'],
                'author' => join(',', $request->all()['author']),
                'status' => $request->all()['status'],
                'update' => $request->all()['update']
            ]
        );
        
        $fav = Favorite::create([
            'lastChapter' => 0,
            'userId' => $uid,
            'resId' => $res->id,
        ]);

        if ($fav->save()) {
            return response([
                "message" => 'Success',
                "status_code" => 201,
                "data" => $fav,
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

        return response($fav);
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
