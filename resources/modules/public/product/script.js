import { menuService } from "../../../service/public/menu/menu.service";
import { cartService } from "../../../service/public/cart/cart.service";
import swal from 'sweetalert';

export default {
    data: function() {
        return {
            data: {
                price: 0
            },
            order: {
                quantity: 0,
                product_id: ''
            },
        }
    },
    mounted() {
        this.initialize();
    },
    methods: {
        show: function() {
            menuService.show(this.$route.params.id).then(response => {
                this.data = response.data.data;
                this.order.product_id = this.data.id;
            });
        },
        initialize: function() {
            this.show();
        },
        getTotal() {
            return this.order.quantity * this.data.price
        },
        saveCart() {
            cartService.store(this.order).then(response => {
                this.successSwal(response.data.message)
                this.$router.push({ name: 'homepage' })
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