<template>
	<div class="container m-5 p-2 rounded mx-auto bg-light shadow">
        <!-- App title section -->
        <div class="row m-1 p-4">
            <div class="col">
                <div class="p-1 h1 text-primary">
                    {{data.name}}
                </div>
            </div>
        </div>

	    <!-- Product -->
	    <div class="row mx-1 px-5 pb-3 w-80">
	        <div class="col mx-auto">
	            <div class="row px-3 align-items-center todo-item rounded">
	                <div class="col-2">
                        <div class="form-group">
                            <label class="control-label col-sm-2">Quantity</label>
                            <div class="col-sm-10">
                            {{data.quantity}}
                            </div>
                        </div>
	                </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label class="control-label col-sm-2">Price</label>
                            <div class="col-sm-10">
                            {{data.price}}
                            </div>
                        </div>
	                </div>
                    <div class="col-3">
	                    <div class="form-group">
                            <label class="control-label col-sm-2" >Order:</label>
                            <div class="col-sm-10">
                            <input type="textbox" v-model="order.quantity" class="form-control" placeholder="Quantity Order"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                            </div>
                        </div>
	                </div>
                    <div class="col-2">
	                    <div class="form-group">
                            <label class="control-label col-sm-2" >Total:</label>
                            <div class="col-sm-10">
                            {{getTotal()}}
                            </div>
                        </div>
	                </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-primary" @click="saveCart()"><i class="fa fa-plus text-white btn m-0 p-0" data-placement="bottom"></i> Add Item</button>
	                </div>
	            </div>
	        </div>
	    </div>

	</div>
</template>
<script src="./script.js"></script>
