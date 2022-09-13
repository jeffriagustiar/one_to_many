<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CrudApiController extends Controller
{
    function all(Request $request){
        $name = $request->input('name');
        $email = $request->input('email');
        // $name='test3';
        
        $data = User::query();

        if ($name || $email) 
            $data->where('name','like','%'.$name.'%')
                    ->where('email','like','%'.$email.'%');

        return response()->json([
            'status' => 200,
            'data' => $data->get()
        ]);
    }

    function register(Request $request){
       $data = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => $request->level,
        ]);

        return response()->json([
            'status' => 200,
            'data' => $data
        ]);
    }
}
