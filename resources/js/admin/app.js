import Vue from "vue";
import Axios from "axios";
import Cashier from "./components/Cashier";
import "./bootstrap";

Axios.defaults.baseURL = `${baseData.url}/${baseData.lang}`;

const app = new Vue({
    components: {
        "app-cashier": Cashier
    },
    el: "#app"
});
