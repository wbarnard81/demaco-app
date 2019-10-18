<template>
  <div>
    <Adminpanel />
    <div class="container">
      <h1 class="text-center">Add Active Job</h1>
      <form>
        <div class="row">
          <div class="col">
            <label for="name">Customer</label>
            <input
              type="text"
              class="form-control"
              id="name"
              v-model="form.customer"
              placeholder="Enter customer name"
            />
          </div>
          <div class="col">
            <label for="color">Customer Color</label>
            <input type="color" class="form-control" id="color" v-model="form.color" />
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
        <div class="row mt-1">
          <div class="col-6">
            <label for="boilermaker">Boilermaker</label>
            <input
              type="text"
              class="form-control"
              id="boilermaker"
              v-model="form.boilermaker"
              placeholder="Enter attending boilermaker"
            />
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
      thedate: "",
      form: {
        customer: "",
        color: "#ff8080",
        job: "",
        start_date: "",
        deadline_date: "",
        delivery_date: "",
        boilermaker: ""
      }
    };
  },
  methods: {
    customFormatter(date) {
      return moment(date).format("YYYY MM DD");
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
          this.form.boilermaker = "";
        })
        .catch(error => console.log(error.response));
    }
  }
};
</script>
