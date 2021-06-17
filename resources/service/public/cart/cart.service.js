import axios from "axios";
import Config from "../../../config/config";
var promise;

export default class CartService {

    list() {
        promise = axios.get(`${Config.api_prefix}/cart`);
        return promise;
    }

    store(data) {
        promise = axios.post(`${Config.api_prefix}/cart`, data);
        return promise;
    }

    show(id) {
        promise = axios.get(`${Config.api_prefix}/cart/${id}`);
        return promise;
    }

    delete(id) {
        promise = axios.delete(`${Config.api_prefix}/cart/${id}`);
        return promise;
    }

    getCartCount() {
        promise = axios.get(`${Config.api_prefix}/get-cart-count`);
        return promise;
    }

    useCoupon(data) {
        promise = axios.post(`${Config.api_prefix}/use-coupon`, data);
        return promise;
    }

    checkCoupon() {
        promise = axios.get(`${Config.api_prefix}/check-coupon`);
        return promise;
    }

}

export const cartService = new CartService();