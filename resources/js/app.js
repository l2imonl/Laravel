require('./bootstrap');

window.Vue = require('vue');

Vue.component('index', require('./components/Blog/index.vue').default);
Vue.component('single', require('./components/Blog/single.vue').default);

const app = new Vue({
   el: '#app'
});
