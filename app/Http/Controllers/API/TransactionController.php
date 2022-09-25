<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Product;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    function transaction(Request $request){
        if (Auth::user()->level == 'admin') {
            return response()->json([
                'msg' => 'error unauthrized'
            ]);
        }

        $uuid = $request->uuid;
        $product_id = $request->product_id;
        $amount = $request->amount;

        $product = Product::where('id',$product_id)->first();

        if (!$product) {
            $data = 'no result';
            $msg = 'No Data Result';
        }elseif($product->quantity < $amount){
            $data = $product;
            $msg = 'Not enough stock';
        }else{
            $pajak = $product->price * 0.1;
            $admin = ($product->price * 0.05)+$pajak;
            $total = ($amount * $product->price)+$pajak+$admin;
    
            $data = [
                'uuid' => $uuid,
                'user_id' => Auth::user()->id,
                'product_id' => $product_id,
                'amount' => $amount,
                'tax' => $pajak,
                'admin_fee' => $admin,
                'total' => $total
            ];

            $sisa = $product->quantity - $amount;
            
            Transaction::create($data);
            $product->update(['quantity' => $sisa]);
            $msg = 'Transaction success';

        }


        return response()->json([
            'status' => 200,
            'msg' => $msg,
            'data' => $data
        ]);
    }

    function all(Request $request){
        $id = $request->input('uuid');
        $limit = $request->input('limit');
        $order = ($request->input('order') == null) ? 'asc':$request->input('order');

        $data = Transaction::with(['product','user']);

        if(Auth::user()->level == 'admin'){
            if ($id) {
                $data->where('uuid',$id);
            }
        }
        if(Auth::user()->level != 'admin'){
            $data->whereHas('user', function ($q){
                $q->where('id',Auth::user()->id);
            });
            if ($id) {
                $data->where('uuid',$id);
            }
        }
        $data->limit($limit)->orderBy('uuid',$order);
        
        return response()->json([
            'status' => 200,
            'data' => $data->get()
        ]);
    }
}
