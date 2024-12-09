import { defineStore } from 'pinia';

export const useUserStore = defineStore({
  id: 'user',
  state: () => ({
    user: JSON.parse(localStorage.getItem('USER')) || null,
    accessToken: localStorage.getItem('ACCESS_TOKEN') || null,
    theme: localStorage.getItem('THEME') || 'light',
  }),
  getters: {
    getUser() {
      return this.user;
    },
    getConfiguration() {
      return this.user ? (this.user.tenant ? this.user.tenant.configuration : {}) : {};
    },
    getAccessToken() {
      return this.accessToken;
    },
    getTheme(){
      return this.theme;
    },
    isAuth(){
      return this.user != null && this.accessToken ? true : false;
    },
    typeAdmin(){
      return this.user != null && this.user.tenant_id == null;
    },
    normalUser(){
      return this.user && this.user.tenant_id;
    }
  },
  actions: {
    setUser(user) {
      this.user = user;
      localStorage.setItem('USER', JSON.stringify(user));
    },
    setAccessToken(token) {
      this.accessToken = token;
      localStorage.setItem('ACCESS_TOKEN', token);
    },
    setTheme(theme){
      this.theme = theme;
      localStorage.setItem('THEME',theme);
    },
    resetUser(){
      this.user= null;
      this.accessToken = null;
      this.theme = 'light';
      localStorage.setItem('USER', null);
      localStorage.setItem('ACCESS_TOKEN', null);
      localStorage.setItem('THEME', 'light');
    }
  },
});
