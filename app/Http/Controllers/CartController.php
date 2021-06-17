<?php

namespace App\Http\Controllers;

use App\Cart;
use App\DiscountCoupon;
use App\Repositories\Rest\RestRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CartRequest;

class CartController extends Controller
{
    /**
     * @var RestRepository
     */
    private $rest;

    public function __construct(Cart $model) {
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
        $response = $this->getCarts()->get();
        return $this->response(
            "Cart Count Successfully Added.",
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
    public function store(CartRequest $request)
    {
        //
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $cart = $this->getCarts()->whereProductId($data['product_id'])->first();
        if($cart) {
            $data['quantity'] += $cart->quantity;
            $this->rest->update($data, $cart->id);
            $response = $this->rest->getModel()->find($cart->id);
        } else {
            $response = $this->rest->getModel()->create($data);
        }

        return $this->response(
            "Cart Successfully Added.",
            $response,
            Response::HTTP_OK
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = $this->rest->show($id);

		return $this->response(
			"Product Successfully Fetch.",
			$response,
			Response::HTTP_OK
		);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    public function getCartCount() {
        $response = $this->getCarts()->count();
        return $this->response(
            "Cart Count Successfully Added.",
            $response,
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        //
        $this->rest->delete($id);
        return $this->response(
            "Successfully Deleted.",
            '',
            Response::HTTP_OK
        );
    }

    private function getCarts() {
        return $this->rest->getModel()->with('product')->whereUserId(auth()->user()->id);
    }

    public function checkCoupon() {
        $check_coupon = $this->getCarts()->where('discount_coupons_id', '!=', null)->count();
        $coupon = $this->rest->getModel()->with('product')
            ->where('discount_coupons_id', '!=', null)
            ->whereUserId(auth()->user()->id)
            ->first();
        $response = [
            'discount' => $coupon != null ? DiscountCoupon::whereId($coupon->discount_coupons_id)->first()->discount : 0,
            'coupon_count' => $check_coupon
        ];

        return $this->response(
            "Successfully Deleted.",
            $response,
            Response::HTTP_OK
        );
    }

    public function useCoupon(Request $request) {
        $data = $request->all();
        $checkCoupon = DiscountCoupon::whereCode($data['code'])->first();
        if($checkCoupon){
            $update = $this->getCarts()->get();
            $update->each(function ($rr) use ($checkCoupon) {
                $rr->discount_coupons_id = $checkCoupon->id;
                $rr->save();
            });
            return $this->response(
                "Successfully Deleted.",
                $checkCoupon,
                Response::HTTP_OK
            );
        } else {
            return $this->response(
                "Something went wrong.",
                "Invalid Coupon Code.",
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }
}
