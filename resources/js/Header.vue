<template>
    <header>
        <div class="header-top-bar">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <ul class="top-bar-info list-inline-item pl-0 mb-0">
                            <li class="list-inline-item">
                                <a href="mailto:support@gmail.com"
                                    ><i class="icofont-support-faq mr-2"></i
                                    >support@novena.com</a
                                >
                            </li>
                            <li class="list-inline-item">
                                <i class="icofont-location-pin mr-2"></i>Address
                                Ta-134/A, New York, USA
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <div class="text-lg-right top-right-bar mt-2 mt-lg-0">
                            <a href="tel:+23-345-67890">
                                <span>Call Now : </span>
                                <span class="h4">823-4565-13456</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navigation" id="navbar">
            <div class="container">
                <a class="navbar-brand" href="index.html">
                    <img src="images/logo.png" alt="" class="img-fluid" />
                </a>

                <button
                    class="navbar-toggler collapsed"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarmain"
                    aria-controls="navbarmain"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="icofont-navigation-menu"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarmain">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <router-link to="/" class="nav-link"
                                >Home</router-link
                            >
                        </li>

                        <li class="nav-item">
                            <router-link to="/Services" class="nav-link"
                                >Services</router-link
                            >
                        </li>

                        <li class="nav-item">
                            <router-link to="/Departments" class="nav-link"
                                >Departments</router-link
                            >
                        </li>

                        <li class="nav-item">
                            <router-link to="/Doctors" class="nav-link"
                                >Doctors</router-link
                            >
                        </li>

                        <li class="nav-item">
                            <router-link to="/Blogs" class="nav-link"
                                >Blogs</router-link
                            >
                        </li>

                        <li class="nav-item">
                            <router-link to="/About" class="nav-link"
                                >About</router-link
                            >
                        </li>

                        <li class="nav-item">
                            <router-link to="/Contact" class="nav-link"
                                >Contact</router-link
                            >
                        </li>

                        <li v-if="!isLogin" class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle"
                                href="blog-sidebar.html"
                                id="dropdown05"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                                >Login<i class="icofont-thin-down"></i
                            ></a>
                            <ul
                                class="dropdown-menu"
                                aria-labelledby="dropdown05"
                            >
                                <li>
                                    <router-link to="/Login" class="nav-link"
                                        >Login</router-link
                                    >
                                </li>
                                <li>
                                    <router-link to="/Register" class="nav-link"
                                        >Register</router-link
                                    >
                                </li>
                            </ul>
                        </li>

                        <!-- patient -->
                        <li v-if="isLogin" class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle"
                                href="blog-sidebar.html"
                                id="dropdown05"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                                >Dashboard <i class="icofont-thin-down"></i
                            ></a>
                            <ul
                                v-if="typeUser === 'Patient'"
                                class="dropdown-menu"
                                aria-labelledby="dropdown05"
                            >
                                <li>
                                    <router-link
                                        to="/PatientsHistoryAppointment"
                                        class="nav-link"
                                        >My Appointment</router-link
                                    >
                                </li>
                                <li>
                                    <router-link
                                        to="/ReserveAppointments"
                                        class="nav-link"
                                        >Reserve Appointments</router-link
                                    >
                                </li>
                            </ul>

                            <ul
                                v-if="typeUser === 'Doctor'"
                                class="dropdown-menu"
                                aria-labelledby="dropdown05"
                            >
                                <li>
                                    <router-link
                                        to="/addHistory"
                                        class="nav-link"
                                        >add History</router-link
                                    >
                                </li>
                                <li>
                                    <router-link
                                        to="/todayAppointments"
                                        class="nav-link"
                                        >Today Appointments</router-link
                                    >
                                </li>
                                <li>
                                    <router-link
                                        to="/PatientsHistory"
                                        class="nav-link"
                                        >Patients History</router-link
                                    >
                                </li>
                            </ul>

                            <ul
                                v-if="typeUser === 'Admin'"
                                class="dropdown-menu"
                                aria-labelledby="dropdown05"
                            >
                                <li>
                                    <router-link
                                        to="/AdminBlog"
                                        class="nav-link"
                                        >AdminBlog</router-link
                                    >
                                </li>
                                <li>
                                    <router-link
                                        to="/AdminDepartment"
                                        class="nav-link"
                                        >AdminDepartment</router-link
                                    >
                                </li>
                                <li>
                                    <router-link
                                        to="/AdminDoctor"
                                        class="nav-link"
                                        >AdminDoctor</router-link
                                    >
                                </li>
                                <li>
                                    <router-link
                                        to="/AdminNurse"
                                        class="nav-link"
                                        >AdminNurse</router-link
                                    >
                                </li>
                                <li>
                                    <router-link
                                        to="/AdminService"
                                        class="nav-link"
                                        >AdminService</router-link
                                    >
                                </li>
                                <li>
                                    <router-link
                                        to="/AdminVisits"
                                        class="nav-link"
                                        >AdminVisits</router-link
                                    >
                                </li>
                                <li>
                                    <router-link
                                        to="/PatientsHistory"
                                        class="nav-link"
                                        >Patients History</router-link
                                    >
                                </li>
                            </ul>
                        </li>



                        <li v-if="isLogin" class="nav-item dropdown">
                            <a
                            @mouseleave="markAsRead()"
                                class="nav-link dropdown-toggle"
                                href="blog-sidebar.html"
                                id="dropdown05"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                            >
                                <img
                                    src="http://127.0.0.1:8000/bell.svg"
                                    alt=""
                                />
                                <span v-if="counter !==0">{{counter}}</span>
                            </a>
                            <ul
                                class="dropdown-menu"
                                aria-labelledby="dropdown05"
                            >
                            
                                <li v-for="unreadNotification in unreadNotifications" :key="unreadNotification.id">{{unreadNotification.desc}}</li>
                            </ul>
                        </li>

                        <li v-if="isLogin" class="nav-item">
                            <button class="btn btn-danger" @click="logout()">
                                logout
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</template>
<script>
export default {
    name: "Header",
    components: {},
    data() {
        return {
            results: [],
            userId: this.$store.getters.id,
            unreadNotifications:[],
            counter:0
        };
    },
    created() {
        if (localStorage.getItem("token")) {
            this.$store.dispatch("autoLogin");
        }
        axios.get(`http://127.0.0.1:8000/api/unreadNotifications`)
            .then((res) => {
                console.log(res.data.data);
               var myData=[];
                for (let index = 0; index < res.data.data.length; index++) {
                    myData.push(res.data.data[index].data.data);
                }
                this.unreadNotifications = myData;
            })
            .catch((error) => {
                console.log(error);
            });


    },
    methods: {
        logout() {
            const headers = { Authorization: this.$store.getters.token };
            axios
                .post(`http://127.0.0.1:8000/api/logout`, { headers })
                .then((response) => {
                    console.log(response);
                    this.$store.dispatch("logout");
                    this.$router.replace("/");
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        markAsRead() {
            const headers = { Authorization: this.$store.getters.token };
            axios
                .get(`http://127.0.0.1:8000/api/markAsRead`, { headers })
                .then((response) => {
                    console.log(response.data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    mounted() {
        Echo.private("private-channel." + this.$store.getters.id).notification(
            (notification) => {
                console.log(notification.data);
                this.unreadNotifications.push(notification.data);
                this.counter ++;
            }
        );
    },
    computed: {
        isLogin: function () {
            return this.$store.getters.isLogin;
        },
        typeUser: function () {
            return this.$store.getters.typeUser;
        },
    },
};
</script>
