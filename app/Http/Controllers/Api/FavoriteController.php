<?php

namespace App\Http\Controllers\Api;

use App\Model\Favorite;
use App\Model\Resource;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        return Favorite::where('userId', Auth::user()->id)->get();
    }

    public function show($id)
    {
        return Favorite::find($id);
    }

    public function store(Request $request)
    {
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
                "message" => "Success",
                "status_code" => 201,
            ], 201);
        }
        else {
            return response([
                "message" => "Failed", 
                "status_code" => 404,
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $fav = Favorite::find($id);
        $fav->update($request->all());

        return $fav;
    }

    public function delete(Request $request, $id)
    {
        $favorite = Favorite::findOrFail($id);
        $favorite->delete();

        return response([
            "message" => "Delete Success", 
            "status_code" => 200,
        ], 200);
    }
}
