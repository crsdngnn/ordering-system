import axios from "axios";
import Config from "../../../config/config";
var promise;

export default class OrderService {

    list() {
        promise = axios.get(`${Config.api_prefix}/orders`);
        return promise;
    }

    store(data) {
        promise = axios.post(`${Config.api_prefix}/orders`, data);
        return promise;
    }

    update(id, data) {
        promise = axios.put(`${Config.api_prefix}/orders/${id}`, data);
        return promise;
    }

    show(id) {
        promise = axios.get(`${Config.api_prefix}/orders/${id}`);
        return promise;
    }

    delete(id) {
        promise = axios.delete(`${Config.api_prefix}/orders/${id}`);
        return promise;
    }

}

export const orderService = new OrderService();