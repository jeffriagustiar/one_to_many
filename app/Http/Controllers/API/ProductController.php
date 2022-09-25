<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    function add(Request $request){
        $uuid = $request->uuid;
        $name = $request->name;
        $type = $request->type;
        $price = $request->price;
        $qty = $request->quantity;

        $data = Product::create([
            'uuid' => $request->uuid,
            'name' => $request->name,
            'type' => $request->type,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);

        if(!$data){
            return response()->json([
                'status' => 500,
                'msg' => 'somting wrong'
            ]);
        }

        return response()->json([
            'status' => 200,
            'msg' => 'success add data',
            'data' => $data
        ]);
    }

    function update(Request $request){
        if (Auth::user()->level != 'admin') {
            return response()->json([
                'msg' => 'Unauthorized'
            ]);
        }
        $id = $request->input('uuid');

        $form = $request->all();

        $data = Product::where('uuid',$id);
        $data->update($form);

        return response()->json([
            'status' => 200,
            'msg' => 'success update data',
            'data' => $data->get()
        ]);


    }

    function delete(Request $request){
        if (Auth::user()->level != 'admin') {
            return response()->json([
                'msg' => 'Unauthorized'
            ]);
        }
        $id = $request->input('uuid');

        $data = Product::where('uuid',$id);
        $data->delete();

        return response()->json([
            'msg' => 'success delete data'
        ]);
    }

    function all(Request $request){
        $id = $request->input('uuid');
        $limit = $request->input('limit');
        $order = $request->input('order');

        $data = Product::query();
        $a='';

        if ($id) {
            $data->where('uuid',$id);
            $a='test';
        }

        $data->limit($limit)->orderBy('uuid',$order);



        return response()->json([
            'status' => 200,
            'data' => $data->get(),
            'a'=> $a
        ]);
    }
}
