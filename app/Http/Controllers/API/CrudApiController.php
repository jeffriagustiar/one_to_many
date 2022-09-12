<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class CrudApiController extends Controller
{
    function all(Request $request){
        $name = $request->input('name');
        // $name='test3';
        
        $data = User::query();

        if ($name) 
            $data->where('name','like','%'.$name.'%');

        return response()->json([
            'status' => 200,
            'data' => $data->get()
        ]);
    }
}
