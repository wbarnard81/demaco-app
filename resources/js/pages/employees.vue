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
                <button class="btn btn-primary">Add</button>
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
  }
};
</script>
