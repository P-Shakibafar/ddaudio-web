/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');

// :: filter use moment ::
import moment from 'moment';

Vue.filter('upText', function (text) {
	return text.charAt(0).toUpperCase() + text.slice(1)
});
Vue.filter('myDate', function (created) {
	return moment(created).format('MMMM Do YYYY'); // نوامبر ۱۲م ۲۰۱۸
});
// :: vform ::
import {Form, HasError, AlertError} from 'vform';

window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);


// :: sweet alert ::
import swal from 'sweetalert2';

window.swal = swal;
const toast = swal.mixin({
	toast: true,
	position: 'top-end',
	showConfirmButton: false,
	timer: 3000
});

window.toast = toast;


// :: progress bar ::
import VueProgressBar from 'vue-progressbar';

Vue.use(VueProgressBar, {
	color: 'rgb(143, 255, 199)',
	failedColor: 'red',
	height: '2px'
});

// :: vue router ::
import VueRouter from 'vue-router'

Vue.use(VueRouter);

let routes = [
	{path: '/dashboard', component: require('./components/Back-End/Dashboard.vue')},
	{path: '/developer', component: require('./components/Back-End/Developer.vue')},
	{path: '/profile', component: require('./components/Back-End/Profile.vue')},
	{path: '/users', component: require('./components/Back-End/Users.vue')},
	{path: '/products', component: require('./components/Back-End/Category.vue')},
	{path: '/series', component: require('./components/Back-End/Series.vue')},
	{path: '/amplifires', component: require('./components/Back-End/Amplifires.vue')},
	{path: '/enclosures', component: require('./components/Back-End/Enclosures.vue')},
	{path: '/signal_processors', component: require('./components/Back-End/SignalProcessores.vue')},
	{path: '/speakers', component: require('./components/Back-End/Speakers.vue')},
	{path: '/subwoofers', component: require('./components/Back-End/Subwoofers.vue')},
	{path: '/gallery', component: require('./components/Back-End/Gallery.vue')},
];
const router = new VueRouter({
	mode: 'history',
	routes // short for `routes: routes`
});


window.Fire = new Vue();
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('passport-clients', require('./components/Back-End/passport/Clients.vue'));
Vue.component('passport-authorized-clients', require('./components/Back-End/passport/AuthorizedClients.vue'));
Vue.component('passport-personal-access-tokens', require('./components/Back-End/passport/PersonalAccessTokens.vue'));
Vue.component('Series', require('./components/Back-End/Series.vue'));
Vue.component('cButton', require('./components/Back-End/cButton.vue'),);
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('vue-dropzone', require('vue2-dropzone'));
Vue.component('dropzoneModal', require('./components/Back-End/DropzoneModel.vue'));
Vue.component('example-component', require('./components/Back-End/ExampleComponent.vue'));
// :: Dropzone js ::
import vueDropzone from "vue2-dropzone";
import 'vue2-dropzone/dist/vue2Dropzone.min.css';

Vue.mixin({
	data: function () {
		return {
			cProduct: ''
		}
	}
});
const app = new Vue({
	el: '#app',
	router,
	data: {
		search: '',
		cProduct: '',
		productEditMode: false,

	},
	components: {
		vueDropzone
	},
	methods: {
		searchit: _.debounce(() => {
			console.log("searching....");
			Fire.$emit('searching');
		}, 1000),
	},
});