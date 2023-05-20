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
            Login
            </div>
            <div class="card-body">
              <form  @submit.prevent="login" multiple="true">
                <div class="form-group">
                  <label for="email">Email address</label>
                  <input type="email" class="form-control" id="email" placeholder="Enter email" v-model.trim="email">
                  <div v-if="emailVal" class="alert alert-danger">email is required must be valid Email</div>
                </div>

                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" placeholder="password" v-model.trim="password">
                  <div v-if="passwordVal" class="alert alert-danger">Password is required must strong Password for example @Islam1995</div>
                </div>

                <div class="form-group">
                <label for="Option">Option</label>
                <select class="form-select" id="Option" aria-label="Default select example" v-model.trim="select">
                <option value="" disabled selected>Open this select option</option>
                <option value="Patient">Patient</option>
                <option value="Admin">Admin</option>
                <option value="Doctor">Doctor</option>
                <option value="Nurse">Nurse</option>
                </select>
                <div v-if="selectVal" class="alert alert-danger">Open this select option</div>
                <router-link to="/Reset" style="color: blue;margin-left: 70px;">Reset</router-link>
                </div>

                <button type="submit" class="btn btn-primary btn-block">login</button>
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
        password: '',
        select: '',
        selectVal: false,
        emailVal: false,
        passwordVal: false,
        regexEmail: /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/,
    };
    },
    methods: {
    login() {
        this.emailVal = !this.email.match(this.regexEmail) || this.email === '';
        this.passwordVal = this.password === '';
        this.selectVal = this.select === '';
        if (this.emailVal || this.passwordVal|| this.selectVal) {
        return;
        }

        axios.post(`http://127.0.0.1:8000/api/login/${this.select}`, {
        email: this.email,
        password: this.password,
        }).then((res) => {
        console.log(res.data.data.token);
        console.log(res.status);
        if (res.status === 200) {
            console.log(res);
            localStorage.setItem("id",res.data.data.id);
            localStorage.setItem("name",res.data.data.name);
            localStorage.setItem("token",res.data.data.token);
            localStorage.setItem("typeUser",this.select);
            this.$store.dispatch('login',res.data.data);
            this.$store.dispatch('typeUser',"Patient");
            Notification.success('login Success');
            this.$router.replace('/');
        }
        }).catch((error) => {
            this.databaseErrors=error.response.data.message;
            console.log(error.response.data.message);
            console.log(error);

        });
    },
    },created(){
        if(this.$store.getters.isLogin){
            this.$router.replace('/');
        }
    }

  };
  </script>
  
  