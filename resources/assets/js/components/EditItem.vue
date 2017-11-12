<template>
    <div>
        <h1>Update Client Info</h1>
        <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2"><router-link :to="{ name: 'DisplayItem' }" class="btn btn-success">Return to Items</router-link></div>
        </div>

        <form v-on:submit.prevent="updateItem">
            <div class="form-group">
                <label>Firstname:</label>
                <input type="text" class="form-control" v-model="item.firstname_id">
            </div>

            <div class="form-group">
                <label>Lastname:</label>
                <input type="text" class="form-control" v-model="item.lastname_id">
            </div>

            <div class="form-group">
                <label name="product_price">Personal code</label>
                <input type="text" class="form-control" v-model="item.personal_code">
            </div>

            <div class="form-group">
                <label>Adress</label>
                <input type="text" class="form-control" v-model="item.adress">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" v-model="item.email">
            </div>

            <div class="form-group">
                <label>City</label>
                <input type="text" class="form-control" v-model="item.city_id">
            </div>

            <div class="form-group">
                <label name="product_price">Country</label>
                <input type="text" class="form-control" v-model="item.country_id">
            </div>

            <div class="form-group">
                <button class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</template>

<script>

    export default{
        data(){
            return{
                item:{}
            }
        },

        created: function(){
            this.getItem();
        },

        methods: {
            getItem()
            {
              let uri = `http://localhost/api/clients/${this.$route.params.id}`;
                this.axios.get(uri).then((response) => {
                    this.item = response.data;
                });
            },

            updateItem()
            {
              let uri = 'http://localhost/api/clients/'+this.$route.params.id;
                this.axios.put(uri, this.item).then((response) => {
                  this.$router.push({name: 'DisplayItem'});
                });
            }
        }
    }
</script>