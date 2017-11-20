<template>
  <div>
<router-link to="Login" v-if="!isLoggedIn">Login</router-link>
    <a href="#" v-if="isLoggedIn" @click="logout">Logout</a> 

    <form v-on:submit.prevent="doLogin">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>email:</label>
            <input type="text" class="form-control" v-model="item.email">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>password</label>
            <input type="text" class="form-control" v-model="item.password">
          </div>
        </div>
      </div>
<br />
        <div class="form-group">
          <button class="btn btn-primary">Login</button>
        </div>
    </form>
  </div>
</template>
<script>
  export default {
    data(){
        return{
          item:{
	'email': 'admin@test.com',
'password': 'toptal'
},
	    errors:{}
        }
    },
    methods: {
      do_doLogin(){
        let uri = 'http://localhost/api/login';
        this.axios.post(uri, this.item).then((response) => {
	  if(response.data.error){
	    this.errors = response.data.error;
} else {
console.log(response.data) ;         
this.$router.push({name: 'DisplayItem'})
}
        })
      },

  
    logout() {
     this.$store.dispatch('logout');
console.log(this.$store.getters.token);
    },
doLogin() {
      this.$store.dispatch("login", {
        email: this.item.email,
        password: this.item.password
      }).then(() => {
        this.$router.push({name: 'DisplayItem'})
});
}
  },
  computed: {
    isLoggedIn() {
      return this.$store.getters.isLoggedIn;
    }
}
}
</script>
