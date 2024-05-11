
<script setup>
import { _login } from "../../service/auth";
import { ref, computed } from "vue";
import { useRouter } from "vue-router";
import { useUserStore } from "../../store/user";
const form = ref({ email: "", password: "" });
const submitting = ref(false);
const router = useRouter();

const userStore = useUserStore();
const user = computed(() => userStore.getUser);

const submitLogin = () => {
  submitting.value = true;
  _login(form.value)
    .then(response => {
      if (response.status) {
        submitting.value = false;
        userStore.setUser(response.user);
        userStore.setAccessToken(response.access_token);
        router.push({
          name: user.tenant_id ? "home" : "admin"
        });
      } else {
        console.log("error", response.message);
        submitting.value = false;
      }
    })
    .catch(err => {
      submitting.value = false;
      console.log(err);
    });
};
</script>

<template>
  <div class="authentication">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-sm-12">
          <form class="card auth_form">
            <div class="header">
              <img class="logo" :src="'dashboard/assets/images/logo.svg'" alt />
              <h5>Log in</h5>
            </div>
            <div class="body">
              <form
                @submit.prevent="submitLogin()"
                action
                method="post"
                class="login-form"
                autocomplete="off"
              >
                <div class="input-group mb-3">
                  <input
                    type="email"
                    class="form-control"
                    placeholder="Email"
                    required
                    v-model="form.email"
                  />
                  <div class="input-group-append">
                    <span class="input-group-text">
                      <i class="zmdi zmdi-account-circle"></i>
                    </span>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <input
                    type="password"
                    class="form-control"
                    placeholder="Password"
                    required
                    v-model="form.password"
                  />
                  <div class="input-group-append">
                    <span class="input-group-text">
                      <a href="forgot-password.html" class="forgot" title="Forgot Password">
                        <i class="zmdi zmdi-lock"></i>
                      </a>
                    </span>
                  </div>
                </div>
                <div class="checkbox">
                  <input id="remember_me" type="checkbox" />
                  <label for="remember_me">Remember Me</label>
                </div>
                <button
                  type="submit"
                  :disabled="submitting"
                  class="btn btn-primary btn-block waves-effect waves-light"
                >{{ submitting ? "SIGNING IN ..." : "SIGN IN" }}</button>
              </form>
              <div class="signin_with mt-3">
                <p class="mb-0">or Sign Up using</p>
                <button class="btn btn-primary btn-icon btn-icon-mini btn-round facebook">
                  <i class="zmdi zmdi-facebook"></i>
                </button>
                <button class="btn btn-primary btn-icon btn-icon-mini btn-round twitter">
                  <i class="zmdi zmdi-twitter"></i>
                </button>
                <button class="btn btn-primary btn-icon btn-icon-mini btn-round google">
                  <i class="zmdi zmdi-google-plus"></i>
                </button>
              </div>
            </div>
          </form>
          <div class="copyright text-center">
            <span>
              <a href>Multitenancy</a>
            </span>
          </div>
        </div>
        <div class="col-lg-8 col-sm-12">
          <div class="card">
            <img :src="'dashboard/assets/images/signin.svg'" alt="Sign In" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>