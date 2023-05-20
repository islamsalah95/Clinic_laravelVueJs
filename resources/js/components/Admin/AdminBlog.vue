<template>
    <div class="container">
        <div class="row" style="height: 80px"></div>
        <h1>Doctors</h1>
        <div class="row">
            <div>
                <ul v-if="databaseErrors" class="alert alert-danger">
                    <li v-if="databaseErrors">{{ databaseErrors.name }}</li>
                    <li v-if="databaseErrors">{{ databaseErrors.email }}</li>
                    <li v-if="databaseErrors">{{ databaseErrors.password }}</li>
                    <li v-if="databaseErrors">
                        {{ databaseErrors.department_id }}
                    </li>
                </ul>
            </div>
        </div>
        <!-- portfolio -->

        <div class="row">
            <table class="table table-striped">
      <thead>
        <tr>
          <th>Id</th>
          <th>title</th>
          <th>Image</th>
          <th>actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="result in results" :key="result.id">
          <td>{{result.id}}</td>
          <td>{{result.title}}</td>
          <td>
            <img style="width: 100px;height: 100px;" :src="result.file" alt="">
    
        </td>
          <td><button class="btn btn-danger" @click="deleteBlog(result.id)">Delete</button></td>
          <td><router-link :to="'/AdminUpdateBlog/' + result.id"  class="btn btn-danger"  >Update</router-link></td>
        </tr>
        <!-- Add more rows as needed -->
      </tbody>
    </table>
        </div>

        <h1>add titles</h1>
        <div class="row">
            <div class="col-12">
                <form @submit.prevent="store()" class="custom-form">
                    <div class="form-group">
                        <label for="title">title:</label>
                        <input
                            type="text"
                            class="form-control"
                            id="title"
                            placeholder="Enter your title"
                            v-model.trim="title"
                        />
                        <div v-if="titleVal" class="alert alert-danger">
                            title is required must be text
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="desc">description:</label>
                        <input
                            type="text"
                            class="form-control"
                            id="desc"
                            placeholder="Enter your desc"
                            v-model.trim="desc"
                        />
                        <div v-if="descVal" class="alert alert-danger">
                            desc is required must be text
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="file">file:</label>
                        <input class="form-control"  id="file" type="file" ref="fileInput" @change="handleFileUpload">
                        <div v-if="fileVal" class="alert alert-danger">
                            file is required must be file ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'avi', 'mov']
                        </div>
                    </div>
                    <div class="form-group" style="    text-align: center;">
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </div>

                </form>
            </div>
        </div>
        <div class="row" style="height: 80px"></div>
    </div>
</template>
<script>
export default {
    components: {},

    data() {
        return {
            databaseErrors: null,
            title: "",
            desc: "",
            file: "",

            titleVal: false,            
            descVal: false,
            fileVal: false,
            validExtensions : ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'avi', 'mov'],

            results: [],
        };
    },
    methods: {
        store() {
            const fileExtension = this.file.name.split('.').pop().toLowerCase();
            this.titleVal = typeof this.title !== "string" || this.title === "";
            this.descVal = typeof this.desc !== "string" || this.desc === "";
            this.fileVal = !this.validExtensions.includes(fileExtension) || this.file.name === "";

            if (
                this.titleVal || this.descVal  || this.fileVal
            ) {
                return;
            }

            const formData = new FormData();
            formData.append('title', this.title);
            formData.append('desc', this.desc);
            formData.append('file', this.file);

           

            axios.post(`http://127.0.0.1:8000/api/storeBlog`, formData)
                .then((res) => {
                    console.log(res.data.data);
                    if (res.status === 200) {
                        const updatedData=Notification.addObjectToArray(res.data.data, this.results) ;
                        console.log(updatedData);
                        this.results =updatedData;
                         Notification.success("create Blog Success");
                    }
                })
                .catch((error) => {
                    this.databaseErrors = error.response.data.data;
                    console.log(error.response.data.data);
                    console.log(error);
                });
        },deleteBlog(id){
            axios.delete(`http://127.0.0.1:8000/api/deleteBlog/${id}`)
                .then((res) => {
                    console.log(res);
                    if (res.status === 200) {
                        const updatedData = Notification.deleteObjectById(id,this.results);
                        console.log(updatedData);
                        this.results =updatedData;

                        Notification.success("Blog delete Success");
                    }
                })
                .catch((error) => {
                    this.databaseErrors = error.response.data.message;
                    console.log(error.response.data.message);
                    console.log(error);
                });

        },
        handleFileUpload() {
      this.file = this.$refs.fileInput.files[0];
      console.log(this.file);
    },
    },
    created() {
        axios
            .get(`http://127.0.0.1:8000/api/showBlog`)
            .then((res) => {
                console.log(res.data.data);
                this.results = res.data.data;
            })
            .catch((error) => {
                console.log(error);
            });
    },
};
</script>

<style scoped>
/* Custom CSS for the form */
.custom-form {
    border: 2px solid #223a66;
    border-radius: 10px;
    padding: 20px;
    background-color: #f8f9fa;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
</style>