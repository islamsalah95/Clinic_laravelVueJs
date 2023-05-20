<template>
  <div class="container">
    <div class="row" style="height: 63px"></div>
    <div class="row">
      <div class="table-responsive">
        <table class="table">
          <caption>
            List of users
          </caption>
          <thead>
            <tr>
              <th scope="col">doctor</th>
              <th scope="col">day</th>
              <th scope="col">hour</th>
              <th scope="col">created at</th>
            </tr>
          </thead>
          <tbody>
            
            <tr v-for="result in results" :key="result.id">
              <th>{{ result.doctor.name }}</th>
              <th>{{ result.day }}</th>
              <th>{{ result.hour}}:00</th>
              <th>Days:{{test(result.created_at).daysPassed}},Hours:{{test(result.created_at).hoursPassed}}</th>
            </tr>
         
        </tbody>
        </table>
      </div>
    </div>
    <!-- <button type="submit" class="btn btn-main btn-round-full" @click="test"></button>  -->
  </div>
</template>

<script>
export default {

  data() {
  return {
      results: [],
  };
  },
  methods: {
    test(dateStr){
const timePassed = Notification.calculateTimePassed(dateStr);
return timePassed;
    }
  }
,created() {
      axios.get(`http://127.0.0.1:8000/api/showPatientVisits`)
      .then((res) => {console.log(res.data.data);
       this.results=res.data.data;
       })
      .catch((error) => {console.log(error);});
},

};
</script>