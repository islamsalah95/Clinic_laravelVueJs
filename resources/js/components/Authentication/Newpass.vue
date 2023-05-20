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
            New password
            </div>
            <div class="card-body">
              <form  @submit.prevent="newPass" multiple="true">
                <div class="form-group">
                  <label for="code">Code</label>
                  <input type="text" class="form-control" id="code" placeholder="Enter code" v-model.trim="code">
                  <div v-if="codeVal" class="alert alert-danger">code is required must be valid code</div>
                </div>

                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" placeholder="password" v-model.trim="password">
                  <div v-if="passwordVal" class="alert alert-danger">Password is required must strong Password for example @Islam1995</div>
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
                </div>

                <button type="submit" class="btn btn-primary btn-block">New password</button>
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
        code: '',
        password: '',
        select: '',
        selectVal: false,
        codeVal: false,
        passwordVal: false,
    };
    },
    methods: {
    newPass() {
        this.codeVal =  this.code === '';
        this.passwordVal = this.password === '';
        this.selectVal = this.select === '';
        if (this.codeVal || this.passwordVal|| this.selectVal) {
        return;
        }

        axios.post(`http://127.0.0.1:8000/api/Verify/${this.select}`, {
            code: this.code,
            password: this.password,
        }).then((res) => {
        console.log(res.data.data);
        if (res.status === 200) {
            Notification.success('Update password Success');
            this.$router.replace('/Login');
        }
        }).catch((error) => {
            this.databaseErrors=error.response.data.message;
            console.log(error.response.data.message);
            console.log(error);

        });
    },
    },
    created(){
        if(this.$store.getters.isLogin){
            this.$router.replace('/');
        }
    }

  };
  </script>
  