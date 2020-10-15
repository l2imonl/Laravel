require('./bootstrap');
// import router from "./routes/index.js";
import store from "./store/index.js";
window.Vue = require('vue');

Vue.component('index', require('./components/Blog/index.vue').default);
Vue.component('single', require('./components/Blog/single.vue').default);
Vue.component('login', require('./components/login.vue').default);

const app = new Vue({
    // router,
    store,
   el: '#app'
});
