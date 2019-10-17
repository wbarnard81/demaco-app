<template>
  <div class="bg-white">
    <div>
      <Adminpanel />
    </div>
    <div>
      <div class="text-center">
        <h1>Employees</h1>
      </div>
      <div class="container">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">
                <button
                  type="button"
                  class="btn btn-primary"
                  data-toggle="modal"
                  data-target="#addEmployee"
                >Add</button>
              </th>
              <th scope="col">First Name</th>
              <th scope="col">Last Name</th>
              <th scope="col">Expected Hours</th>
              <th scope="col">Rate per Hour</th>
              <th scope="col">Provident Fund @ 7.3%</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="employee in employees" :key="employee.id">
              <th scope="row" class="text-center">
                <button
                  class="btn btn-sm btn-outline-warning"
                  type="button"
                  data-toggle="modal"
                  data-target="#editEmployeeModal"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="feather feather-edit"
                    @click="editEmployee(employee)"
                  >
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                  </svg>
                </button>
                <button class="btn btn-sm btn-outline-danger">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="feather feather-trash-2"
                    @click="deleteEmployee(employee.id)"
                  >
                    <polyline points="3 6 5 6 21 6" />
                    <path
                      d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"
                    />
                    <line x1="10" y1="11" x2="10" y2="17" />
                    <line x1="14" y1="11" x2="14" y2="17" />
                  </svg>
                </button>
              </th>
              <td class="text-center border border-dark">{{employee.first_name}}</td>
              <td class="text-center border border-dark">{{employee.last_name}}</td>
              <td class="text-center border border-dark">{{employee.hours}}</td>
              <td class="text-center border border-dark">{{employee.rateph}}</td>
              <td class="text-center border border-dark">{{employee.provident_fund}}</td>
            </tr>
          </tbody>
        </table>
        <div
          class="modal fade"
          id="addEmployee"
          tabindex="-1"
          role="dialog"
          aria-labelledby="addEmployeeTitle"
          aria-hidden="true"
        >
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addEmployeeTitle">Add an Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form>
                  <div class="form-group">
                    <label for="first_name" class="col-form-label">First Name:</label>
                    <input
                      type="text"
                      class="form-control"
                      id="first_name"
                      v-model="form.first_name"
                    />
                  </div>
                  <div class="form-group">
                    <label for="last_name" class="col-form-label">Last Name:</label>
                    <input type="text" class="form-control" id="last_name" v-model="form.last_name" />
                  </div>
                  <div class="row">
                    <div class="form-group col">
                      <label for="hours" class="col-form-label">Expected Hours:</label>
                      <input type="number" class="form-control" id="hours" v-model="form.hours" />
                    </div>
                    <div class="form-group col">
                      <label for="rateph" class="col-form-label">Rate per Hours:</label>
                      <input type="number" class="form-control" id="rateph" v-model="form.rateph" />
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col">
                      <label for="hours" class="col-form-label">Provident Fund:</label>
                      <input
                        type="number"
                        class="form-control"
                        id="hours"
                        v-model="form.provident_fund"
                      />
                    </div>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" @click="storeEmployee()">Save Changes</button>
              </div>
            </div>
          </div>
        </div>
        <div
          class="modal fade"
          id="editEmployeeModal"
          tabindex="-1"
          role="dialog"
          aria-labelledby="editEmployeeModalTitle"
          aria-hidden="true"
        >
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="editEmployeeModalTitle">Edit an Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form>
                  <div class="form-group">
                    <label for="first_name" class="col-form-label">First Name:</label>
                    <input
                      type="text"
                      class="form-control"
                      id="first_name"
                      v-model="form.first_name"
                    />
                  </div>
                  <div class="form-group">
                    <label for="last_name" class="col-form-label">Last Name:</label>
                    <input type="text" class="form-control" id="last_name" v-model="form.last_name" />
                  </div>
                  <div class="row">
                    <div class="form-group col">
                      <label for="hours" class="col-form-label">Expected Hours:</label>
                      <input type="number" class="form-control" id="hours" v-model="form.hours" />
                    </div>
                    <div class="form-group col">
                      <label for="rateph" class="col-form-label">Rate per Hours:</label>
                      <input type="number" class="form-control" id="rateph" v-model="form.rateph" />
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col">
                      <label for="hours" class="col-form-label">Provident Fund:</label>
                      <input
                        type="number"
                        class="form-control"
                        id="hours"
                        v-model="form.provident_fund"
                      />
                    </div>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button
                  type="button"
                  class="btn btn-primary"
                  @click="updateEmployee()"
                >Update changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Adminpanel from "../components/Adminpanel";
import axios from "axios";

export default {
  name: "CreateQuote",
  components: {
    Adminpanel
  },
  data: () => {
    return {
      employees: [],
      employee_id: "",
      form: {
        first_name: "",
        last_name: "",
        hours: "",
        rateph: "",
        provident_fund: ""
      }
    };
  },
  methods: {
    getEmployees() {
      axios
        .get("/api/employees")
        .then(response => {
          this.employees = response.data;
        })
        .catch(error => console.log(error.response.data.message));
    },
    storeEmployee() {
      axios
        .post("/api/employees", this.form)
        .then(response => {
          alert("Employee was created.");
          this.form.first_name = "";
          this.form.last_name = "";
          this.form.hours = "";
          this.form.rateph = "";
          this.form.provident_fund = "";
          this.getEmployees();
        })
        .catch(error => {
          console.log(error.response.data.message);
        });
    },
    editEmployee(employee) {
      this.employee_id = employee.id;
      this.form.first_name = employee.first_name;
      this.form.last_name = employee.last_name;
      this.form.hours = employee.hours;
      this.form.rateph = employee.rateph;
      this.form.provident_fund = employee.provident_fund;
    },
    updateEmployee() {
      axios
        .patch("/api/employees/" + this.employee_id, this.form)
        .then(response => {
          alert("Employee has been updated.");
          this.form.first_name = "";
          this.form.last_name = "";
          this.form.hours = "";
          this.form.rateph = "";
          this.form.provident_fund = "";
          this.getEmployees();
        })
        .catch(error => {
          alert(error.response.data.message);
        });
    },
    deleteEmployee(id) {
      axios
        .delete("/api/employees/" + id)
        .then(response => {
          alert("Employee has been deleted.");
          this.getEmployees();
        })
        .catch(error => alert(error.response.data.message));
    }
  },
  mounted() {
    this.getEmployees();
  }
};
</script>
