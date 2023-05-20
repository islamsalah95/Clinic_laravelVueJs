import './bootstrap';
import {createApp} from 'vue/dist/vue.esm-bundler.js';
import router from './route/index';
import Header from './Header.vue';
import Footer from './Footer.vue';
import store from './Vuex/store.js';
  // Import Notification Class
  import Notification from './Helpers/Notifications.js';
  window.Notification = Notification;

const app = createApp({});
app.component('header-component', Header);
app.component('footer-component', Footer);

app.use(router);
app.use(store)
app.mount("#app");







