<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use App\Product;
use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\Rest\RestRepository;
use App\Http\Requests\OrderRequest;

class OrderController extends Controller
{
    /**
     * @var RestRepository
     */
    private $rest;

    public function __construct(Order $model) {
        $this->rest = new RestRepository($model);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $response = $this->rest->getModel()->latest()->get();
        return $this->response(
            "Order History Successfully Fetched.",
            $response,
            Response::HTTP_OK
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        //
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['order_number'] = uniqid();
        $response = $this->rest->getModel()->create($data);
        $this->saveOrderDetails($response->id, $data['order']);
        return $this->response(
            "Transaction Successful.",
            $response,
            Response::HTTP_OK
        );

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $response = $this->rest->getModel()
            ->with(['discountCoupon','hasManyOrderDetails' => function($q) {
                $q->with('product');
            }])
            ->find($id);

		return $this->response(
			"Order Successfully Fetch.",
			$response,
			Response::HTTP_OK
		);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    private function saveOrderDetails($id, $data) {
        foreach($data as $order) {
            $details = [
                'product_id' => $order['product_id'],
                'order_id' => $id,
                'price' => $order['product']['price'],
                'quantity' => $order['quantity'],
                'total' => $order['product']['price'] * $order['quantity'],
            ];
            OrderDetail::create($details);
            $product = Product::find($order['product_id']);
            $product->quantity = $product->quantity - $order['quantity'];
            $product->save();
        }
        Cart::whereUserId(auth()->user()->id)->delete();
    }
}
