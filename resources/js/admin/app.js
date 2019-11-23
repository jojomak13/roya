import Vue from 'vue';
import Cashier from './components/Cashier';
import './bootstrap';


const app = new Vue({
    components: {
        'app-cashier': Cashier
    },
    el: '#app',
});