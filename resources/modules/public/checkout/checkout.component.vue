<template>
	<div class="container m-5 p-5 rounded mx-auto bg-light shadow">
         <!-- Checkout -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <label class="h4">Order Details</label>
                    <table class="table table-hover">
                        <thead>
                            <tr class="h5">
                                <th>Product</th>
                                <th>Quantity</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(value, key) in data" :key="key">
                                <td class="col-l-8 col-md-6">
                                <div class="media">

                                    <div class="media-body">
                                        <h4 class="media-heading"><a href="#">{{value.product.name}}</a></h4>
                                        <span>Stocks: </span><span class="text-success h6"><strong>{{value.product.quantity}}</strong></span>
                                    </div>
                                </div></td>
                                <td class="col-l-1 col-md-1" style="text-align: center">
                                <input type="text" @keyup="getTotal(value.product.price, value.quantity,key)" class="form-control" v-model="value.quantity"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                </td>
                                <td class="col-l-1 col-md-1 text-left"><strong>₱ {{value.product.price}}</strong></td>
                                <td class="col-l-1 col-md-1 text-left"><strong>₱ {{getTotal(value.product.price, value.quantity,key)}}</strong></td>
                                <td class="col-l-1 col-md-1">
                                <button type="button" class="btn btn-danger" @click="removeItem(value.id)">
                                    <span class="glyphicon glyphicon-remove"></span> Remove
                                </button></td>
                            </tr>
                            <tr>
                                <td colspan="3">Subtotal</td>
                                <td class="text-left"><strong>₱ {{total}}</strong></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="3">Tax: 5%</td>
                                <td class="text-left"><strong>₱ {{total*.05}}</strong></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><h6>Coupon</h6></td>
                                <td class="text-left"><h6><strong></strong></h6></td>
                                <td colspan="2" class="col-l-1 col-md-1" style="text-align: center" v-if="check_coupon < 1">
                                    <input type="text" class="form-control" placeholder="Enter coupon code" v-model="coupon_code">
                                    <p class="text-danger" v-if="error">{{error}}</p>
                                </td>
                                <td colspan="2" class="col-l-1 col-md-1" style="text-align: center" v-else>
                                    ₱ {{discount}}
                                </td>
                                <td class="col-l-1 col-md-1" v-if="check_coupon < 1">
                                <button type="button" class="btn btn-primary" @click="useCoupon()">
                                    <span class="glyphicon glyphicon-remove"></span> Check
                                </button></td>
                                <td v-else></td>
                            </tr>
                            <tr>
                                <td colspan="3"><h6>Total</h6></td>
                                <td class="text-left"><h6><strong>₱ {{getTax() + total - discount}}</strong></h6></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                <router-link to="/" class="btn btn-link">
                                   Continue Shopping
                                </router-link></td>
                                <td>
                                <button type="button" class="btn btn-success" @click="checkout()">
                                    Checkout
                                </button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Checkout -->

	</div>
</template>
<script src="./script.js"></script>
