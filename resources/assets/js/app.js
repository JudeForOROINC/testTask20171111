require('./bootstrap');

import Vue from 'vue';

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';
Vue.use(VueAxios, axios);

import App from './components/App.vue';
import Example from './components/Example.vue';
import CreateItem from './components/CreateItem.vue';
import DisplayItem from './components/DisplayItem.vue';
import EditItem from './components/EditItem.vue';
import MenuItem from './components/Menu.vue';
import About from './components/About.vue';
import UploadClients from './components/UploadClients.vue';
import DownloadClients from './components/DownloadClients.vue';
import Login from './components/Login.vue';

Vue.component('menu_item', 
MenuItem
);
const routes = [
  {
    name: 'CreateItem',
    path: '/items/create',
    component: CreateItem
  },
  {
        name: 'DisplayItem',
        path: '/',
        component: DisplayItem
  },
  {
      name: 'EditItem',
      path: '/edit/:id',
      component: EditItem
   },
  {
      name: 'About',
      path: '/about',
      component: About
   },
  {
      name: 'UploadClients',
      path: '/upload',
      component: UploadClients
   },
  {
      name: 'DownloadClients',
      path: '/download',
      component: DownloadClients
   },
  {
      name: 'Login',
      path: '/login',
      component: Login
   }

];
const router = new VueRouter({ mode: 'history', routes: routes});
new Vue(Vue.util.extend({ router }, App)).$mount('#app');
