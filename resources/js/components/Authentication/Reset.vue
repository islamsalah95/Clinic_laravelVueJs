<template>
    <div class="container">
      <div class="row justify-content-center mt-5">
        <div class="col-6">
            <div>
                <ul v-if="databaseErrors" class="alert alert-danger">
                    <li v-if="databaseErrors">{{databaseErrors}}</li>
                </ul>
            </div>
          <div class="card">
            <div class="card-header">
            Reset
            </div>
            <div class="card-body">
              <form  @submit.prevent="reset" multiple="true">

                <div class="form-group">
                  <label for="email">Email address</label>
                  <input type="email" class="form-control" id="email" placeholder="Enter email" v-model.trim="email">
                  <div v-if="emailVal" class="alert alert-danger">email is required must be valid Email</div>
                </div>

                <div class="form-group">
                <label for="Option">Option</label>
                <select class="form-select" id="Option" aria-label="Default select example" v-model.trim="select">
                <option selected>Open this select option</option>
                <option value="Patient">Patient</option>
                <option value="Admin">Admin</option>
                <option value="Doctor">Doctor</option>
                <option value="Nurse">Nurse</option>
                </select>
                <div v-if="selectVal" class="alert alert-danger">Open this select option</div>
                <router-link to="/Login" style="color: blue;margin-left: 70px;">Login</router-link>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Reset</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    
      </template>
      
      <script>
      export default {
          components:{
        },
    
        data() {
        return {
            databaseErrors: null,
            email: '',
            select: '',
            selectVal: false,
            emailVal: false,
        };
        },
        methods: {
            reset() {
            this.emailVal = !this.email.match(this.regexEmail) || this.email === '';
            this.selectVal = this.select === '';
            if (this.emailVal || this.selectVal) {
            return;
            }
    
            axios.post(`http://127.0.0.1:8000/api/reset/${this.select}`, {
            email: this.email,
            }).then((res) => {
            console.log(res.data.data);
            console.log(res.status);
            if (res.status === 200) {
                this.emailVal="";
                Notification.success('Reset Success');
                this.$router.replace('/NewPassword');
            }
            }).catch((error) => {
                this.databaseErrors=error.response.data.message;
                console.log(error.response.data.message);
                console.log(error);
    
            });
        },
        }
        ,created(){
        if(this.$store.getters.isLogin){
            this.$router.replace('/');
        }
    }
    
      };
      </script>
  