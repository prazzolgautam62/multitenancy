<script setup>
import { onMounted,ref } from 'vue';
import { _getTenants } from "../../../service/main/tenants";
const tenants = ref([]);
const getAllTenants = () => {
  _getTenants()
    .then(response => {
      if (response.status) {
        tenants.value = response.data.tenants;
      } else {
        console.log("error", response.message);
      }
    })
    .catch(err => {
      console.log(err);
    });
};

onMounted(() => {
    getAllTenants();
});

</script>

<template>
  <div>
    <div class="block-header">
      <div class="row">
        <div class="col-lg-7 col-md-6 col-sm-12">
          <h2>Tenants</h2>
          <ul class="breadcrumb">
            <li class="breadcrumb-item">
              <a>
                <i class="zmdi zmdi-home"></i> Multitenancy
              </a>
            </li>
            <li class="breadcrumb-item active">Tenants</li>
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
    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
          <!-- <div class="header">
            <h2>
              <strong>Bordered</strong> Table
            </h2>
          </div> -->
          <div class="body">
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(tenant,index) in tenants" :key="'tenant-'+index">
                    <th scope="row">{{index + 1}}</th>
                    <td>{{tenant.name}}</td>
                    <td>{{tenant.email}}</td>
                    <td>{{tenant.contact_no}}</td>
                    <td>
                        <button class="btn btn-primary btn-sm">Edit</button>
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>