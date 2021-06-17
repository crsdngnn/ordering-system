import { cartService } from "../../../service/public/cart/cart.service";
import { categoryService } from "../../../service/public/categories/categories.service";
import swal from 'sweetalert';

export default {
    data: function() {
        return {
            data: {
                has_many_products: [],
            },
            count: ''
        }
    },
    mounted() {
        this.initialize();
        this.getCartCount()
    },
    methods: {
        list: function() {
            categoryService.list().then(response => {
                this.data = response.data.data;
            });
        },
        initialize: function() {
            this.list();
        },
        async getCartCount() {
            const res = await cartService.getCartCount();
            this.count = res.data.data;
        }
    }
}