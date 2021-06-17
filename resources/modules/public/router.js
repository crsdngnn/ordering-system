import Vue from 'vue';
import VueRouter from 'vue-router';
import Homepage from './homepage/homepage.component';
import Checkout from './checkout/checkout.component';
import Product from './product/product.component';
import OrderHistory from './summary/summary.component';

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes: [{
            path: '/',
            name: 'homepage',
            component: Homepage
        },
        {
            path: '/checkout',
            name: 'checkout',
            component: Checkout
        },
        {
            path: '/products/:id',
            name: 'product',
            component: Product
        },
        {
            path: '/order-history',
            name: 'order-history',
            component: OrderHistory
        },
    ]
});