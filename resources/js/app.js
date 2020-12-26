require('./bootstrap');

import { createApp } from 'vue';
import App from './components/App.vue';
import router from './routes.js';
import store from './store/store';

import axios from 'axios';
axios.defaults.withCredentials = true;
axios.defaults.baseURL = 'http://127.0.0.1:8000';

const app = createApp(App);
app.use(router);
app.use(store);
app.mount('#app');
