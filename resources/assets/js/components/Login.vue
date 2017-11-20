<template>
  <div>
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
          item:{},
	    errors:{}
        }
    },
    methods: {
      doLogin(){
        let uri = 'http://localhost/api/clients';
        this.axios.post(uri, this.item).then((response) => {
	  if(response.data.error){
	    this.errors = response.data.error;
} else {
          this.$router.push({name: 'DisplayItem'})
}
        })
    }
  }
}
</script>
