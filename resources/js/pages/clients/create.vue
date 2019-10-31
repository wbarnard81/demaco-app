<template>
  <div>
    <Adminpanel />
    <div class="container">
      <h1 class="text-center">Add Active Job</h1>
      <form>
        <div class="row">
          <div class="col-4">
            <label for="name">Customer</label>

            <select
              class="form-control"
              v-model="form.customer"
              @change="setColor($event.target.value)"
            >
              <option disabled value>Select the Customer</option>
              <option v-for="customer in customers" :key="customer.id">{{ customer.customer }}</option>
            </select>
          </div>
          <div class="col-2">
            <label for="color">Customer Color</label>
            <div
              class="form-control"
              :style="[{ backgroundColor: form.color},{ color: form.color}]"
            >.</div>
          </div>
          <div class="col">
            <label for="job">Job Descripion</label>
            <input
              type="text"
              class="form-control"
              id="job"
              v-model="form.job"
              placeholder="Enter job description"
            />
          </div>
        </div>
        <div class="row mt-1">
          <div class="col">
            <label for="start_date">Start Date</label>
            <datetime v-model="form.start_date" id="start_date"></datetime>
          </div>
          <div class="col">
            <label for="deadline_date">Deadline Date</label>
            <datetime
              type="datetime"
              v-model="form.deadline_date"
              id="deadline_date"
              :minute-step="15"
            ></datetime>
          </div>
          <div class="col">
            <label for="delivery_date">Delivery Date</label>
            <datetime v-model="form.delivery_date" id="delivery_date"></datetime>
          </div>
        </div>

        <div class="container mt-2">
          <label>Boilermakers</label>
          <div class="d-flex justify-content-around">
            <div v-for="boilermaker in boilermakers" :key="boilermaker.id">
              <div class="form-check form-check-inline">
                <input
                  class="form-check-input"
                  type="checkbox"
                  :id="boilermaker.first_name"
                  :value="boilermaker.id"
                  v-model="form.boilermaker"
                />
                <label
                  class="form-check-label"
                  :for="boilermaker.first_name"
                >{{ boilermaker.first_name }}</label>
              </div>
            </div>
          </div>
        </div>

        <button @click.prevent="addJob()" class="btn btn-primary mt-2">Submit</button>
      </form>
    </div>
  </div>
</template>

<script>
import Adminpanel from "~/components/Adminpanel";
import Axios from "axios";
import { Datetime } from "vue-datetime";
import "vue-datetime/dist/vue-datetime.css";

const moment = require("moment");

export default {
  name: "Client",
  metaInfo() {
    return { title: "Add Client Job" };
  },
  middleware: "auth",
  components: {
    Adminpanel,
    Datetime
  },
  data: () => {
    return {
      customers: [],
      boilermakers: [],
      form: {
        customer: "",
        color: "#fff",
        job: "",
        start_date: "",
        deadline_date: "",
        delivery_date: "",
        boilermaker: [],
        completed: false
      }
    };
  },
  methods: {
    customFormatter(date) {
      return moment(date).format("YYYY MM DD");
    },
    setColor(customerName) {
      this.form.color = this.customers.find(
        x => x.customer === customerName
      ).colour;
    },
    addJob() {
      Axios.post("/api/clients", this.form)
        .then(response => {
          alert("Job has been added.");
          this.form.customer = "";
          this.form.color = "#ff8080";
          this.form.job = "";
          this.form.start_date = "";
          this.form.deadline_date = "";
          this.form.delivery_date = "";
          this.form.boilermaker = [];
          this.form.completed = false;
        })
        .catch(error => console.log(error.response.data.message));
    },
    getCustomers() {
      Axios.get("/api/customers")
        .then(response => {
          this.customers = response.data;
        })
        .catch(error => {
          alert(error.response.data.message);
        });
      Axios.get("/api/employees")
        .then(response => {
          this.boilermakers = response.data;
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
