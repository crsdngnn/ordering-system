import axios from "axios";
import Config from "../../../config/config";
var promise;

export default class CategoryService {

    list() {
        promise = axios.get(`${Config.api_prefix}/menu-categories`);
        return promise;
    }

    show(id) {
        promise = axios.get(`${Config.api_prefix}/menu-categories/${id}`);
        return promise;
    }
}

export const categoryService = new CategoryService();
