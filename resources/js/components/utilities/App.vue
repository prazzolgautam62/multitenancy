<script setup>
import { ref, computed } from 'vue';
import Dashboard from './Dashboard.vue';
import { useUserStore } from '../../store/user';
const userStore = useUserStore();
const isAuth = computed(() => userStore.isAuth);
</script>


<template>
    <section v-if="isAuth">
        <Dashboard/>
    </section>
    <section v-else>
        <router-view></router-view>
    </section>
</template>
