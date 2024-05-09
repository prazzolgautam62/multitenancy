
<script setup>
import { _login } from "../../service/auth";
import { ref, computed } from "vue";
import { useRouter } from 'vue-router';
import { useUserStore } from '../../store/user';
const form = ref({ email: "", password: "" });
const submitting = ref(false);
const router = useRouter();

const userStore = useUserStore();
const user = computed(() => userStore.getUser);

const submitLogin = () =>{
    submitting.value = true;
    _login(form.value)
        .then((response) => {
          if(response.status){
            submitting.value = false;
            userStore.setUser(response.user);
            userStore.setAccessToken(response.access_token);
            router.push({
              name: user.tenant_id ? "home" : "admin",
            });
          }
          else{
            console.log('error',response.message);
            submitting.value = false;
          }
        })
        .catch((err) => {
          submitting.value = false;
          console.log(err);
        });
}
</script>

<template>
  <form
    @submit.prevent="submitLogin()"
    action
    method="post"
    class="login-form"
    autocomplete="off"
  >
    <div class="form-group">
      <label class="p">Email</label>
      <input
        v-model="form.email"
        type="email"
        name="email"
        class="input"
        autocomplete="off"
        autofocus
        required
      />
    </div>

    <div class="form-group">
      <label class="p">Password</label>
      <input
        v-model="form.password"
        type="password"
        name="password"
        class="input"
        autocomplete="off"
        autofocus
        required
      />
    </div>
    <button type="submit" class="button width-100" :disabled="submitting">
      {{ submitting ? "Logging in..." : "Log in" }}
    </button>
  </form>
</template>