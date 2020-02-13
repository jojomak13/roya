import Vue from "vue";
import Axios from "axios";
import Cashier from "./components/Cashier";
import PrepareOrder from "./components/PrepareOrder";
import ShippingOrder from "./components/ShippingOrder";
import "./bootstrap";

Axios.defaults.baseURL = `${baseData.url}/${baseData.lang}`;

Vue.filter("trans", data => {
    return data[`name_${baseData.lang}`];
});

const app = new Vue({
    components: {
        "app-cashier": Cashier,
        "prepare-order": PrepareOrder,
        "shipping-order": ShippingOrder
    },
    el: "#app"
});
