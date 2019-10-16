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
            <tr>
              <th scope="row">1</th>
              <td class="text-center border border-dark">Mark</td>
              <td class="text-center border border-dark">Otto</td>
              <td class="text-center border border-dark">40</td>
              <td class="text-center border border-dark">R 130</td>
              <td class="text-center border border-dark">R 160</td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td class="text-center border border-dark">Jacob</td>
              <td class="text-center border border-dark">Thornton</td>
              <td class="text-center border border-dark">40</td>
              <td class="text-center border border-dark">R 140</td>
              <td class="text-center border border-dark">R 150</td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td class="text-center border border-dark">Larry</td>
              <td class="text-center border border-dark">the Bird</td>
              <td class="text-center border border-dark">40</td>
              <td class="text-center border border-dark">R 90</td>
              <td class="text-center border border-dark">R 110</td>
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
                      <input type="number" class="form-control" id="hours" v-model="form.hour" />
                    </div>
                    <div class="form-group col">
                      <label for="rateph" class="col-form-label">Rate per Hours:</label>
                      <input type="number" class="form-control" id="rateph" v-model="form.rateph" />
                    </div>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Save Changes</button>
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
export default {
  name: "CreateQuote",
  components: {
    Adminpanel
  },
  data: () => {
    return {
      employees: [],
      form: {
        first_name: "",
        last_name: "",
        hours: "",
        rateph: ""
      }
    };
  }
};
</script>
