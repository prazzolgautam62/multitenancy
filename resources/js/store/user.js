import { defineStore } from 'pinia';

export const useUserStore = defineStore({
  id: 'user',
  state: () => ({
    user: JSON.parse(localStorage.getItem('USER')) || null,
    accessToken: localStorage.getItem('ACCESS_TOKEN') || null,
  }),
  getters: {
    getUser() {
      return this.user;
    },
    getAccessToken() {
      return this.accessToken;
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
    resetUser(){
      this.user= null;
      this.accessToken = null;
      localStorage.setItem('USER', null);
      localStorage.setItem('ACCESS_TOKEN', null);
    }
  },
});
