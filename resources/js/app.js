/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


 require('./bootstrap');

 window.Vue = require('vue').default;
 import Swal from 'sweetalert2';

 window.Swal = Swal

 import CategoryForm from './components/CategoryForm.vue';
 import Categories from './components/Categories.vue';
 import CategoryProducts from './components/CategoryProducts.vue';
 import ProductForm from './components/ProductForm.vue';

 const VueRouter = require('vue-router').default;

 Vue.component('example-component', require('./components/ExampleComponent.vue').default);
 Vue.component('category-form', require('./components/CategoryForm.vue').default);
 Vue.component('categories', require('./components/Categories.vue').default);
 Vue.component('category-products', require('./components/CategoryProducts.vue').default);
 Vue.component('category-products', require('./components/CategoryProducts.vue').default);

 window.events = new Vue()

 /**
  * The following block of code may be used to automatically register your
  * Vue components. It will recursively scan this directory for the Vue
  * components and automatically register them with their "basename".
  *
  * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
  */

 // const files = require.context('./', true, /\.vue$/i)
 // files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

 const routes = [
    { path: '/categories/create', component: CategoryForm },
    { path: '/categories', component: Categories },
    { path: '/category/:id/products', component: CategoryProducts },
    { path: '/category/:id/products', component: Categories },
    { path: '/category/:id/products/create', component: ProductForm },
 ];

 const router = new VueRouter({
    mode: 'history',
    routes:routes
})
Vue.use(VueRouter)


   // 3. Create the router instance and pass the `routes` option
   // You can pass in additional options here, but let's
   // keep it simple for now.

 /**
  * Next, we will create a fresh Vue application instance and attach it to
  * the page. Then, you may begin adding components to this application
  * or customize the JavaScript scaffolding to fit your unique needs.
  */

 const app = new Vue({
    router,
    el: '#app',
 });
