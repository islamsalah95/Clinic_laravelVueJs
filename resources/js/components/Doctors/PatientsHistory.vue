<template>
    <div class="container">
      <div class="row" style="height: 63px"></div>


      <div class="row">
      <div class="col-12">
        <h3 style="text-align: center">select Patient</h3>
        <form @submit.prevent="myPatientHistories()">

          <div class="form-group">
            <label for="patientId">Patients:</label>
            <select class="form-control" id="patientId" v-model.trim="patientId">
              <option disabled value="">Choose Patients</option>
              <option
                v-for="result in results"
                :key="result.id"
                :value="result.id"
              >
              {{ result.name }}
              </option>
            </select>
            <div v-if="patientIdVal" class="alert alert-danger">
                patient Id is required
            </div>
          </div>


          <div class="form-group" style="text-align: center">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>

    <div class="row" style="height: 63px"></div>

      <div class="row">
          <div class="col-12">
          <h3 style="text-align: center">History Patient</h3>
        </div>

        <div class="col-12">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">DoctorName</th>
                <th scope="col">PatientName</th>
                <th scope="col">services</th>
                <th scope="col">medcine notice</th>
                <th scope="col">Sum Services</th>
                <th scope="col">created_at</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="PatientHistorie in PatientHistories" :key="PatientHistorie.id">
                <th>{{ PatientHistorie.doctor.name }}</th>
                <th>{{ PatientHistorie.patient.name }}</th>
                <th>
                    <!-- {{ PatientHistorie.services }} -->
                    <ul>
                        <li v-for="service in PatientHistorie.services" :key="service.id">{{service.service}} : {{service.price}} EGP</li>
                    </ul>
                </th>
                <th>{{ PatientHistorie.medcine_notice }}</th>
                <th>{{ sumPrice(PatientHistorie.services) }}</th>
                <th>{{  time(PatientHistorie.created_at) }}</th>
              </tr>




            </tbody>
          </table>
        </div>
        <div v-if="PatientHistories.length === 0 ">No History for this Patient</div>
      </div>
      </div>
    </div>
  </template>

  <script>
  export default {
    components: {},
    data() {
      return {
        results: '',
        PatientHistories:[],
        patientId:'',
        patientIdVal:false
      };
    },

    created() {
      axios
        .get(`http://127.0.0.1:8000/api/patients`)
        .then((res) => {
          console.log(res.data.data);
          this.results = res.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    methods: {
      time(dateStr) {
        const timePassed = Notification.calculateTimePassed(dateStr);
        return timePassed;
      },
      myPatientHistories(){
    //     this.patientIdVal = this.patientId === "" ;
    //   if (this.patientId) {
    //     return;
    //   }
        axios
        .get(`http://127.0.0.1:8000/api/showPatienthistoryDoctor/${this.patientId}`)
        .then((res) => {
          console.log(res.data.data);
          this.PatientHistories = res.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
      }
      ,sumPrice(services){
       var counter=0;
        for (let index = 0; index < services.length; index++) {
            counter+= services[index].price;            
        }
        return counter;

    }

    }
  };
  </script>
