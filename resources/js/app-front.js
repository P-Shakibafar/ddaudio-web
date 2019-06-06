require('./bootstrap');
window.Vue = require('vue');
// :: vue router ::
import VueRouter from 'vue-router';
import axios from 'axios'
// :: vform ::
import {AlertError, Form, HasError} from 'vform';
import App from './components/Front-End/App.vue'

const base = axios.create({
    baseURL: 'http://localhost:8000'
});
// :: Lodash

Vue.prototype.$http = base;
Vue.use(VueRouter);
let routes = [
    {path: '/', component: require('./components/Front-End/Home.vue')},
    {
        path: '/home',
        component: require('./components/Front-End/Home.vue'),
        meta: {title: 'DD Audio - Upgrade Your Sound | Home'}
    },
    {
        path: '/products/Amplifiers',
        component: require('./components/Front-End/Amplifiers.vue'),
        meta: {title: 'DD Audio - Upgrade Your Sound | Amplifiers'}
    },
    {
        path: '/products/Subwoofers',
        component: require('./components/Front-End/Subwoofers.vue'),
        meta: {title: 'DD Audio - Upgrade Your Sound | Subwoofers'}
    },
    {
        path: '/products/Speakers',
        component: require('./components/Front-End/Speakers.vue'),
        meta: {title: 'DD Audio - Upgrade Your Sound | Speakers'}
    },
    {
        path: '/products/Enclosures',
        component: require('./components/Front-End/Enclosures.vue'),
        meta: {title: 'DD Audio - Upgrade Your Sound | Enclosures'}
    },
    {
        path: '/products/Signal_Processors',
        component: require('./components/Front-End/SignalProcessores.vue'),
        meta: {title: 'DD Audio - Upgrade Your Sound | Signal Processores'}
    },
    {
        path: '/products/:categoryName/:productName',
        name: "product-details",
        component: require('./components/Front-End/ProductDetails.vue'),
    },
    {
        path: '/Gallery',
        component: require('./components/Front-End/Gallery.vue'),
        meta: {title: 'DD Audio - Upgrade Your Sound | Gallery'}
    },
];

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
});
router.beforeEach((to, from, next) => {
    const nearestWithTitle = to.matched.slice().reverse().find(r => r.meta && r.meta.title);
    if (nearestWithTitle) document.title = nearestWithTitle.meta.title;
    next();
});
window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

window.Fire = new Vue();
Vue.component('pagination', require('laravel-vue-pagination'));


const app = new Vue({
    el: '#app',
    components: {App},
    render: h => h(App),
    router,
    data: {},
});
