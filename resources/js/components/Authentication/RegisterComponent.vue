<template>
    <div class="container">
      <div class="row justify-content-center mt-5">
        <div class="col-6">
            <div>
                <ul v-if="databaseErrors" class="alert alert-danger">
                    <li v-if="databaseErrors.name">{{databaseErrors.name}}</li>
                    <li v-if="databaseErrors.age">{{databaseErrors.age}}</li>
                    <li v-if="databaseErrors.email">{{databaseErrors.email}}</li>
                    <li v-if="databaseErrors.password">{{databaseErrors.password}}</li>
                </ul>
            </div>
          <div class="card">
            <div class="card-header">
            Register
            </div>
            <div class="card-body">
              <form  @submit.prevent="register" multiple="true">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" placeholder="Enter name"  v-model.trim="name">
                  <div v-if="nameVal" class="alert alert-danger">Name is required must be text</div>
                </div>

                <div class="form-group">
                  <label for="age">Age</label>
                  <input type="number" class="form-control" id="age" placeholder="Enter age" v-model.trim="age">
                  <div v-if="ageVal" class="alert alert-danger">Age is required must be number</div>
                </div>

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
                  <label for="password_confirmation">password confirmation</label>
                  <input type="password" class="form-control" id="password_confirmation" placeholder="password confirmation" v-model.trim="password_confirmation">
                  <div v-if="password_confirmationVal" class="alert alert-danger">password confirmation is required must equal password</div>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Register</button>
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
            name: '',
            email: '',
            age: null,
            password: '',
            password_confirmation: '',
            nameVal: false,
            emailVal: false,
            ageVal: false,
            passwordVal: false,
            password_confirmationVal: false,
            regexEmail: /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/,
            regexPassword: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,30}$/,
            api: axios.create({
            baseURL: 'http://127.0.0.1:8000/api',
            headers: {
                'Content-Type': 'application/json',
            },
            }),
        };
        },
        methods: {
        register() {
            this.nameVal = !this.name || typeof this.name !== 'string';
            this.ageVal = !this.age || isNaN(this.age);
            this.emailVal = !this.email.match(this.regexEmail) || this.email === '';
            this.passwordVal = !this.password.match(this.regexPassword) || this.password === '';
            this.password_confirmationVal = this.password_confirmation !== this.password || this.password_confirmation === '';

            if (this.nameVal || this.ageVal || this.emailVal || this.passwordVal || this.password_confirmationVal) {
            return;
            }

            axios.post('http://127.0.0.1:8000/api/Register', {
            name: this.name,
            email: this.email,
            age: this.age,
            password: this.password,
            }).then((res) => {
            console.log(res.data.data.token);
            console.log(res.status);
            if (res.status === 200) {
                console.log(res);
                localStorage.setItem("id",res.data.data.id);
                localStorage.setItem("name",res.data.data.name);
                localStorage.setItem("token",res.data.data.token);
                localStorage.setItem("typeUser","Patient");
                this.$store.dispatch('login',res.data.data);
                this.$store.dispatch('typeUser',"Patient");
                Notification.success('Register Success');
                this.$router.replace('/');
            }
            }).catch((error) => {
                this.databaseErrors=error.response.data.errors;
                console.log(error.response.data.errors);
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
  