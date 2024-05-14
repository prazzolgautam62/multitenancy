<script setup>
import { useUserStore } from "../../store/user";
const userStore = useUserStore();
const form = {
  configuration: {
    date_type: "bs"
  }
};
form.configuration = userStore.getConfiguration.configuration;

const submitForm = () => {

};

</script>

<template>
  <div class>
    <div class="block-header">
      <div class="row">
        <div class="col-lg-7 col-md-6 col-sm-12">
          <h2>User Dashboard</h2>
          <ul class="breadcrumb">
            <li class="breadcrumb-item">
              <a>
                <i class="zmdi zmdi-home"></i> Multitenancy
              </a>
            </li>
            <li class="breadcrumb-item active">Configuration</li>
          </ul>
          <button class="btn btn-primary btn-icon mobile_menu" type="button">
            <i class="zmdi zmdi-sort-amount-desc"></i>
          </button>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button">
            <i class="zmdi zmdi-arrow-right"></i>
          </button>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card">
            <div class="body" v-if="Object.keys(userStore.getConfiguration).length">
              <form @submit.prevent="submitForm()">
                <div class="form-group form-float">
                  <label class="m-r-15">Date Format</label>
                  <div class="radio inlineblock m-r-15">
                    <input type="radio" name="gender" id="bs" class="with-gap" value="bs" v-model="form.configuration.date_type" />
                    <label for="bs">BS</label>
                  </div>
                  <div class="radio inlineblock">
                    <input type="radio" name="gender" id="ad" class="with-gap" value="ad"  v-model="form.configuration.date_type"/>
                    <label for="ad">AD</label>
                  </div>
                </div>
                <button class="btn btn-raised btn-primary waves-effect" type="submit">UPDATE</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>