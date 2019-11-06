<template>
  <div>
    <div>
      <Adminpanel />
    </div>
    <div class="container-fluid bg-white">
      <h1 class="text-center display-4">Add a Quote</h1>
      <br />
      <div class="row">
        <div class="col-1"></div>
        <div class="col-4">
          <table class="table table-bordered table-sm">
            <tbody>
              <tr>
                <th scope="row">Jobcard Number</th>
                <td class="text-right">
                  <strong>#</strong>
                  {{ jobcard_number }}
                </td>
              </tr>
              <tr>
                <th scope="row">Customer Name</th>
                <td>
                  <select
                    class="theselect"
                    v-model="customer.customer"
                    @change="setFields($event.target.value)"
                  >
                    <option disabled value>Select the Customer</option>
                    <option v-for="customer in customers" :key="customer.id">{{ customer.customer }}</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th scope="row">VAT Registration Number</th>
                <td>
                  <input disabled class="theselect" type="text" v-model="customer.vat_number" />
                </td>
              </tr>
              <tr>
                <th scope="row">Company Registration Number</th>
                <td>
                  <input disabled class="theselect" type="text" v-model="customer.company_number" />
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-2"></div>
        <div class="col-4">
          <table class="table table-bordered table-sm">
            <thead>
              <th>Expenses</th>
              <th>Amount</th>
              <th>Total Cost</th>
            </thead>
            <tbody>
              <tr>
                <th scope="row">Petrol / Diesel</th>
                <td class="w-25">
                  <input type="number" class="theselect" v-model="fuelAmount" />
                </td>
                <td class="text-right">{{ calcFuel(fuel) | currency('R') }}</td>
              </tr>
              <tr>
                <th scope="row">Electricity</th>
                <td class="w-25">
                  <input type="number" class="theselect" v-model="electricityAmount" />
                </td>
                <td class="text-right">{{ calcElectricity(electricity) | currency('R') }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <hr />

      <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
          <div class="form-group">
            <h4>Scope of Work</h4>
            <textarea class="form-control" id="sow" rows="8" v-model="scopeOfWork"></textarea>
          </div>
        </div>
        <div class="col-1"></div>
      </div>

      <hr />

      <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
          <h4>Materials</h4>

          <table class="table">
            <thead>
              <tr class="row">
                <th scope="col" class="col-1">#</th>
                <th scope="col" class="col-8">Item Name</th>
                <th scope="col" class="col-1">Price</th>
                <th scope="col" class="col-1">Quantity</th>
                <th scope="col" class="col-1">Total</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(material, k) in materials" :key="k" class="row">
                <td class="col-1">
                  <strong>{{ k+1 }}</strong>
                  <fa
                    icon="trash"
                    class="redIcon ml-3"
                    @click="deleteRow(k, material)"
                    fixed-width
                  />
                </td>
                <td class="col-8">
                  <input
                    class="form-control"
                    type="text"
                    style="text-align:left;"
                    v-model="material.item_name"
                  />
                </td>
                <td class="col-1">
                  <input
                    class="form-control text-right"
                    type="number"
                    min="0"
                    step=".01"
                    v-model="material.price"
                    @change="calculateLineTotal(material)"
                  />
                </td>
                <td class="col-1">
                  <input
                    class="form-control text-right"
                    type="number"
                    min="0"
                    step=".01"
                    v-model="material.quantity"
                    @change="calculateLineTotal(material)"
                  />
                </td>
                <td class="col-1">
                  <input
                    readonly
                    class="form-control text-right"
                    type="number"
                    min="0"
                    step=".01"
                    v-model="material.line_total"
                  />
                </td>
              </tr>
              <button
                type="button"
                class="btn btn-sm btn-success rounded-circle mb-4"
                @click="addNewRow"
              >
                <fa icon="plus-circle" />
              </button>
              <tr v-show="materials.length === 0">
                <td colspan="6">
                  <p class="text-center alert-danger p-2">No products added.</p>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-1"></div>
      </div>

      <hr />

      <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
          <h4>Employees</h4>
          <div class="d-flex justify-content-around">
            <div v-for="employee in employees" :key="employee.id">
              <div class="form-check form-check-inline">
                <input
                  class="css-checkbox"
                  type="checkbox"
                  :value="employee.id"
                  :id="employee.first_name"
                  @click="addNewWageRow(employee)"
                />
                <label class="css-label" :for="employee.first_name">{{ employee.first_name }}</label>
              </div>
            </div>
          </div>
        </div>
        <div class="col-1"></div>
      </div>

      <hr />

      <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
          <div>
            <h4>Wage Expenses</h4>
          </div>
          <div>
            <table class="table">
              <thead>
                <tr class="row">
                  <th scope="col" class="col-1">#</th>
                  <th scope="col" class="col-6">Employee Name</th>
                  <th scope="col" class="col-1">Normal Hours</th>
                  <th scope="col" class="col-1">Overtime Hours</th>
                  <th scope="col" class="col-1">Doubletime Hours</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(employee_wage, k) in employee_wages" :key="k" class="row">
                  <td class="col-1">
                    <strong>{{ k+1 }}</strong>
                    <fa
                      icon="trash"
                      class="redIcon ml-3"
                      @click="deleteWageRow(k, employee_wage)"
                      fixed-width
                    />
                  </td>
                  <td class="col-6">
                    <input
                      class="form-control"
                      type="text"
                      style="text-align:left;"
                      v-model="employee_wage.employee"
                    />
                  </td>
                  <td class="col-1">
                    <input
                      class="form-control text-right"
                      type="number"
                      min="0"
                      step=".01"
                      v-model="employee_wage.normal_hours"
                      @change="calcWageLine(employee_wage)"
                    />
                  </td>
                  <td class="col-1">
                    <input
                      class="form-control text-right"
                      type="number"
                      min="0"
                      step=".01"
                      v-model="employee_wage.overtime_hours"
                      @change="calcWageLine(employee_wage)"
                    />
                  </td>
                  <td class="col-1">
                    <input
                      class="form-control text-right"
                      type="number"
                      min="0"
                      step=".01"
                      v-model="employee_wage.doubletime_hours"
                      @change="calcWageLine(employee_wage)"
                    />
                  </td>
                  <td class="col-1">
                    <input
                      readonly
                      class="form-control text-right"
                      type="number"
                      min="0"
                      step=".01"
                      v-model="employee_wage.line_total"
                    />
                  </td>
                </tr>

                <tr v-show="employee_wages.length === 0">
                  <td colspan="6">
                    <p class="text-center alert-danger p-2">No Employees Selected.</p>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-1"></div>
      </div>

      <hr />

      <div class="row">
        <div class="col-8"></div>
        <div class="col-3">
          <table class="table table-bordered table-sm">
            <tbody>
              <tr>
                <th scope="row">Total Expenses</th>
                <td class="text-right">{{ expenses_subtotal | currency('R') }}</td>
              </tr>
              <tr>
                <th scope="row">Total Material</th>
                <td class="text-right">{{ invoice_subtotal | currency('R') }}</td>
              </tr>
              <tr>
                <th scope="row">Total Wages</th>
                <td class="text-right">{{ wage_subtotal | currency('R') }}</td>
              </tr>
              <tr>
                <th scope="row">Other Expenses</th>
                <td>
                  <input type="number" class="theselect" v-model="other_subtotal" />
                </td>
              </tr>
              <tr>
                <th scope="row">Consumables</th>
                <td>
                  <input type="number" class="theselect" v-model="consumables_subtotal" />
                </td>
              </tr>
              <tr>
                <th scope="row">Total excl</th>
                <td class="text-right">{{ quote_subtotal | currency('R') }}</td>
              </tr>
              <tr>
                <th scope="row">Tax @ 15%</th>
                <td class="text-right">{{ quote_tax | currency('R') }}</td>
              </tr>
              <tr>
                <th scope="row">Quote Total</th>
                <td class="text-right">{{ quote_total | currency('R') }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-1"></div>
      </div>

      <div class="row">
        <div class="col-10"></div>
        <div class="col-1">
          <button type="submit" class="btn btn-primary mt-3 mb-5" @click="saveInvoice()">Save</button>
        </div>
        <div class="col-1"></div>
      </div>
    </div>
  </div>
</template>

<script>
import Adminpanel from "../../components/Adminpanel";
import Axios from "axios";
export default {
  name: "CreateQuote",
  metaInfo() {
    return { title: "Add Quote" };
  },
  middleware: "auth",
  components: {
    Adminpanel
  },
  data() {
    return {
      customers: [],
      employees: [],
      jobcard_number: "",
      fuel: "",
      electricity: "",
      tax: "",
      fuelAmount: "",
      electricityAmount: "",
      fuel_cost: "",
      electricity_cost: "",
      scopeOfWork: "",
      selectedEmployee: "Werner",
      ntHours: 0,
      overtimeHours: 0,
      dtHours: 0,
      customer: {
        customer: "",
        vat_number: "",
        company_number: ""
      },
      line_number: 1,
      wage_line_number: 1,
      invoice_subtotal: 0,
      wage_subtotal: 0,
      expenses_subtotal: 0,
      other_subtotal: 0,
      consumables_subtotal: 0,
      quote_tax: 0,
      quote_total: 0,
      invoice_total: 0,
      invoice_tax: 15,
      materials: [],
      employee_wages: []
    };
  },
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
    getConfigs() {
      Axios.get("/api/configs")
        .then(response => {
          if (response.data.length >= 1) {
            this.fuel = parseFloat(response.data[0].fuel);
            this.electricity = parseFloat(response.data[0].electricity);
            this.tax = parseFloat(response.data[0].tax);
          }
        })
        .catch(error => {
          alert(error.response.data.message);
        });
    },
    getEmployees() {
      Axios.get("/api/employees")
        .then(response => {
          this.employees = response.data;
        })
        .catch(error => console.log(error.response.data.message));
    },
    getJobcardNo() {
      Axios.get("/api/quotes/jobcard")
        .then(response => {
          if (response.data === "") {
            this.jobcard_number = 1000;
          } else {
            this.jobcard_number = response.data.id + 1;
          }
        })
        .catch(error => {
          console.log(error.response.data.message);
        });
    },
    saveInvoice() {
      Axios.post("/api/quotes", {
        quote_id: this.jobcard_number,
        customer: this.customer.customer,
        petrol_cost_per_litre: this.fuel,
        petrol_quantity: this.fuelAmount,
        electricity_cost_per_unit: this.electricity,
        electricity_quantity: this.electricityAmount,
        scope_of_work: this.scopeOfWork,
        total_expenses: this.expenses_subtotal,
        total_materials: this.invoice_subtotal,
        total_wages: this.wage_subtotal,
        other_expenses: this.other_subtotal,
        consumables: this.consumables_subtotal,
        quote_total_excl: this.quote_subtotal,
        quote_tax: this.tax,
        quote_total: this.quote_total,
        wages: this.employee_wages,
        materials: this.materials
      })
        .then(response => {
          alert("Quote has been saved");
          this.customer = "";
          this.fuelAmount = "";
          this.electricityAmount = "";
          this.scopeOfWork = "";
          this.other_subtotal = "";
          this.consumables_subtotal = "";
          this.invoice_subtotal = "";
          this.wage_subtotal = "";
          this.quote_total = "";
          this.employee_wages = [];
          this.materials = [];
        })
        .catch(error => console.log(error.response.data.message));
    },
    calculateTotal() {
      let subtotal, total;
      subtotal = this.materials.reduce(function(sum, product) {
        let lineTotal = parseFloat(product.line_total);
        if (!isNaN(lineTotal)) {
          return sum + lineTotal;
        }
      }, 0);

      this.invoice_subtotal = subtotal;
    },
    calcWageTotal() {
      let wsubtotal, wtotal;
      wsubtotal = this.employee_wages.reduce(function(sum, employee) {
        let lineTotal = parseFloat(employee.line_total);
        if (!isNaN(lineTotal)) {
          return sum + lineTotal;
        }
      }, 0);
      this.wage_subtotal = wsubtotal;
    },
    calculateLineTotal(material) {
      let itotal = material.price * material.quantity;
      if (!isNaN(itotal)) {
        material.line_total = itotal.toFixed(2);
      }
      this.calculateTotal();
    },
    calcFuel(cost) {
      let fsubtotal = cost * this.fuelAmount;
      this.fuel_cost = fsubtotal;
      return fsubtotal;
    },
    calcElectricity(cost) {
      let esubtotal = cost * this.electricityAmount;
      this.electricity_cost = esubtotal;
      this.expenses_subtotal = this.fuel_cost + esubtotal;
      return esubtotal;
    },
    calcWageLine(employee_wage) {
      let emrateph = employee_wage.employee_rate_per_hour;
      let emnormalh = employee_wage.normal_hours;
      let emoverth = employee_wage.overtime_hours;
      let emdth = employee_wage.doubletime_hours;

      if (emnormalh > 0 && !NaN) {
        emnormalh = emnormalh * emrateph;
      }

      if (emoverth == 0 || NaN) {
        emoverth = 1;
      } else if (emoverth > 0) {
        emoverth = emoverth * 1.5 * emrateph;
      }

      if (emdth == 0 || NaN) {
        emdth = 1;
      } else if (emdth > 0) {
        emdth = emdth * 2 * emrateph;
      }

      let qtotal = emnormalh + emoverth + emdth;
      let emprofident = (qtotal * 7.3) / 100;

      qtotal = emprofident + qtotal;
      if (!isNaN(qtotal)) {
        employee_wage.line_total = qtotal.toFixed(2);
      }

      this.calcWageTotal();
    },
    setFields(customerName) {
      this.customer.vat_number = this.customers.find(
        x => x.customer === customerName
      ).vat_number;
      this.customer.company_number = this.customers.find(
        x => x.customer === customerName
      ).company_number;
    },
    addNewRow() {
      this.materials.push({
        quote_id: this.jobcard_number,
        item_name: "",
        price: "",
        quantity: ""
      });
      this.line_number++;
    },
    deleteRow(index, material) {
      let idx = this.materials.indexOf(material);
      if (idx > -1) {
        this.materials.splice(idx, 1);
      }
      this.calculateTotal();
    },
    addNewWageRow(employee) {
      this.employee_wages.push({
        quote_id: this.jobcard_number,
        employee: employee.first_name,
        employee_rate_per_hour: employee.rateph,
        normal_hours: "",
        overtime_hours: "",
        doubletime_hours: ""
      });
      this.wage_line_number++;
    },
    deleteWageRow(index, employee) {
      let index1 = this.employee_wages.indexOf(employee);
      if (index1 > -1) {
        this.employee_wages.splice(index1, 1);
      }
    }
  },
  mounted() {
    this.getCustomers();
    this.getConfigs();
    this.getEmployees();
    this.getJobcardNo();
  },
  computed: {
    quote_subtotal: function() {
      let aa = parseFloat(this.expenses_subtotal);
      let bb = parseFloat(this.invoice_subtotal);
      let cc = parseFloat(this.wage_subtotal);
      let dd = parseFloat(this.other_subtotal);
      let ee = parseFloat(this.consumables_subtotal);
      let ff = aa + bb + cc + dd + ee;
      let gg = (ff * 15) / 100;
      gg = parseFloat(gg);
      this.quote_tax = gg;
      let hh = ff + gg;
      this.quote_total = parseFloat(hh);
      return parseFloat(ff);
    }
  }
};
</script>

<style scoped>
.theselect {
  display: block;
  width: 100%;
  height: 2rem;
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
  color: #495057;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid #ced4da;
  border-radius: 0.125rem;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

input {
  text-align: right;
}

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

.redIcon {
  color: red;
}
</style>
