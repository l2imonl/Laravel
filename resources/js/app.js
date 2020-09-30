require('./bootstrap');

window.Vue = require('vue');

Vue.component('Test', require('./components/Blog/index.vue').default);

const app = new Vue({
   el: '#app'
});
