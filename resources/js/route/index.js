import {createRouter, createWebHistory } from "vue-router";
import Home from "../Home.vue";
import About from "../components/About/About.vue";

import AdminUpdateBlog from "../components/Admin/AdminUpdateBlog.vue";
import AdminBlog from "../components/Admin/AdminBlog.vue";
import AdminDepartment from "../components/Admin/AdminDepartment.vue";
import AdminDoctor from "../components/Admin/AdminDoctor.vue";
import AdminNurse from "../components/Admin/AdminNurse.vue";
import AdminService from "../components/Admin/AdminService.vue";
import AdminVisits from "../components/Admin/AdminVisits.vue";

import Appointments from "../components/appoinment.vue";
import Departments from "../components/Departments/Departments.vue";
import Doctors from "../components/Doctors/Doctors.vue";
import PatientsHistoryAppointment from "../components/Patients/PatientsHistoryAppointment.Vue";
import Services from "../components/Services/Services.vue";
import Blogs from "../components/Blogs/Blogs.vue";
import Contact from "../components/Contact/Contact.vue";
import LoginComponent from "../components/Authentication/LoginComponent.Vue";
import RegisterComponent from "../components/Authentication/RegisterComponent.Vue";
import Reset from "../components/Authentication/Reset.vue";
import Newpass from "../components/Authentication/Newpass.vue";

import addHistory from "../components/Doctors/addHistory.vue";
import PatientsHistory from "../components/Doctors/PatientsHistory.vue";
import todayAppointments from "../components/Doctors/todayAppointments.vue";


const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
    },
    {
        path: "/About",
        name: "About",
        component: About,
    },
    {
        path: "/AdminBlog",
        name: "AdminBlog",
        component: AdminBlog,
    },
    {
        path: "/AdminDepartment",
        name: "AdminDepartment",
        component: AdminDepartment,
    },
    {
        path: "/AdminDoctor",
        name: "AdminDoctor",
        component: AdminDoctor,
    },
    {
        path: "/AdminNurse",
        name: "AdminNurse",
        component: AdminNurse,
    },
    {
        path: "/AdminService",
        name: "AdminService",
        component: AdminService,
    },
    {
        path: "/AdminVisits",
        name: "AdminVisits",
        component: AdminVisits,
    },
    {
        path: "/AdminUpdateBlog/:id",
        name: "AdminUpdateBlog",
        component: AdminUpdateBlog,
    },
    {
        path: "/ReserveAppointments",
        name: "Appointments",
        component: Appointments,
    },
    {
        path: "/Departments",
        name: "Departments",
        component: Departments,
    },
    {
        path: "/Doctors",
        name: "Doctors",
        component: Doctors,
    },
    {
        path: "/PatientsHistoryAppointment",
        name: "PatientsHistoryAppointment",
        component: PatientsHistoryAppointment,
    },
    {
        path: "/Services",
        name: "Services",
        component: Services,
    },  
    {
        path: "/Blogs",
        name: "Blogs",
        component: Blogs,
    },  
    {
        path: "/Contact",
        name: "Contact",
        component: Contact,
    },

    {
        path: "/Login",
        name: "LoginComponent",
        component: LoginComponent,
    },
    {
        path: "/Register",
        name: "RegisterComponent",
        component: RegisterComponent,
    },
    {
        path: "/Reset",
        name: "Reset",
        component: Reset,
    },
    {
        path: "/NewPassword",
        name: "Newpass",
        component: Newpass,
    },
    {
        path: "/addHistory",
        name: "addHistory",
        component: addHistory,
    },
    {
        path: "/PatientsHistory",
        name: "PatientsHistory",
        component: PatientsHistory,
    },
    {
        path: "/todayAppointments",
        name: "todayAppointments",
        component: todayAppointments,
    },

{ path: '/:pathMatch(.*)*', component: Home },
];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes,
});

export default router;


