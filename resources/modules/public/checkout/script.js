import { cartService } from "../../../service/public/cart/cart.service";
import { orderService } from "../../../service/public/order/order.service";
import swal from 'sweetalert';

export default {
    data: function() {
        return {
            data: [],
            total: '',
            discount: 0,
            coupon_code: null,
            check_coupon: 0,
            error: ''
        }
    },
    mounted() {
        this.initialize();
    },
    methods: {
        list: function() {
            cartService.list().then(response => {
                this.data = response.data.data;
                this.checkCoupon();
                this.getProductsTotal(this.data);
            });
        },
        initialize: function() {
            this.list();
        },
        getTotal: function(price, quantity, key) {
            this.data[key].quantity = quantity;
            this.getProductsTotal(this.data);
            return price * quantity;
        },
        getProductsTotal: function(data) {
            this.total = data.map(e => e.quantity * e.product.price).reduce((a, b) => a + b);
        },
        getTax: function() {
            return this.total * .01;
        },
        removeItem: function(id) {
            cartService.delete(id).then(res => {
                this.list();
            });
        },
        useCoupon() {
            cartService.useCoupon({ code: this.coupon_code }).then(response => {
                this.discount = response.data.data.discount;
                this.checkCoupon();
            }).catch((err) => {
                this.error = err.response.data.data;
            });
        },
        checkCoupon() {
            cartService.checkCoupon().then(response => {
                this.check_coupon = response.data.data.coupon_count;
                this.discount = response.data.data.discount;
            });
        },
        checkout: function() {
            const details = {
                tax: this.total * .05,
                total: this.getTax() + this.total - this.discount,
                discount: this.discount ? this.discount : null,
                order: this.data,
            }
            orderService.store(details).then(response => {
                this.successSwal(response.data.message)
                this.$router.push({ name: 'order-history' })
            }).catch((err) => {
                this.errorSwal(err.response.data.message)
            });
        },
        successSwal: function(message) {
            swal({
                title: message,
                icon: "success",
            });
        },
        errorSwal: function(message) {
            swal({
                title: message,
                icon: "warning",
                dangerMode: true,
            });
        },
    }
}