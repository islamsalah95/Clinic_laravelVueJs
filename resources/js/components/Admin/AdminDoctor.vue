<template>
    <div class="container">
        <div class="row" style="height: 80px"></div>
        <h1>Doctors</h1>
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
        <section class="section doctors">
            <div class="container">
                <div class="col-12 text-center mb-5">
                    <div
                        class="btn-group btn-group-toggle"
                        data-toggle="buttons"
                    >
                        <label
                            v-for="department in departments"
                            :key="department.id"
                            class="btn"
                            @click="departmentId(department.id)"
                        >
                            <input
                                type="radio"
                                name="shuffle-filter"
                                value="cat1"
                            />{{ department.department }}
                        </label>
                    </div>
                </div>

                <div class="row shuffle-wrapper portfolio-gallery">
                    <div
                        v-for="doctor in doctors"
                        :key="doctor.id"
                        class="col-lg-3 col-sm-6 col-md-6 mb-4 shuffle-item"
                        data-groups='["cat1","cat2"]'
                    >
                        <div class="position-relative doctor-inner-box">
                            <div class="doctor-profile">
                                <div class="doctor-img">
                                    <img
                                        src="http://127.0.0.1:8000/theme/images/team/1.jpg"
                                        alt="doctor-image"
                                        class="img-fluid w-100"
                                    />
                                </div>
                            </div>
                            <div class="content mt-3">
                                <h4 class="mb-0">
                                    <a href="doctor-single.html">{{
                                        doctor.name
                                    }}</a>
                                </h4>
                                <button class="btn btn-danger" @click="deleteDoctor(doctor.id)">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <h1>add Doctors</h1>
        <div class="row">
            <div class="col-12">
                <form @submit.prevent="store()" class="custom-form">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input
                            type="text"
                            class="form-control"
                            id="name"
                            placeholder="Enter your name"
                            v-model.trim="name"
                        />
                        <div v-if="nameVal" class="alert alert-danger">
                            name is required must be text
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input
                            type="email"
                            class="form-control"
                            id="email"
                            placeholder="Enter your email"
                            v-model.trim="email"
                        />
                        <div v-if="emailVal" class="alert alert-danger">
                            email is required must be valid Email
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="department">Department ID:</label>
                        <select
                            class="form-control"
                            id="department"
                            v-model.trim="select"
                        >
                            <!-- Select options -->
                            <option disabled value="">Choose Department</option>
                            <option
                                v-for="department in departments"
                                :key="department.id"
                                :value="department.id"
                            >
                                {{ department.department }}
                            </option>
                        </select>
                        <div v-if="selectVal" class="alert alert-danger">
                            Department ID is required
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input
                            type="password"
                            class="form-control"
                            id="password"
                            placeholder="Enter your password"
                            v-model.trim="password"
                        />
                        <div v-if="passwordVal" class="alert alert-danger">
                            Password is required must strong Password for
                            example @Islam1995
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </form>
            </div>
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
            email: "",
            password: "",
            select: "",
            name: "",
            departments: [],
            selectVal: false,
            emailVal: false,
            passwordVal: false,
            nameVal: false,
            regexEmail: /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/,
            regexPassword: /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/,
            doctors: [],
        };
    },
    methods: {
        store() {
            this.nameVal = typeof this.name !== "string" || this.name === "";
            this.emailVal =
                !this.email.match(this.regexEmail) || this.email === "";
            this.passwordVal = this.password === "";
            this.selectVal = this.select === "";
            if (
                this.emailVal ||
                this.passwordVal ||
                this.selectVal ||
                this.nameVal
            ) {
                return;
            }

            axios
                .post(`http://127.0.0.1:8000/api/storeDoctor`, {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    department_id: this.select,
                })
                .then((res) => {
                    console.log(res);
                    if (res.status === 200) {
                        Notification.success("create doctor Success");
                    }
                })
                .catch((error) => {
                    this.databaseErrors = error.response.data.message;
                    console.log(error.response.data.message);
                    console.log(error);
                });
        },
        departmentId(departmentId) {
            this.displayDoctors(departmentId);
        },

        displayDoctors(DepartmentId) {
            axios
                .get(
                    `http://127.0.0.1:8000/api/DepartmentDoctors/${DepartmentId}`
                )
                .then((res) => {
                    console.log(res.data.data);
                    this.doctors = res.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },deleteDoctor(id){
            axios
                .delete(`http://127.0.0.1:8000/api/deleteDoctor/${id}`)
                .then((res) => {
                    console.log(res);
                    if (res.status === 200) {
                        Notification.success("doctor delete Success");
                    }
                })
                .catch((error) => {
                    this.databaseErrors = error.response.data.data;
                    console.log(error.response.data.data);
                    console.log(error);
                });
        }
    },
    created() {
        axios
            .get(`http://127.0.0.1:8000/api/showDepartment`)
            .then((res) => {
                console.log(res.data.data);
                this.departments = res.data.data;
            })
            .catch((error) => {
                console.log(error);
            });
        this.displayDoctors(1);
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
