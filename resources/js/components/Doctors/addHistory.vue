<template>
  <div class="container">
    <div class="row" style="height: 30px"></div>
    <div class="row">
      <div class="col-12">
        <h3 style="text-align: center">Add History For Patient</h3>
        <form @submit.prevent="store()">
          <div>
            <ul v-if="databaseErrors" class="alert alert-danger">
              <li v-if="databaseErrors.visit_id">
                {{ databaseErrors.visit_id }}
              </li>
              <li v-if="databaseErrors.service_id">
                {{ databaseErrors.service_id }}
              </li>
            </ul>
          </div>
          <div class="form-group">
            <label for="visit_id">visit:</label>
            <select class="form-control" id="visit_id" v-model.trim="visit_id">
              <option disabled value="">Choose visit</option>
              <option
                v-for="resultsVisit in resultsVisits"
                :key="resultsVisit.id"
                :value="resultsVisit.id"
              >
                hour:{{ resultsVisit.hour }}
              </option>
            </select>
            <div v-if="visit_idVal" class="alert alert-danger">
              visit is required
            </div>
          </div>

          <div class="form-group">
            <div
              v-for="resultsService in resultsServices"
              :key="resultsService.id"
            >
              <label :for="'jack' + resultsService.id">{{
                resultsService.service
              }}</label>
              <input
                class="form-control"
                type="checkbox"
                :id="'jack' + resultsService.id"
                :value="resultsService.id"
                v-model="service_id"
              />
            </div>

            <div v-if="resultsServices.length === 0" class="alert alert-danger">
              Service is required
            </div>
          </div>
          <div class="form-group">
            <label for="medcine_text">Medicine Text:</label>
            <textarea
              class="form-control"
              id="medcine_text"
              placeholder="Enter Medicine Text"
              v-model.trim="medcine_notice"
            ></textarea>
          </div>

          <div class="form-group" style="text-align: center">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  components: {},

  data() {
    return {
      databaseErrors: null,
      visit_id: "",
      service_id: [],
      medcine_notice: "",
      visit_idVal: false,
      service_idVal: false,
      resultsServices: [],
      resultsVisits: [],
      databaseErrors: "",
    };
  },
  methods: {
    store() {
      this.visit_idVal = this.visit_id === "" || isNaN(this.visit_id);
      this.service_idVal = this.service_id === "";
      if (this.visit_idVal || this.service_idVal) {
        return;
      }

      axios
        .post(`http://127.0.0.1:8000/api/storePatientHistory`, {
          visit_id: this.visit_id,
          service_id: this.service_id,
          medcine_notice: this.medcine_notice,
        })
        .then((res) => {
          console.log(res.data.data.token);
          console.log(res.status);
          if (res.status === 200) {
            console.log(res);
            Notification.success("store patient History Success");
          }
        })
        .catch((error) => {
          this.databaseErrors = error.response.data;
          console.log(error.response.data);
          console.log(error);
        });
    },
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

    axios
      .get(`http://127.0.0.1:8000/api/showDoctorServices`)
      .then((res) => {
        console.log(res.data.data);
        this.resultsServices = res.data.data;
      })
      .catch((error) => {
        console.log(error);
      });
  },
};
</script>