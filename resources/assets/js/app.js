require('./bootstrap');

import Vue from 'vue';

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';
Vue.use(VueAxios, axios);

import Vuex from 'vuex';
//vuex
Vue.use(Vuex);

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

const LOGIN = "LOGIN";
const LOGIN_SUCCESS = "LOGIN_SUCCESS";
const LOGOUT = "LOGOUT";

const store = new Vuex.Store({
  state: {
    isLoggedIn: !!localStorage.getItem("token")
  },
  mutations: {
    [LOGIN] (state) {
      state.pending = true;
    },
    [LOGIN_SUCCESS] (state) {
      state.isLoggedIn = true;
      state.pending = false;
    },
    [LOGOUT](state) {
      state.isLoggedIn = false;
    }
  },
  actions: {
   login({ commit }, creds) {
     commit(LOGIN); // show spinner
     return new Promise(resolve => {
 let uri = 'http://localhost/api/login';
//console.log(creds);
        axios.post(uri, creds).then((response) => {
	  if(response.data.error){
	    this.errors = response.data.error;
console.log(response.data.error) ; 
commit(LOGOUT);
} else {
//console.log(response.data) ;         
console.log('=======') ;  
console.log(response.data.data.api_token) ;         
console.log('=======') ;  
        localStorage.setItem("token", response.data.data.api_token);
console.log('=======') ;  
 commit(LOGIN_SUCCESS);
resolve();
//this.$router.push({name: 'DisplayItem'})
}
        })
//       setTimeout(() => {
//         localStorage.setItem("token", "JWT");
  //       commit(LOGIN_SUCCESS);
    //     resolve();
      // }, 1000);
     });
   },
   logout({ commit }) {
     localStorage.removeItem("token");
     commit(LOGOUT);
   }
  },
  getters: {
    isLoggedIn: state => {
      return state.isLoggedIn
     },
	
	
    token: state => {
	return localStorage.getItem("token");
}
  }
}); 
const router = new VueRouter({ mode: 'history', routes: routes});
new Vue(Vue.util.extend({ router, store }, App)).$mount('#app');
