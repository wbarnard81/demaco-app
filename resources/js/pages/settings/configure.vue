<template>
  <card :title="'Company Configuration'">
    <form @click.prevent>
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ 'Petrol/Diesel Rate' }}</label>
        <div class="col-md-4 input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">R</span>
          </div>
          <input v-model="form.fuel" class="form-control" type="number" step="0.01" name="fuel" />
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ 'Electricity' }}</label>
        <div class="col-md-4 input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon2">R</span>
          </div>
          <input
            v-model="form.electricity"
            class="form-control"
            type="number"
            step="0.01"
            name="electricity"
          />
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ 'Provident Fund' }}</label>
        <div class="col-md-4 input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon3">%</span>
          </div>
          <input
            v-model="form.provident_fund"
            class="form-control"
            type="number"
            step="0.01"
            name="provident_fund"
          />
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ 'Expected Hours' }}</label>
        <div class="col-md-4 input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon4">H</span>
          </div>
          <input
            v-model="form.expected_hours"
            class="form-control"
            type="number"
            step="0.01"
            name="expected_hours"
          />
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ 'Tax' }}</label>
        <div class="col-md-4 input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon5">%</span>
          </div>
          <input v-model="form.tax" class="form-control" type="number" step="0.01" name="tax" />
        </div>
      </div>

      <!-- Submit Button -->
      <div class="form-group row">
        <div class="col-md-9 ml-md-auto">
          <button class="btn btn-success" @click="updateConfigs(form.id)" v-if="isUpdating">Update</button>
          <button class="btn btn-success" v-else @click="setConfigs()">Submit</button>
        </div>
      </div>
    </form>
  </card>
</template>

<script>
import { mapGetters } from "vuex";
import Axios from "axios";

export default {
  scrollToTop: false,

  metaInfo() {
    return { title: "Config" };
  },

  data: () => ({
    form: {
      id: "",
      fuel: "",
      electricity: "",
      provident_fund: "",
      expected_hours: "",
      tax: ""
    },
    isUpdating: false
  }),

  computed: mapGetters({
    user: "auth/user"
  }),

  created() {},

  methods: {
    getConfigs() {
      Axios.get("/api/configs")
        .then(response => {
          if (response.data.length >= 1) {
            this.isUpdating = true;
            this.form.id = response.data[0].id;
            this.form.fuel = response.data[0].fuel;
            this.form.electricity = response.data[0].electricity;
            this.form.provident_fund = response.data[0].provident_fund;
            this.form.expected_hours = response.data[0].expected_hours;
            this.form.tax = response.data[0].tax;
          }
        })
        .catch(error => {
          alert(error.response.data.message);
        });
    },
    setConfigs() {
      Axios.post("/api/configs", this.form)
        .then(response => {
          alert("Configs has been set");
          this.getConfigs();
        })
        .catch(error => {
          alert(error.response.data.message);
        });
    },
    updateConfigs(id) {
      Axios.patch("/api/configs/" + id, this.form)
        .then(response => {
          alert("Configs has been updates");
          this.getConfigs();
        })
        .catch(error => {
          alert(error.response.data.message);
        });
    }
  },

  mounted() {
    this.getConfigs();
  }
};
</script>
