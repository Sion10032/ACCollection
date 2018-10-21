<?php

namespace App\Http\Controllers\Api;

use App\Model\Favorite;

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
        $fav = Favorite::create([
            'lastChapter' => $request->all()['lastChapter'],
            'userId' => Auth::user()->id,
            'resId' => $request->all()['resId'],
        ]);

        if ($fav->save()) {
            return response([
                "message" => "Success",
                "status_code" => 201,
            ]);
        }
        else {
            return response([
                "message" => "Failed", 
                "status_code" => 404,
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $fav = Favorite::findOrFail($id);
        $fav->update($request->all());

        return $fav;
    }

    public function delete(Request $request, $id)
    {
        $favorite = Favorite::findOrFail($id);
        $favorite->delete();

        return 204;
    }
}
