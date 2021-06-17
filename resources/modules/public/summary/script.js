import { orderService } from "../../../service/public/order/order.service";
import swal from 'sweetalert';


export default {
    data: function() {
        return {
            data: {},
            order: {
                discount_coupon: {
                    discount: 0
                },
                order_number: '',
                has_many_order_details: []
            },
            total: 0
        }
    },
    mounted() {
        this.initialize();
    },
    methods: {
        list: function() {
            orderService.list().then(response => {
                this.data = response.data.data;
            });
        },
        getProductsTotal: function(data) {
            this.total = data.map(e => e.quantity * e.product.price).reduce((a, b) => a + b);
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
        viewOrder(id) {
            orderService.show(id).then(response => {
                this.order = response.data.data;
                this.getProductsTotal(this.order.has_many_order_details);
            });
        },
        initialize: function() {
            this.list();
        }
    }
}