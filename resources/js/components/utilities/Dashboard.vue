<script setup>
import Menu from "./Menu.vue";
import RightMenu from "./RightMenu.vue";
import { onMounted, ref } from "vue";
import { useRouter } from "vue-router";
import { useUserStore } from "../../store/user";
import { _logout } from "../../service/auth";

const userStore = useUserStore();
const router = useRouter();

const logout = () => {
  _logout()
    .then(response => {
      if (response.status) {
        userStore.resetUser();
        router.push({
          name: "login"
        });
      } else {
        console.log("error", response.message);
      }
    })
    .catch(err => {
      console.log(err);
    });
};
</script>

<style scoped>
.mega-menu {
  cursor: pointer;
}
</style>

<template>
  <div>
    <div id="search">
      <button
        id="close"
        type="button"
        class="close btn btn-primary btn-icon btn-icon-mini btn-round"
      >x</button>
      <form>
        <input type="search" value placeholder="Search..." />
        <button type="submit" class="btn btn-primary">Search</button>
      </form>
    </div>
    <!-- Right Icon menu Sidebar -->
    <div class="navbar-right">
      <ul class="navbar-nav">
        <li>
          <a href="#search" class="main_search" title="Search...">
            <i class="zmdi zmdi-search"></i>
          </a>
        </li>
        <li>
          <a href="javascript:void(0);" class="js-right-sidebar" title="Setting">
            <i class="zmdi zmdi-settings zmdi-hc-spin"></i>
          </a>
        </li>
        <li>
          <a @click="logout" class="mega-menu" title="Sign Out">
            <i class="zmdi zmdi-power"></i>
          </a>
        </li>
      </ul>
    </div>

    <!-- Left Sidebar -->
    <Menu />

    <!-- Right Sidebar -->
    <RightMenu />

    <section class="content">
      <router-view></router-view>
    </section>
  </div>
</template>