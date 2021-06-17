<template>
	<div class="container m-5 p-2 rounded mx-auto bg-light shadow">
    	<!-- App title section -->
	    <div class="row m-1 p-4">
	        <div class="col">
	            <div class="p-1 h1 text-primary text-center mx-auto display-inline-block">
	                <u>Order History</u>
	            </div>
	        </div>
	    </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Order Number</th>
                    <th scope="col">Date Purchased</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(value, key) in data">
                    <th scope="row">{{value.order_number.toUpperCase()}}</th>
                    <td>{{new Date(value.created_at).toLocaleDateString()}}</td>
                    <td>
                        <a href="#" @click="viewOrder(value.id)" data-toggle="modal" data-target="#exampleModal">
                            VIEW
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label for="">Order number: {{order.order_number.toUpperCase()}}</label>
                <!-- <span v-for="(value, key) in order.has_many_products" :key="key">
                    <label for="">Product name: {{value.product.name}} -- Quantity: {{value.quantity}}</label>
                </span> -->
                <table>
                    <tr>
                        <td>Product name</td>
                        <td>Quantity</td>
                        <td>Total</td>
                    </tr>
                    <tr v-for="(value, key) in order.has_many_order_details" :key="key">
                        <td>{{value.product.name}}</td>
                        <td>{{value.quantity}}</td>
                        <td>{{value.total}}</td>
                    </tr>
                    <tr>
                        <td>Tax:</td>
                        <td></td>
                        <td> {{order.tax}}</td>
                    </tr>
                    <tr v-if="order.discount_coupon != null">
                        <td>Coupon: {{order.discount_coupon.code}}</td>
                        <td></td>
                        <td> {{order.discount_coupon.discount}}</td>
                    </tr>
                    <tr>
                        <td>Total:</td>
                        <td></td>
                        <td> {{total + order.tax - (order.discount_coupon != null ? order.discount_coupon.discount : 0)}}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>
	</div>
</template>
<script src="./script.js"></script>
