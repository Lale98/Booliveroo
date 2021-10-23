window.Vue = require('vue');

//importo axios globalmente
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import App from './App.vue';
import router from './router';

const app = new Vue(
    {
        el: '#root',
        render: h => h(App),
        router
    }
);
