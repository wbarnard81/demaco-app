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
            <input
              type="color"
              class="form-control"
              id="color"
              v-model="form.color"
              placeholder="Enter customer color "
            />
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
            <VueCtkDateTimePicker
              v-model="form.start_date"
              format="YYYY-MM-DD"
              id="start_date"
              :only-date="true"
              formatted="ll"
            />
          </div>
          <div class="col">
            <label for="deadline_date">Deadline Date</label>
            <VueCtkDateTimePicker
              v-model="form.deadline_date"
              format="YYYY-MM-DD"
              id="deadline_date"
              formatted="ll"
              :only-date="true"
            />
          </div>
          <div class="col">
            <label for="deadline_date">Deadline Time</label>
            <VueCtkDateTimePicker
              v-model="form.deadline_time"
              :only-time="true"
              label="Select deadline time"
              format="hh:mm a"
              formatted="hh:mm a"
            />
          </div>
          <div class="col">
            <label for="delivery_date">Delivery Date</label>
            <VueCtkDateTimePicker
              v-model="form.delivery_date"
              format="YYYY-MM-DD"
              id="delivery_date"
              formatted="ll"
              :only-date="true"
            />
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
    <div class="container">
      <div class="form-group">
        <input class="input-group" type="datetime-local" v-model="thedate" />
        {{thedate}}
      </div>
    </div>
  </div>
</template>

<script>
import Adminpanel from "~/components/Adminpanel";
//import Datepicker from "vuejs-datepicker";
import VueCtkDateTimePicker from "vue-ctk-date-time-picker";
import "vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css";
import Axios from "axios";
const moment = require("moment");
export default {
  name: "Client",

  components: {
    Adminpanel,
    VueCtkDateTimePicker
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
        deadline_time: "",
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
          this.form.deadline_time = "";
          this.form.delivery_date = "";
          this.form.boilermaker = "";
        })
        .catch(error => console.log(error.response));
    }
  }
};
</script>
