import axios from "axios";
import Config from "../../../config/config";
var promise;

export default class MenuService {

    list() {
        promise = axios.get(`${Config.api_prefix}/get-products`);
        return promise;
    }

    show(id) {
        promise = axios.get(`${Config.api_prefix}/get-products/${id}`);
        return promise;
    }
}

export const menuService = new MenuService();