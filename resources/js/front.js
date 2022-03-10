
require('./bootstrap');

window.Vue = require('vue');
import App from './views/App';
import Home from './pages/Home';
import About from './pages/About';
import Posts from './pages/Posts';
import Post from './pages/Post';

import VueRouter from 'vue-router';
Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
        },
        {
            path: '/about',
            name: 'about',
            component: About,
        },
        {
            path: '/posts',
            name: 'posts',
            component: Posts,
        },
        {
            path: '/post',
            name: 'post',
            component: Post,
        },
    ]
});

const app = new Vue({
    el: '#app',
    render: h => h(App),
    router
});
