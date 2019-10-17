<template>
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
            <th scope="col">Deadline Date</th>
            <th scope="col">Delivery Date</th>
            <th scope="col">Boilermaker</th>
            <th scope="col">Due in</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="client in clients"
            :key="client.id"
            :style="[isWarning ? {backgroundColor:'warning'} : { backgroundColor: client.color} , {color: getContrastYIQ(client.color)}]"
          >
            <th scope="row">{{ client.customer }}</th>
            <td>{{ client.job }}</td>
            <td>{{ client.start_date }}</td>
            <td>{{ client.deadline_date }}</td>
            <td>{{ client.delivery_date }}</td>
            <td>{{ client.boilermaker }}</td>
            <td>{{ calcTime(client.deadline_date) }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import axios from "axios";
const moment = require("moment");

export default {
  metaInfo() {
    return { title: this.$t("home") };
  },

  data: () => {
    return {
      title: window.config.appName,
      isWarning: false,
      isDanger: false,
      clients: []
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
    }
  },

  mounted() {
    this.getJobs();
    setInterval(() => {
      this.getJobs();
    }, 10000);
  }
};
</script>

<style scoped>
.top-right {
  position: absolute;
  right: 10px;
  top: 18px;
}

.title {
  font-size: 85px;
}

th {
  font-size: 25px;
}

td {
  font-size: 25px;
}
.warning {
  background-color: orange !important;
}
.danger {
  background-color: red !important;
}
</style>
