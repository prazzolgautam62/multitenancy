import './bootstrap';
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';
import ToastPlugin from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-bootstrap.css';
import App from './App.vue';
const router = createRouter({
  history: createWebHistory(),
  routes: [
   
  ],
});
const app = createApp(App);
app.use(router);
app.use(ToastPlugin);
app.mount('#app');