<script setup>
import { useRouter } from 'vue-router';
import { useUserStore } from '../../store/user';
import { _logout } from "../../service/auth";

const userStore = useUserStore();
const router = useRouter();

const logout = () =>{
    _logout()
        .then((response) => {
          if(response.status){
            userStore.resetUser();
            router.push({
              name: "login",
            });
          }
          else{
            console.log('error',response.message);
          }
        })
        .catch((err) => {
          console.log(err);
        });
}

</script>

<style scoped>
.navbar .logout{
  cursor: pointer;
}
</style>

<template>
  <div>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <div class="navbar-collapse collapse w-100 order-1 order-md-0 px-2 dual-collapse2">
        <a class="navbar-brand" href="#">Left</a>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="//codeply.com">Codeply</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
        </ul>
      </div>
      <div class="navbar-collapse collapse dual-collapse2 ml-auto">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link logout" @click="logout">LogOut</a>
          </li>
        </ul>
      </div>
    </nav>
    <router-view></router-view>
  </div>
</template>