<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{

    public function index()
    {
        $products = Product::all();
        $orders = Order::all();
        return view('dashboard.orders.index', ['products' => $products, 'orders' => $orders]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {

       // return $request->all();

        DB::transaction(function () use ($request) {

            $orders = new Order;
            $orders->customer_name = $request->customer_name;
            $orders->customer_phone = $request->customer_phone;
            $orders->save();
            $order_id = $orders->id;

            for ($i = 0; $i < count($request->product_id); $i++) {
                $order_details = new OrderDetail;
                $order_details->order_id = $order_id;
                $order_details->product_id = $request->product_id[$i];
                $order_details->unit_price = $request->unit_price[$i];
                $order_details->quantity = $request->quantity[$i];
                $order_details->discount = $request->discount[$i] ? 0 : 'null';
                $order_details->amount = $request->amount[$i];
                $order_details->save();
            }

            $transaction = new Transaction;
            $transaction->order_id = $order_id;
            $transaction->user_id = auth()->user()->id;
            $transaction->balance =$request->balance;
            $transaction->paid_amount =$request->paid_amount;
            $transaction->payment_method =$request->payment_method;
            $transaction->transaction_amount =$order_details->amount;
            $transaction->transaction_date =date('Y-m-d');
            $transaction->save();


            $products = Product::all();
            $order_details = OrderDetail::where('order_id', $order_id)->get();
            $customer_orders = Order::where('id', $order_id)->get();

            return view('dashboard.orders.index',
            [
                'products'=>$products,
                'order_details'=>$order_details,
                'customer_orders'=>$customer_orders,
            ]
            );

        });

        return back()->with("Product Orders Failed to insert! Please check your input and try again");
    }


    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
