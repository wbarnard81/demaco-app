<template>
  <card :title="'Company Configuration'">
    <form @click.prevent>
      <div class="form-group row">
        <label class="col-md-5 col-form-label text-md-right">{{ 'Customer Name' }}</label>
        <div class="col-md-5 input-group">
          <input v-model="form.customer" class="form-control" type="string" name="customer" />
        </div>
      </div>

      <div @click.stop class="form-group row">
        <label class="col-md-5 col-form-label text-md-right">{{ 'Colour' }}</label>
        <div class="col-md-5 input-group">
          <input type="color" class="form-control" id="color" v-model="form.colour" />
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-5 col-form-label text-md-right">{{ 'VAT Registration Number' }}</label>
        <div class="col-md-5 input-group">
          <input v-model="form.vat_number" class="form-control" type="string" name="vat_number" />
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-5 col-form-label text-md-right">{{ 'Company Registration Number' }}</label>
        <div class="col-md-5 input-group">
          <input
            v-model="form.company_number"
            class="form-control"
            type="string"
            name="company_number"
          />
        </div>
      </div>

      <!-- Submit Button -->
      <div class="form-group row">
        <div class="col-md-9 ml-md-auto">
          <button class="btn btn-success" @click="updateCustomer(form.id)" v-if="isUpdating">Update</button>
          <button class="btn btn-success" v-else @click="setCustomer()">Submit</button>
        </div>
      </div>
    </form>

    <table class="table">
      <thead>
        <tr>
          <th scope="col">Customer</th>
          <th scope="col">Colour</th>
          <th scope="col">VAT No</th>
          <th scope="col">Company No</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="customer in customers" :key="customer.id">
          <th scope="row">{{ customer.customer }}</th>
          <td>
            <div class="w-25" :style="{ backgroundColor: customer.colour, color:customer.colour }">.</div>
          </td>
          <td>{{ customer.vat_number }}</td>
          <td>{{ customer.company_number }}</td>
          <td>
            <button class="btn btn-sm btn-outline-warning" @click="editCustomer(customer)">Edit</button>
            <button
              class="btn btn-sm btn-outline-danger"
              @click="deleteCustomer(customer.id)"
            >Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </card>
</template>

<script>
import { mapGetters } from "vuex";
import Axios from "axios";

export default {
  scrollToTop: false,

  metaInfo() {
    return { title: "Customers" };
  },

  data: () => ({
    form: {
      id: "",
      customer: "",
      colour: "#ff2b2b",
      vat_number: "",
      company_number: ""
    },
    customers: [],
    isUpdating: false
  }),

  computed: mapGetters({
    user: "auth/user"
  }),

  created() {},

  methods: {
    getCustomers() {
      Axios.get("/api/customers")
        .then(response => {
          this.customers = response.data;
        })
        .catch(error => {
          alert(error.response.data.message);
        });
    },
    setCustomer() {
      Axios.post("/api/customers", this.form)
        .then(response => {
          alert("Customer has been set");
          this.getCustomers();
        })
        .catch(error => {
          alert(error.response.data.message);
        });
    },
    editCustomer(customer) {
      this.isUpdating = true;
      this.form.id = customer.id;
      this.form.customer = customer.customer;
      this.form.colour = customer.colour;
      this.form.vat_number = customer.vat_number;
      this.form.company_number = customer.company_number;
    },
    updateCustomer(id) {
      Axios.patch("/api/customers/" + id, this.form)
        .then(response => {
          alert("Customer has been updates");
          this.getCustomers();
          this.isUpdating = false;
          this.form.customer = "";
          this.form.vat_number = "";
          this.form.company_number = "";
        })
        .catch(error => {
          alert(error.response.data.message);
        });
    },
    deleteCustomer(id) {
      Axios.delete("/api/customers/" + id)
        .then(response => {
          alert("Customer has been deleted");
          this.getCustomers();
        })
        .catch(error => {
          alert(error.response.data.message);
        });
    }
  },

  mounted() {
    this.getCustomers();
  }
};
</script>
