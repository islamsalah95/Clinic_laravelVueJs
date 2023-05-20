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
          <th>department</th>
          <th>actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="result in results" :key="result.id">
          <td>{{result.id}}</td>
          <td>{{result.department}}</td>
          <td><button class="btn btn-danger" @click="deletedepartment(result.id)">Delete</button></td>
        </tr>
        <!-- Add more rows as needed -->
      </tbody>
    </table>
        </div>

        <h1>add departments</h1>
        <div class="row">
            <div class="col-12">
                <form @submit.prevent="store()" class="custom-form">
                    <div class="form-group">
                        <label for="department">department:</label>
                        <input
                            type="text"
                            class="form-control"
                            id="department"
                            placeholder="Enter your department"
                            v-model.trim="department"
                        />
                        <div v-if="departmentVal" class="alert alert-danger">
                            department is required must be text
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
            department: "",
            departmentVal: false,
            results: [],
        };
    },
    methods: {
        store() {
            this.departmentVal = typeof this.department !== "string" || this.department === "";
            if (
                this.departmentVal
            ) {
                return;
            }

            axios
                .post(`http://127.0.0.1:8000/api/storeDepartment`, {
                    department: this.department,
                })
                .then((res) => {
                    console.log(res);
                    if (res.status === 200) {
                        const updatedData=Notification.addObjectToArray({department: this.department}, this.results) ;
                        console.log(updatedData);
                        this.results =updatedData;
                         Notification.success("create department Success");
                    }
                })
                .catch((error) => {
                    this.databaseErrors = error.response.data.message;
                    console.log(error.response.data.message);
                    console.log(error);
                });
        },deletedepartment(id){
            axios
                .delete(`http://127.0.0.1:8000/api/deleteDepartment/${id}`)
                .then((res) => {
                    console.log(res);
                    if (res.status === 200) {
                        const updatedData = Notification.deleteObjectById(id,this.results);
                        console.log(updatedData);
                        this.results =updatedData;

                        Notification.success("department department Success");
                    }
                })
                .catch((error) => {
                    this.databaseErrors = error.response.data.message;
                    console.log(error.response.data.message);
                    console.log(error);
                });

        },
     deleteObjectById(id, array) {
        const index = array.findIndex(obj => obj.id === id);
        
        if (index !== -1) {
            array.splice(index, 1);
        }
        
        return array;
        }
    },
    created() {
        axios
            .get(`http://127.0.0.1:8000/api/showDepartment`)
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