<template>
  <div class="container">
    <div class="row" style="height: 63px"></div>
    <div class="row">
        <div class="col-12">
        <h3 style="text-align: center">Today Appointment</h3>
      </div>

      <div class="col-12">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">day</th>
              <th scope="col">hour</th>
              <th scope="col">phone</th>
              <th scope="col">created at</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="resultsVisit in resultsVisits" :key="resultsVisit.id">
              <th>{{ resultsVisit.patient.name }}</th>
              <th>{{ resultsVisit.day }}</th>
              <th>{{ resultsVisit.hour }}:00</th>
              <th>{{ resultsVisit.phone }}</th>
              <th>
                Days:{{ test(resultsVisit.created_at).daysPassed }},Hours:{{
                  test(resultsVisit.created_at).hoursPassed
                }}
              </th>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    </div>

    <!-- <button type="submit" class="btn btn-main btn-round-full" @click="test"></button>  -->
  </div>
</template>

<script>
export default {
  components: {},

  data() {
    return {
      resultsVisits: [],
    };
  },

  created() {
    axios
      .get(`http://127.0.0.1:8000/api/showDoctorVisits`)
      .then((res) => {
        console.log(res.data.data);
        this.resultsVisits = res.data.data;
      })
      .catch((error) => {
        console.log(error);
      });
  },
  methods: {
    test(dateStr) {
      const timePassed = Notification.calculateTimePassed(dateStr);
      return timePassed;
    },
  },
};
</script>