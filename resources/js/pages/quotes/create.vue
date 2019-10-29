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
                <td>1000</td>
              </tr>
              <tr>
                <th scope="row">Customer Name</th>
                <td>
                  <select class="theselect">
                    <option v-for="customer in customers" :key="customer.id">{{ customer.customer }}</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th scope="row">VAT Registration Number</th>
                <td>
                  <input type="text" class="theselect" />
                </td>
              </tr>
              <tr>
                <th scope="row">Company Registration Number</th>
                <td>
                  <input type="text" class="theselect" />
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
            </thead>
            <tbody>
              <tr>
                <th scope="row">Petrol / Diesel</th>
                <td class="text-center">R {{ fuel }}</td>
              </tr>
              <tr>
                <th scope="row">Electricity</th>
                <td class="text-center">R {{ electricity }}</td>
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
            <textarea class="form-control" id="sow" rows="8"></textarea>
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
              <tr v-for="(invoice_product, k) in invoice_products" :key="k" class="row">
                <td class="col-1">
                  <strong>{{ k+1 }}</strong>
                </td>
                <td class="col-8">
                  <input
                    class="form-control"
                    type="text"
                    style="text-align:left;"
                    v-model="invoice_product.product_name"
                  />
                </td>
                <td class="col-1">
                  <input
                    class="form-control text-right"
                    type="number"
                    min="0"
                    step=".01"
                    v-model="invoice_product.product_price"
                    @change="calculateLineTotal(invoice_product)"
                  />
                </td>
                <td class="col-1">
                  <input
                    class="form-control text-right"
                    type="number"
                    min="0"
                    step=".01"
                    v-model="invoice_product.product_qty"
                    @change="calculateLineTotal(invoice_product)"
                  />
                </td>
                <td class="col-1">
                  <input
                    readonly
                    class="form-control text-right"
                    type="number"
                    min="0"
                    step=".01"
                    v-model="invoice_product.line_total"
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
              <tr v-show="invoice_products.length === 0">
                <td colspan="6">
                  <p class="text-center alert-danger p-2">No products added/available.</p>
                </td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="5" class="text-right">Sub Total:</td>
                <td class="text-right">{{ invoice_subtotal }}</td>
              </tr>
              <tr>
                <td colspan="5" class="text-right">Tax:</td>
                <td class="text-right">{{invoice_tax}}%</td>
              </tr>
              <tr>
                <td colspan="5" class="text-right">Total:</td>
                <td class="text-right">{{invoice_total}}</td>
              </tr>
            </tfoot>
          </table>
        </div>
        <div class="col-1"></div>
      </div>

      <hr />

      <div class="container">
        <div class="d-flex justify-content-around">
          <div v-for="employee in employees" :key="employee.id">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" />
              <label class="form-check-label">{{ employee.first_name }}</label>
            </div>
          </div>
        </div>
      </div>

      <hr />

      <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
          <div>
            <label>Wage Expenses</label>
          </div>
          <div>
            <form>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="employee">Employee</label>
                    <input type="text" class="form-control" id="employee" placeholder="John Snow" />
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="rateph">Normal Time Hours</label>
                    <input type="number" class="form-control" id="rateph" placeholder="8" />
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="rateph">Overtime Hours</label>
                    <input type="number" class="form-control" id="rateph" placeholder="4" />
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="hours">Double Time Hours</label>
                    <input type="number" class="form-control" id="hours" placeholder="2" />
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="total_wage">Total</label>
                    <input disabled class="form-control" :placeholder="calcWageLine(1,2)" />
                  </div>
                </div>
              </div>
            </form>
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
                <th scope="row">Total Material</th>
                <td class="text-right">R 1000</td>
              </tr>
              <tr>
                <th scope="row">Total Expenses</th>
                <td class="text-right">R 500</td>
              </tr>
              <tr>
                <th scope="row">Total Wages</th>
                <td class="text-right">R 1500</td>
              </tr>
              <tr>
                <th scope="row">Total Provident Fund</th>
                <td class="text-right">R 400</td>
              </tr>
              <tr>
                <th scope="row">Other Expenses</th>
                <td>
                  <input type="number" class="theselect" />
                </td>
              </tr>
              <tr>
                <th scope="row">Consumables</th>
                <td>
                  <input type="number" class="theselect" />
                </td>
              </tr>
              <tr>
                <th scope="row">Total Provident Fund</th>
                <td class="text-right">R 400</td>
              </tr>
              <tr>
                <th scope="row">Tax @ 15%</th>
                <td class="text-right">R 510</td>
              </tr>
              <tr>
                <th scope="row">Quote Total</th>
                <td class="text-right">R 3910</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-1"></div>
      </div>

      <div class="row">
        <div class="col-10"></div>
        <div class="col-1">
          <button type="submit" class="btn btn-primary mt-3 mb-5">Submit</button>
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
      fuel: "",
      electricity: "",
      customer: {
        name: "",
        vatnumber: "",
        regnumber: ""
      },
      line_number: 1,
      invoice_subtotal: 0,
      invoice_total: 0,
      invoice_tax: 15,
      invoice_products: [
        {
          product_no: "",
          product_name: "",
          product_price: "",
          product_qty: "",
          line_total: 0
        }
      ]
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
            this.fuel = response.data[0].fuel;
            this.electricity = response.data[0].electricity;
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
    saveInvoice() {
      console.log(JSON.stringify(this.invoice_products));
    },
    calculateTotal() {
      let subtotal, total;
      subtotal = this.invoice_products.reduce(function(sum, product) {
        let lineTotal = parseFloat(product.line_total);
        if (!isNaN(lineTotal)) {
          return sum + lineTotal;
        }
      }, 0);

      this.invoice_subtotal = subtotal.toFixed(2);

      total = subtotal * (this.invoice_tax / 100) + subtotal;
      total = parseFloat(total);
      if (!isNaN(total)) {
        this.invoice_total = total.toFixed(2);
      } else {
        this.invoice_total = "0.00";
      }
    },
    calculateLineTotal(invoice_product) {
      let total =
        parseFloat(invoice_product.product_price) *
        parseFloat(invoice_product.product_qty);
      if (!isNaN(total)) {
        invoice_product.line_total = total.toFixed(2);
      }
      this.calculateTotal();
    },
    calcWageLine(a, b) {
      let total = parseFloat(a.product_price) * parseFloat(a.product_qty);
      if (!isNaN(total)) {
        a.line_total = total.toFixed(2);
      }
      this.calculateTotal();
    },
    deleteRow(index, invoice_product) {
      let idx = this.invoice_products.indexOf(invoice_product);
      console.log(idx, index);
      if (idx > -1) {
        this.invoice_products.splice(idx, 1);
      }
      this.calculateTotal();
    },
    addNewRow() {
      this.invoice_products.push({
        product_no: "",
        product_name: "",
        product_price: "",
        product_qty: "",
        line_total: 0
      });
      this.line_number++;
    }
  },
  mounted() {
    this.getCustomers();
    this.getConfigs();
    this.getEmployees();
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
</style>
