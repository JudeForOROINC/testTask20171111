<template>
  <div>
	<MenuItem></MenuItem>
    <h1>Create Client</h1>

<div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2"><router-link :to="{ name: 'DisplayItem' }" class="btn btn-success">Return to Items</router-link></div>
</div>
<router-link :to="{ name: 'Login' }" v-if="!isLoggedIn" class="btn btn-default">Login</router-link>
<div v-else>
    <div class="alert alert-danger print-error-msg" style="display:none" v-show="Object.keys(errors).length">

        <ul>
	<li v-for="n in errors">{{ n }}</li>
</ul>

    </div>
    <form v-on:submit.prevent="addItem">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Firstname:</label>
            <input type="text" class="form-control" v-model="item.firstname_id">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Lastname:</label>
            <input type="text" class="form-control" v-model="item.lastname_id">
          </div>
        </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Personal Code:</label>
              <input type="text" class="form-control col-md-6" v-model="item.personal_code" />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Contact Email(required):</label>
              <input type="text" class="form-control col-md-6" v-model="item.email" />
            </div>
          </div>
        </div><br />
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Adress:</label>
              <input type="text" class="form-control col-md-6" v-model="item.adress" />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>City:</label>
              <input type="text" class="form-control col-md-6" v-model="item.city_id" />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Country:</label>
              <input type="text" class="form-control col-md-6" v-model="item.country_id" />
            </div>
          </div>
        </div><br />
        <div class="form-group">
          <button class="btn btn-primary">Add Item</button>
        </div>
    </form>
</div>
  </div>
</template>
<script>
  export default {
    data(){
        return{
          item:{},
	    errors:{}
        }
    },
    methods: {
      addItem(){
        let uri = '../api/clients';
//        let uri = 'http://localhost/api/clients';
	let token = this.$store.getters.token
	let config = {
	headers: {'Authorization': "Bearer "+token}
}
        this.axios.post(uri, this.item, config).then((response) => {
	  if(response.data.error){
	    this.errors = response.data.error;
} else {
          this.$router.push({name: 'DisplayItem'})
}
        })
    }

  },
computed: {
    isLoggedIn() {
      return this.$store.getters.isLoggedIn;
    }
}
}
</script>
