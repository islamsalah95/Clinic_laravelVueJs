<template>
    <section class="section appoinment">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="appoinment-content">
                        <img src="http://127.0.0.1:8000/theme/images/about/img-3.jpg" alt="" class="img-fluid">
                        <div class="emergency">
                            <h2 class="text-lg"><i class="icofont-phone-circle text-lg"></i>+23 345 67980</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-10">
                    <div>
                        <ul v-if="databaseErrors" class="alert alert-danger">
                            <li v-if="databaseErrors">{{ databaseErrors }}</li>

                        </ul>
                    </div>
                    <div class="appoinment-wrap mt-5 mt-lg-0">
                        <h2 class="mb-2 title-color">Book appointment</h2>
                        <p class="mb-4">Mollitia dicta commodi est recusandae iste, natus eum asperiores corrupti qui velit.
                            Iste dolorum atque similique praesentium soluta.</p>

                        <form @submit.prevent="formAppointment" multiple="true" class="appoinment-form" method="post">

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <select class="form-control" id="exampleFormControlSelect1"
                                            v-model="selectedDepartment" @input="departmentId($event.target.value)">
                                            <option disabled value="">Choose Department</option>
                                            <option v-for="department in departments" :key="department.id"
                                                :value="department.id">{{ department.department }}</option>
                                        </select>
                                    </div>
                                    <div v-if="departVal" class="alert alert-danger">depar is required</div>
                                </div>


                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <select class="form-control" id="exampleFormControlSelect22" v-model="doctor_id"
                                            @change="DoctorDaysAvilable">
                                            <option disabled value="">Choose doctor</option>
                                            <option v-for="doctor in doctors" :key="doctor.id" :value="doctor.id">
                                                {{ doctor.name }}</option>
                                        </select>
                                    </div>
                                    <div v-if="doctor_idVal" class="alert alert-danger">doctor is required</div>

                                </div>


                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <select class="form-control" id="exampleFormControlSelect2" v-model="selectedDay">
                                            <option disabled value="">Choose day</option>
                                            <option v-for="day in days" :key="day.id" :value="day">{{ day }}</option>
                                        </select>
                                    </div>
                                    <div v-if="dayVal" class="alert alert-danger">day is required</div>

                                </div>



                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input name="phone" id="phone" type="Number" class="form-control" v-model="phone"
                                            placeholder="Phone Number">
                                    </div>
                                    <div v-if="phoneVal" class="alert alert-danger">phone is required</div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-main btn-round-full">Make Appointment <i
                                    class="icofont-simple-right ml-2"></i></button>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    components: {
    },

    data() {
        return {
            departments: [],
            doctors: [],
            days: [],
            selectedDay: '',
            doctor_id: '',
            selected: '',
            selectedDepartment: '',
            phone: '',
            regexPhone: /^01[0125][0-9]{8}$/,
            departVal: false,
            phoneVal: false,
            dayVal: false,
            doctor_idVal: false,
            databaseErrors:''

        };
    },
    methods: {
        departmentId(departmentId) {
            this.displayDoctors(departmentId);
        },

        displayDoctors(DepartmentId) {
            axios.get(`http://127.0.0.1:8000/api/DepartmentDoctors/${DepartmentId}`)
                .then((res) => {
                    // console.log(res.data.data);
                    this.doctors = res.data.data;
                })
                .catch((error) => { console.log(error); });
        },
        DoctorDaysAvilable() {
            console.log(this.doctor_id);
            axios.get(`http://127.0.0.1:8000/api/DoctorDaysAvilable/${this.doctor_id}`)
                .then((res) => {
                    // console.log(res.data.data);
                    this.days = res.data.data;
                })
                .catch((error) => { console.log(error); });
        }, formAppointment() {
            this.phoneVal = this.phone === '';
            this.dayVal = this.selectedDay === '';
            this.doctor_idVal = this.doctor_id === '';
            this.departVal = this.selectedDepartment === '';

            
            if (this.phoneVal, this.dayVal, this.doctor_idVal) {
                return;
            }

            axios.post(`http://127.0.0.1:8000/api/storeVisit`, {
                doctor_id: this.doctor_id,
                day: this.selectedDay,
                phone: this.phone,
            }).then((res) => {
                console.log(res.data.data.token);
                console.log(res.status);
                if (res.status === 200) {
                    // console.log(res);
                    Notification.success('Appointment fail success');
                    this.$router.replace('/Patients');

                }
            }).catch((error) => {
                this.databaseErrors = error.response.data.message;
                Notification.error(error.response.data.message);
                // console.log(error.response.data.message);
                // console.log(error);

            });

        }
    }
    , created() {
        axios.get(`http://127.0.0.1:8000/api/showDepartment`)
            .then((res) => {
                // console.log(res.data.data);
                this.departments = res.data.data;
            })
            .catch((error) => { console.log(error); });
        this.displayDoctors(1);
        this.DoctorDaysAvilable();

    }, computed: {


    }

};
</script>