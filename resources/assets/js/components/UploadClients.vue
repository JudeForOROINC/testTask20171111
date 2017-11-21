<template>
  <div>
    <div v-if="isLoggedIn">
      <form v-on:submit.prevent="UploadFile" enctype="multipart/form-data">
        <input type="file" name="photo" @change="onFileChange" >
	<div class="form-group">
          <button class="btn btn-primary">Upload</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
    export default {
        methods: {
            onFileChange(e) {
          //       OnFileChange(e){

            let files = e.target.files || e.dataTransfer.files;
            if (!files.length) return;
//  const formData = new FormData();

//        if (!fileList.length) return;

        // append the files to FormData
  //      Array
    //      .from(Array(files.length).keys())
      //    .map(x => {
        //    formData.append(fieldName, files[x], files[x].name);
         // });

        // save it
        //this.save(formData);

            let v = this;
            v.file = files[0];
            v.classes.disabled = false;

        //},
            },
 save(formData) {
        // upload data to the server
        this.currentStatus = STATUS_SAVING;

        upload(formData)
          .then(x => {
            this.uploadedFiles = [].concat(x);
            this.currentStatus = STATUS_SUCCESS;
          })
          .catch(err => {
            this.uploadError = err.response;
            this.currentStatus = STATUS_FAILED;
          });
      },
	    UploadFile() {
		 let uri = '../api/clients/upload';
//        let uri = 'http://localhost/api/clients';
	let token = this.$store.getters.token
	let config = {
	headers: {'Authorization': "Bearer "+token}
}
var form = new FormData();
          form.append('photo', this.file, this.file.name);

        this.axios.post(uri, form, config).then((response) => {
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
