<template>
  <div>
    <h1>Create An Item</h1>
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
</template>
<script>
  export default {
    data(){
        return{
          item:{}
        }
    },
    methods: {
      addItem(){
        let uri = 'http://localhost/api/clients';
        this.axios.post(uri, this.item).then((response) => {
          this.$router.push({name: 'DisplayItem'})
        })
    }
  }
}
</script>