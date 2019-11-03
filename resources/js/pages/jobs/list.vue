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
            <tr
              v-for="activeJob in activeJobs"
              :key="activeJob.id"
              :style="[{ backgroundColor: activeJob.color} , {color: getContrastYIQ(activeJob.color)}]"
            >
              <th scope="row">{{ activeJob.customer }}</th>
              <td>{{ activeJob.description }}</td>
              <td>{{ activeJob.start_date }}</td>
              <td>{{ activeJob.deadline_date }}</td>
              <td>{{ activeJob.delivery_date }}</td>
              <td>
                <p
                  v-for="employee in activeJob.employees"
                  :key="employee.id"
                >{{ employee.first_name }}</p>
              </td>
              <td>{{ calcTime(activeJob.deadline_date) }}</td>
              <td class="bg-white d-flex justify-content-center align-items-center">
                <button
                  @click="editJob(activeJob)"
                  class="btn btn-outline-warning btn-sm"
                  data-toggle="modal"
                  data-target="#editModal"
                >Edit</button>
              </td>
              <td class="bg-white d-flex justify-content-center align-items-center">
                <button
                  @click="deleteJob(activeJob.id)"
                  class="btn btn-outline-danger btn-sm"
                >Delete</button>
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
          <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
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
                    <div class="col-8">
                      <label for="name">Customer</label>
                      <select
                        class="form-control"
                        v-model="form.customer"
                        @change="setColor($event.target.value)"
                      >
                        <option>{{ form.customer }}</option>
                        <option
                          v-for="customer in customers"
                          :key="customer.id"
                        >{{ customer.customer }}</option>
                      </select>
                    </div>
                    <div class="col">
                      <label for="color">Customer Color</label>
                      <div
                        class="form-control"
                        :style="[{ backgroundColor: form.color},{ color: form.color}]"
                      >.</div>
                    </div>
                  </div>
                  <div class="row mt-1">
                    <div class="col">
                      <label for="description">Job Descripion</label>
                      <input
                        type="text"
                        class="form-control"
                        id="description"
                        v-model="form.description"
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
                      <div class="d-flex justify-content-around">
                        <div v-for="boilermaker in boilermakers" :key="boilermaker.id">
                          <div class="form-check form-check-inline">
                            <input
                              class="css-checkbox"
                              type="checkbox"
                              :id="boilermaker.first_name"
                              :value="boilermaker.id"
                              v-model="form.boilermaker"
                            />
                            <label
                              class="css-label"
                              :for="boilermaker.first_name"
                            >{{ boilermaker.first_name }} {{ boilermaker.last_name }}</label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="my-5">
                    <div class="form-check">
                      <input
                        class="css-checkbox"
                        type="checkbox"
                        value
                        id="jobCompleted"
                        v-model="form.completed"
                      />
                      <label class="css-label" for="jobCompleted">Job Completed</label>
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

    <hr class="my-5 bg-white" />

    <div class="bg-white mx-5">
      <div class>
        <h1 class="text-center">Completed Jobs</h1>
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
            <tr v-for="completedJob in completedJobs" :key="completedJob.id">
              <th
                scope="row"
                :style="[{ backgroundColor: completedJob.color} , {color: getContrastYIQ(completedJob.color)}]"
              >{{ completedJob.customer }}</th>
              <td
                :style="[{ backgroundColor: completedJob.color} , {color: getContrastYIQ(completedJob.color)}]"
              >{{ completedJob.description }}</td>
              <td
                :style="[{ backgroundColor: completedJob.color} , {color: getContrastYIQ(completedJob.color)}]"
              >{{ completedJob.start_date }}</td>
              <td
                :style="[{ backgroundColor: completedJob.color} , {color: getContrastYIQ(completedJob.color)}]"
              >{{ completedJob.deadline_date }}</td>
              <td
                :style="[{ backgroundColor: completedJob.color} , {color: getContrastYIQ(completedJob.color)}]"
              >{{ completedJob.delivery_date }}</td>
              <td
                :style="[{ backgroundColor: completedJob.color} , {color: getContrastYIQ(completedJob.color)}]"
              >
                <p
                  v-for="employee in completedJob.employees"
                  :key="employee.id"
                >{{ employee.first_name }}</p>
              </td>
              <td
                :style="[{ backgroundColor: completedJob.color} , {color: getContrastYIQ(completedJob.color)}]"
              >{{ calcTime(completedJob.deadline_date) }}</td>
              <td class="bg-white d-flex justify-content-center align-items-center">
                <button
                  @click="editJob(completedJob)"
                  class="btn btn-outline-warning btn-sm"
                  data-toggle="modal"
                  data-target="#editModal"
                >Edit</button>
              </td>
              <td class="bg-white d-flex justify-content-center align-items-center">
                <button
                  @click="deleteJob(completedJob.id)"
                  class="btn btn-outline-danger btn-sm"
                >Delete</button>
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
                    <div class="col-8">
                      <label for="name">Customer</label>
                      <select
                        class="form-control"
                        v-model="form.customer"
                        @change="setColor($event.target.value)"
                      >
                        <option disabled value>Select the Customer</option>
                        <option
                          v-for="customer in customers"
                          :key="customer.id"
                        >{{ customer.customer }}</option>
                      </select>
                    </div>
                    <div class="col">
                      <label for="color">Customer Color</label>
                      <div
                        class="form-control"
                        :style="[{ backgroundColor: form.color},{ color: form.color}]"
                      >.</div>
                    </div>
                  </div>
                  <div class="row mt-1">
                    <div class="col">
                      <label for="description">Job Descripion</label>
                      <input
                        type="text"
                        class="form-control"
                        id="description"
                        v-model="form.description"
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
                  </div>
                  <div class="my-2">
                    <div class="form-check">
                      <input
                        class="form-check-input"
                        type="checkbox"
                        value
                        id="jobCompleted"
                        v-model="form.completed"
                      />
                      <label class="form-check-label" for="jobCompleted">Job Completed</label>
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
  name: "JobList",
  metaInfo() {
    return { title: "List the Jobs" };
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
      jobs: [],
      customers: [],
      boilermakers: [],
      form: {
        id: "",
        customer: "",
        color: "",
        description: "",
        start_date: "",
        deadline_date: "",
        delivery_date: "",
        boilermaker: [],
        completed: ""
      }
    };
  },
  computed: {
    activeJobs: function() {
      return this.jobs.filter(function(job) {
        return job.completed === 0;
      });
    },
    completedJobs: function() {
      return this.jobs.filter(function(job) {
        return job.completed === 1;
      });
    }
  },
  methods: {
    calcTime: function(date) {
      let a = moment().to(date);
      return a;
    },
    setColor(customerName) {
      this.form.color = this.customers.find(
        x => x.customer === customerName
      ).colour;
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
        .get("/api/jobs")
        .then(response => (this.jobs = response.data))
        .catch(error => console.log(error.response.data.message));
      axios
        .get("/api/customers")
        .then(response => {
          this.customers = response.data;
        })
        .catch(error => {
          alert(error.response.data.message);
        });
      axios
        .get("/api/employees")
        .then(response => {
          this.boilermakers = response.data;
        })
        .catch(error => {
          alert(error.response.data.message);
        });
    },
    editJob(job) {
      this.form.boilermaker = [];
      job.employees.forEach(e => {
        this.form.boilermaker.push(e.id);
      });
      this.form.id = job.id;
      this.form.customer = job.customer;
      this.form.color = job.color;
      this.form.description = job.description;
      this.form.start_date = job.start_date;
      this.form.deadline_date = job.deadline_date;
      this.form.delivery_date = job.delivery_date;
      this.form.completed = job.completed;
    },
    saveJob() {
      axios
        .patch("/api/jobs/" + this.form.id, this.form)
        .then(response => {
          alert("Job has been updated");
          this.getJobs();
        })
        .catch(error => console.log(error.response.data.message));
    },
    deleteJob(id) {
      axios
        .delete("/api/jobs/" + id)
        .then(response => {
          alert("Job has been deleted");
          this.getJobs();
        })
        .catch(error => console.log(error.response.data.message));
    },
    updateBoilermaker(id) {
      console.log(id);
    }
  },

  mounted() {
    this.getJobs();
    this.getContrastYIQ(this.hexcolor);
  }
};
</script>

<style scoped>
input[type="checkbox"].css-checkbox {
  position: absolute;
  z-index: -1000;
  left: -1000px;
  overflow: hidden;
  clip: rect(0 0 0 0);
  height: 1px;
  width: 1px;
  margin: -1px;
  padding: 0;
  border: 0;
}

input[type="checkbox"].css-checkbox + label.css-label {
  padding-left: 29px;
  height: 24px;
  display: inline-block;
  line-height: 24px;
  background-repeat: no-repeat;
  background-position: 0 0;
  font-size: 24px;
  vertical-align: middle;
  cursor: pointer;
}

input[type="checkbox"].css-checkbox:checked + label.css-label {
  background-position: 0 -24px;
}
label.css-label {
  background-image: url(/dist/images/csscheckbox.png);
  -webkit-touch-callout: none;
  -webkit-user-select: none;
  -khtml-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}
</style>