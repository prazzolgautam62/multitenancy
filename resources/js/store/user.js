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
  },
});
