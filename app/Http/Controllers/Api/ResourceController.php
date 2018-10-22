<?php

namespace App\Http\Controllers\Api;

use App\Model\Resource;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResourceController extends Controller
{
    public function index()
    {
        return Resource::all();
    }

    public function show($id)
    {
        return Resource::find($id);
    }

    public function store(Request $request)
    {
        $res = Resource::create($request->all());
        
        if ($res->save()) {
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
        $res = Resource::find($id);
        $res->update($request->all());

        return $res;
    }

    public function delete(Request $request, $id)
    {
        $res = Resource::find($id);
        
        if (isset($res)) {
            $res->delete();
            return response([
                "message" => "Delete Success", 
                "status_code" => 200,
            ], 200);
        }
        else {
            return response([
                "message" => "Delete Failed", 
                "status_code" => 404,
            ], 404);
        }

        
    }
}
