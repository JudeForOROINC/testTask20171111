<template>
  <div>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
      <!-- Бренд или название сайта (отображается в левой части меню) -->
          <a class="navbar-brand" href="#">Test Task</a>
        </div>

        <div class="collapse navbar-collapse" id="navbar-main">
          <ul class="nav navbar-nav">
	    <li  v-bind:class="{ active: isActive('DisplayItem') }" >
<router-link :to="{ name: 'DisplayItem' }" >Clients</router-link>

</li>
	    <li v-bind:class="{ active: isActive('UploadClients') }">
	      <router-link :to="{ name: 'UploadClients' }" >File upload</router-link>
            </li>
	    <li v-bind:class="{ active: isActive('DownloadClients') }">
	      <router-link :to="{ name: 'DownloadClients' }" >File download</router-link>
            </li>
	    <li v-bind:class="{ active: isActive('Login') }" v-if="!isLoggedIn" >
	      <router-link :to="{ name: 'Login' }" >Login</router-link>
            </li>
	    <li v-bind:class="{ active: isActive('About') }"  >
<router-link :to="{ name: 'About' }" >About</router-link>

</li>
	    <li><a href="#" @click="logout" v-if="isLoggedIn">Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>	
  </div>
</template>

<script>
    export default {
        data(){
            return{
                items: []
            }
        },

        methods: {
            isActive(name)
            {
		return name == this.$route.name;
            },
logout() {
     this.$store.dispatch('logout');
//console.log(this.$store.getters.token);
this.$router.push({name: 'About'})
//TODO : Fix log out from server = send a request;
    }
        },
computed: {
    isLoggedIn() {
      return this.$store.getters.isLoggedIn;
    }
}
    }
</script>
