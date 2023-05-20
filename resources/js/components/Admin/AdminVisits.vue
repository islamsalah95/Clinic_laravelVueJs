<template>
    <div class="container">
        <div class="row" style="height: 80px"></div>
        <h1>Visits</h1>
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
          <th>doctor</th>
          <th>patient</th>
          <th>day</th>
          <th>hour</th>
          <th>phone</th>

        </tr>
      </thead>
      <tbody>
        <tr v-for="result in results" :key="result.id">
          <td>{{result.doctor.name }}</td>
          <td>{{result.patient.name }}</td>
          <td>{{result.day}}</td>
          <td>{{result.hour}}</td>
          <td>{{result.phone}}</td>
        </tr>
        <!-- Add more rows as needed -->
      </tbody>
    </table>
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
            results: [],
        };
    },
    methods: {

    },
    created() {
        axios
            .get(`http://127.0.0.1:8000/api/showVisits`)
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