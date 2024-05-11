import { createApp } from 'vue';
import App from './components/utilities/App.vue';
const app = createApp(App);
import { pinia } from './store';
app.use(pinia);
import { createRouter, createWebHistory } from 'vue-router';
// import './bootstrap';
// import 'bootstrap/dist/css/bootstrap.min.css';
// import 'bootstrap';
import 'vue-toast-notification/dist/theme-bootstrap.css';
import router from "./routes/index";
app.use(router);
import ToastPlugin from 'vue-toast-notification';
app.use(ToastPlugin);
app.mount('#app');