<script setup>
import { ref } from 'vue'
import Dashboard from './Dashboard.vue'
const is_auth = ref(false)
</script>


<template>
    <section v-if="is_auth">
        <Dashboard/>
    </section>
    <section v-else>
        <router-view></router-view>
    </section>
</template>
