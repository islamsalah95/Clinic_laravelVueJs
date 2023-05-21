import _ from 'lodash';
window._ = _;

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['Authorization'] = localStorage.getItem("token");
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */
// const userId=this.$store.getters.id;
const token=localStorage.getItem('token');
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
window.Pusher = Pusher;
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'eu',
    wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
    wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
    wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
    encrypted: true,
    authEndpoint: '/broadcasting/auth',
    auth: {
      headers: {
        Authorization: token,
      },
    },
});


// import Echo from 'laravel-echo';
// window.Pusher = Pusher;

// // window.Pusher = require('pusher-js');
// const userId=this.$store.getters.id;
// const token=localStorage.getItem('token');
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'd3585e30a294bb21d418',
//     cluster: 'eu',
//     encrypted:true,
//     authHost: "http://127.0.0.1:8000/broadcasting/auth",
//     authEndpoint: "/broadcasting/auth", 
//     wsPort: 8000,
//     forceTLS: true,
//         auth: {
//         headers: {
//             Authorization: token
//         }
//     }
// });

// app_id = "1604460"
// key = "d3585e30a294bb21d418"
// secret = "46c3bdd9dbfae29107c1"
// cluster = "eu"