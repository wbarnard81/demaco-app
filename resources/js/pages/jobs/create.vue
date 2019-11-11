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
              v-model="form.customer"
              class="form-control"
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
            <label for="description">Job Descripion</label>
            <input
              id="description"
              v-model="form.description"
              type="text"
              class="form-control"
              placeholder="Enter job description"
            />
          </div>
        </div>
        <div class="row mt-1">
          <div class="col">
            <label for="start_date">Start Date</label>
            <datetime id="start_date" v-model="form.start_date" />
          </div>
          <div class="col">
            <label for="deadline_date">Deadline Date</label>
            <datetime
              id="deadline_date"
              v-model="form.deadline_date"
              type="datetime"
              :minute-step="15"
            />
          </div>
          <div class="col">
            <label for="delivery_date">Delivery Date</label>
            <datetime id="delivery_date" v-model="form.delivery_date" />
          </div>
        </div>

        <div class="container my-3">
          <label>Boilermakers</label>
          <div class="d-flex justify-content-around">
            <div v-for="boilermaker in boilermakers" :key="boilermaker.id">
              <div class="custom-control custom-checkbox d-flex">
                <input
                  :id="boilermaker.first_name"
                  v-model="form.boilermaker"
                  class="custom-control-input"
                  type="checkbox"
                  :value="boilermaker.id"
                />
                <label
                  class="custom-control-label my-auto"
                  :for="boilermaker.first_name"
                >{{ boilermaker.first_name }}</label>
              </div>
            </div>
          </div>
        </div>

        <button class="btn btn-primary mt-2" @click.prevent="addJob()">Submit</button>
      </form>
    </div>
  </div>
</template>

<script>
import Adminpanel from "~/components/Adminpanel";
import Axios from "axios";
import { Datetime } from "vue-datetime";
import "vue-datetime/dist/vue-datetime.css";

export default {
  name: "Jobs",
  metaInfo() {
    return { title: "Add a Job" };
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
        description: "",
        start_date: "",
        deadline_date: "",
        delivery_date: "",
        boilermaker: [],
        completed: false
      }
    };
  },
  mounted() {
    this.getCustomers();
  },
  methods: {
    setColor(customerName) {
      this.form.color = this.customers.find(
        x => x.customer === customerName
      ).colour;
    },
    addJob() {
      Axios.post("/api/jobs", this.form)
        .then(response => {
          alert("Job has been added.");
          this.form.customer = "";
          this.form.color = "#ff8080";
          this.form.description = "";
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
  }
};
</script>
