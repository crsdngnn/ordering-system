<template>
	<div class="container m-5 p-2 rounded mx-auto bg-light shadow">
            <!-- App title section -->
            <div class="col row m-1 p-4">
                <div class="col-6">
                    <div class="p-1 h1 text-primary">
                        <u>Menu List</u>
                    </div>
                </div>
                <div class="col-4">
                    <div class="p-1 h1 text-primary">
                        <router-link to="/checkout">
                            Cart: {{count}}
                        </router-link>
                    </div>
                </div>
            </div>

            <!-- Menu list -->
            <div class="row mx-1 px-5 pb-3 w-80">
                <div class="col-6">
                    <div class="row px-3 align-items-center todo-item rounded" v-for="(value, key) in data">
                        <div class="col-3 px-1 m-1 d-flex align-items-center">
                            <label>{{value.name}}</label>
                        </div>
                        <div class="col-9 px-1 m-1 d-flex align-items-center">
                            <ul>
                                <li v-for="(menu, k) in value.has_many_products">
                                    <router-link :to="`/products/${menu.id}`" >
                                        {{menu.name}}
                                        <!-- <img src="/images/hotdog.jpg" /> -->
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>



            <div class="p-2 mx-4 border-black-25 border-bottom"></div>
            <div class="row m-1 p-3 px-5 justify-content-end"></div>
	</div>
</template>
<script src="./script.js"></script>
