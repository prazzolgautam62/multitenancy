<script setup>
import { onMounted, ref } from "vue";
import Modal from "../../utilities/Modal.vue";
import { useToast } from "vue-toast-notification";
import { _getTenants, _storeTenant, _updateTenant } from "../../../service/main/tenants";
const editMode = ref(false);
const showModal = ref(false);
const submitting = ref(false);
const $toast = useToast();
const tenants = ref([]);
const editDataId = ref(null);
const form = ref({
  name: "",
  email: "",
  password: "",
  address: "",
  contact_no: "",
  url: "",
  pan_no: "",
  established_year: ""
});
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

const openEditMode = tenant => {
  showModal.value = true;
  editMode.value = true;
  editDataId.value = tenant.id;
  form.value = tenant;
};

const openAddMode = () => {
  showModal.value = true;
  editMode.value = false;
  editDataId.value = null;
};

const closeModal = () => {
  showModal.value = false;
  editMode.value = false;
  editDataId.value = null;
  form.value = {};
};

const submitForm = () => {
  submitting.value = true;
  if (!editMode.value) {
    _storeTenant(form.value)
      .then(response => {
        if (response.status) {
          submitting.value = false;
          showModal.value = false;
          $toast.success(response.message);
          getAllTenants();
        } else {
          console.log("error", response.message);
        }
      })
      .catch(err => {
        console.log(err);
      });
  }
  else{
     _updateTenant(editDataId.value,form.value)
      .then(response => {
        if (response.status) {
          submitting.value = false;
          showModal.value = false;
          $toast.success(response.message);
          getAllTenants();
        } else {
          console.log("error", response.message);
        }
      })
      .catch(err => {
        console.log(err);
      });
  }
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
          <div class="header">
            <h2>
              <strong @click="openAddMode()" class="cursor-pointer">Add New Tenant</strong>
            </h2>
          </div>
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
                      <button class="btn btn-primary btn-sm" @click="openEditMode(tenant)">Edit</button>
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
    <Modal v-if="showModal" @close="closeModal()">
      <template v-slot:header>
        <h4 class="title" id="largeModalLabel">{{ editMode ? 'Update' : 'Add New'}} Tenant</h4>
      </template>
      <template v-slot:body>
        <form @submit.prevent="submitForm()">
          <div class="form-group form-float">
            <label for="email_address">Name</label>
            <input
              v-model="form.name"
              type="text"
              class="form-control"
              placeholder="Name"
              name="name"
              required
            />
          </div>
          <div class="row clearfix">
            <div class="col-md-6">
              <div class="form-group">
                <label for="email_address">Email Address</label>
                <input
                  v-model="form.email"
                  type="email"
                  class="form-control"
                  placeholder="Email"
                  name="email"
                  required
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="password">Password</label>
                <input
                  v-model="form.password"
                  id="password"
                  type="password"
                  class="form-control"
                  placeholder="Password"
                  name="password"
                  :disabled="editMode"
                  :required="!editMode"
                />
              </div>
            </div>
          </div>

          <div class="row clearfix">
            <div class="col-md-6">
              <div class="form-group">
                <label for="address">Address</label>
                <input
                  v-model="form.address"
                  type="text"
                  id="address"
                  class="form-control"
                  placeholder="Address"
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="contact">Contact</label>
                <input
                  v-model="form.contact_no"
                  type="text"
                  id="contact"
                  class="form-control"
                  placeholder="Contact"
                />
              </div>
            </div>
          </div>
          <div class="row clearfix">
            <div class="col-md-4">
              <div class="form-group">
                <label for="url">URL</label>
                <input
                  v-model="form.url"
                  type="text"
                  id="url"
                  class="form-control"
                  placeholder="URL"
                />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="pan">PAN</label>
                <input
                  v-model="form.pan_no"
                  type="number"
                  id="pan"
                  class="form-control"
                  placeholder="PAN NO"
                />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="estd">ESTD</label>
                <input
                  v-model="form.established_year"
                  type="text"
                  id="estd"
                  class="form-control"
                  placeholder="ESTD"
                />
              </div>
            </div>
          </div>
          <button
            v-if="!editMode"
            :disabled="submitting"
            class="btn btn-raised btn-primary waves-effect"
            type="submit"
          >{{ submitting ? 'CREATING...' : 'CREATE'}}</button>
          <button
            v-else
            :disabled="submitting"
            class="btn btn-raised btn-primary waves-effect"
            type="submit"
          >{{ submitting ? 'UPDATING...' : 'UPDATE'}}</button>
        </form>
      </template>
    </Modal>
  </div>
</template>