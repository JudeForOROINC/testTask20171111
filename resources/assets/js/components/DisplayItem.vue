<template>
    
    <div>
        <h1>Clients</h1>

        <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2">
            <router-link :to="{ name: 'CreateItem' }" class="btn btn-primary">Create Item</router-link>
          </div>
        </div><br />

        <table class="table table-hover">
            <thead>
            <tr>
                <td>ID</td>
                <td>Firstname</td>
                <td>Lastname</td>
                <td>Actions</td>
            </tr>
            </thead>

            <tbody>
                <tr v-for="item,index in items">
                    <td>{{ item.id }}</td>
                    <td>{{ item.firstname_id }}</td>
                    <td>{{ item.lastname_id }}</td>
                    <td><router-link :to="{name: 'EditItem', params: { id: item.id }}" class="btn btn-primary">Edit</router-link></td>
                    <td><button class="btn btn-danger" v-on:click="deleteItem(item.id, index)">Delete</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>

    export default {
        data(){
            return{
                items: []
            }
        },

        created: function()
        {
            this.fetchItems();
        },

        methods: {
            fetchItems()
            {
              let uri = 'http://localhost/api/clients';
              this.axios.get(uri).then((response) => {
                  this.items = response.data;
              });
            },
            deleteItem(id, index)
            {
              let uri = `http://localhost/api/clients/${id}`;
//		this.items.splice(index,1);
		//var app = this;
		this.axios.delete(uri).then( (responce) =>
{
		if(responce.data == '204')
{
              this.items.splice(index, 1);
}
});
              //this.axios.delete(uri);
//})
//.catch(function (error) {
//    if (error.response) {
//      console.log(error.response.data);
//      console.log(error.response.status);
//      console.log(error.response.headers);
//    } else {
//alert('bug!');
//}
//  });
            }
        }
    }
</script>
