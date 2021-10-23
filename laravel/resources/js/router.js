import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Home from './pages/Home';
import Restaurant from './pages/Restaurant';
import Chisiamo from './pages/Chisiamo';


const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/restaurant/:slug',
            name: 'restaurant',
            component: Restaurant
        },
        {
            path:'/Chisiamo',
            name: 'Chisiamo',
            component: Chisiamo
        }
    ]
});

export default router;