<script setup>
import { ref } from "vue";
import { useUserStore } from "../../store/user";
import { useRoute } from "vue-router";
const userStore = useUserStore();
const route = useRoute();
const adminMenus = ref([
  {
    name: "admin",
    displayName: "Dashboard",
    iconClass: "zmdi zmdi-home",
    children: []
  },
  {
    name: "tenants",
    displayName: "Tenants",
    iconClass: "zmdi zmdi-view-list",
    children: []
  }
  // {
  //   name: "app",
  //   displayName: "App",
  //   iconClass: "zmdi zmdi-apps",
  //   children: [
  //     {
  //       name: "email",
  //       displayName: "Email"
  //     }
  //   ]
  // }
]);
const tenantMenus = ref([
  {
    name: "home",
    displayName: "Dashboard",
    iconClass: "zmdi zmdi-home",
    children: []
  }
]);
</script>

<template>
  <aside id="leftsidebar" class="sidebar">
    <div class="navbar-brand">
      <button class="btn-menu ls-toggle-btn" type="button">
        <i class="zmdi zmdi-menu"></i>
      </button>
      <a>
        <img :src="'dashboard/assets/images/logo.svg'" width="25" alt="Aero" />
        <span class="m-l-10">Multitenancy</span>
      </a>
    </div>
    <div class="menu">
      <ul class="list">
        <li>
          <div class="user-info">
            <a class="image" href="profile.html">
              <img :src="'dashboard/assets/images/profile_av.jpg'" alt="User" />
            </a>
            <div class="detail">
              <h4>{{userStore.getUser.name}}</h4>
              <small>{{userStore.getUser.role == 1 ? 'Super Admin' : 'Tenant'}}</small>
            </div>
          </div>
        </li>
        <template v-if="!userStore.getUser.tenant_id">
          <li
            class
            v-for="(menu,index) in adminMenus"
            :key="'menu-'+index"
            :class="route.name == menu.name ? 'active open' : ''"
          >
            <router-link :to="{ name: menu.name }" v-if="!menu.children.length">
              <i :class="menu.iconClass"></i>
              <span>{{menu.displayName}}</span>
            </router-link>
            <template v-else>
              <a href="javascript:void(0);" class="menu-toggle">
                <i :class="menu.iconClass"></i>
                <span>{{menu.displayName}}</span>
              </a>
              <ul class="ml-menu">
                <li
                  v-for="(child,childIndex) in menu.children"
                  :key="'child-'+childIndex+index"
                  :class="route.name == child.name ? 'menu-child active' : 'menu-child'"
                >
                  <router-link :to="{ name: child.name }">{{child.displayName}}</router-link>
                </li>
              </ul>
            </template>
          </li>
        </template>
        <template v-else>
          <li
            class
            v-for="(menu,index) in tenantMenus"
            :key="'menu-'+index"
            :class="route.name == menu.name ? 'active open' : ''"
          >
            <router-link :to="{ name: menu.name }" v-if="!menu.children.length">
              <i :class="menu.iconClass"></i>
              <span>{{menu.displayName}}</span>
            </router-link>
            <template v-else>
              <a href="javascript:void(0);" class="menu-toggle">
                <i :class="menu.iconClass"></i>
                <span>{{menu.displayName}}</span>
              </a>
              <ul class="ml-menu">
                <li
                  v-for="(child,childIndex) in menu.children"
                  :key="'child-'+childIndex+index"
                  :class="route.name == child.name ? 'menu-child active' : 'menu-child'"
                >
                  <router-link :to="{ name: child.name }">{{child.displayName}}</router-link>
                </li>
              </ul>
            </template>
          </li>
        </template>
        <li>
          <div class="progress-container progress-primary m-t-10">
            <span class="progress-badge">Traffic this Month</span>
            <div class="progress">
              <div
                class="progress-bar progress-bar-warning"
                role="progressbar"
                aria-valuenow="67"
                aria-valuemin="0"
                aria-valuemax="100"
                style="width: 67%;"
              >
                <span class="progress-value">67%</span>
              </div>
            </div>
          </div>
          <div class="progress-container progress-info">
            <span class="progress-badge">Server Load</span>
            <div class="progress">
              <div
                class="progress-bar progress-bar-warning"
                role="progressbar"
                aria-valuenow="86"
                aria-valuemin="0"
                aria-valuemax="100"
                style="width: 86%;"
              >
                <span class="progress-value">86%</span>
              </div>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </aside>
</template>