
require('./bootstrap');

window.Vue = require('vue').default;

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('first-com', require('./components/FirstCom.vue').default);
// Vue.component('edit-com', require('./components/EditModel.vue').default);


const app = new Vue({
    el: '#app',
//    components: {'edit-com':edit-com}
});
