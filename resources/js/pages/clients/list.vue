<template>
  <div>
    <Adminpanel />
    <div class="bg-white mx-5">
      <div class>
        <h1 class="text-center">Current Jobs</h1>
      </div>
      <div>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">Customer</th>
              <th scope="col">Job Description</th>
              <th scope="col">Starting Date</th>
              <th scope="col">Deadline</th>
              <th scope="col">Delivery Date</th>
              <th scope="col">Boilermaker</th>
              <th scope="col">Due in</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="client in clients" :key="client.id">
              <th
                scope="row"
                :style="[{ backgroundColor: client.color} , {color: getContrastYIQ(client.color)}]"
              >{{ client.customer }}</th>
              <td
                :style="[{ backgroundColor: client.color} , {color: getContrastYIQ(client.color)}]"
              >{{ client.job }}</td>
              <td
                :style="[{ backgroundColor: client.color} , {color: getContrastYIQ(client.color)}]"
              >{{ client.start_date }}</td>
              <td
                :style="[{ backgroundColor: client.color} , {color: getContrastYIQ(client.color)}]"
              >{{ client.deadline_date }}</td>
              <td
                :style="[{ backgroundColor: client.color} , {color: getContrastYIQ(client.color)}]"
              >{{ client.delivery_date }}</td>
              <td
                :style="[{ backgroundColor: client.color} , {color: getContrastYIQ(client.color)}]"
              >{{client.boilermaker}}</td>
              <td
                :style="[{ backgroundColor: client.color} , {color: getContrastYIQ(client.color)}]"
              >{{ calcTime(client.deadline_date) }}</td>
              <td>
                <button
                  @click="editJob(client)"
                  class="btn btn-outline-warning btn-sm"
                  data-toggle="modal"
                  data-target="#editModal"
                >Edit</button>
              </td>
              <td>
                <button @click="deleteJob(client.id)" class="btn btn-outline-danger btn-sm">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
        <div
          class="modal fade"
          id="editModal"
          tabindex="-1"
          role="dialog"
          aria-labelledby="editModalTitle"
          aria-hidden="true"
        >
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="editModalTitle">Edit selected Job</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
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
                  </div>
                  <div class="row mt-1">
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
                      <datetime id="start_date" v-model="form.start_date"></datetime>
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
                      <datetime id="delivery_date" v-model="form.delivery_date"></datetime>
                    </div>
                  </div>
                  <div class="row mt-1">
                    <div class="col">
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

                  <button @click.prevent="saveJob()" class="btn btn-primary mt-2">Save Changes</button>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Adminpanel from "../../components/Adminpanel";
import axios from "axios";
import { Datetime } from "vue-datetime";
import "vue-datetime/dist/vue-datetime.css";

const moment = require("moment");

export default {
  name: "ClientList",
  metaInfo() {
    return { title: this.$t("List Client Jobs") };
  },
  middleware: "auth",
  components: {
    Datetime,
    Adminpanel
  },
  data: () => {
    return {
      hexcolor: "#ffffff",
      title: window.config.appName,
      clients: [],
      form: {
        id: "",
        customer: "",
        color: "",
        job: "",
        start_date: "",
        deadline_date: "",
        delivery_date: "",
        boilermaker: ""
      }
    };
  },
  computed: {},
  methods: {
    calcTime: function(date) {
      let a = moment().to(date);
      return a;
    },
    getContrastYIQ(hexcolor) {
      hexcolor = hexcolor.replace("#", "");
      var r = parseInt(hexcolor.substr(0, 2), 16);
      var g = parseInt(hexcolor.substr(2, 2), 16);
      var b = parseInt(hexcolor.substr(4, 2), 16);
      var yiq = (r * 299 + g * 587 + b * 114) / 1000;
      return yiq >= 128 ? "black" : "white";
    },
    getJobs() {
      axios
        .get("/api/clients")
        .then(response => (this.clients = response.data))
        .catch(error => console.log(error.response));
    },
    editJob(client) {
      this.form.id = client.id;
      this.form.customer = client.customer;
      this.form.color = client.color;
      this.form.job = client.job;
      this.form.start_date = client.start_date;
      this.form.deadline_date = client.deadline_date;
      this.form.delivery_date = client.delivery_date;
      this.form.boilermaker = client.boilermaker;
    },
    saveJob() {
      axios
        .patch("/api/clients/" + this.form.id, this.form)
        .then(response => {
          alert("Client job has been updated");
          this.getJobs();
        })
        .catch(error => console.log(error.response));
    },
    deleteJob(id) {
      axios
        .delete("/api/clients/" + id)
        .then(response => {
          alert("Client has been deleted");
          this.getJobs();
        })
        .catch(error => console.log(error.response));
    }
  },

  mounted() {
    this.getJobs();
    this.getContrastYIQ(this.hexcolor);
  }
};
</script>
