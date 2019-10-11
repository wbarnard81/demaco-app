<template>
  <div class="bg-white container">
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
            <th scope="row" :style="{ color: client.color}">{{ client.customer }}</th>
            <td>{{ client.job }}</td>
            <td>{{ client.start_date }}</td>
            <td>{{ client.deadline_date }}</td>
            <td>{{ client.delivery_date }}</td>
            <td>{{client.boilermaker}}</td>
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
      clients: []
    };
  },

  computed: mapGetters({
    authenticated: "auth/check"
  }),

  methods: {
    calcTime: function(date) {
      var a = moment(date);
      var b = moment().toDate();
      return a.diff(b, "days") + 1;
    }
  },

  mounted() {
    axios
      .get("/api/clients")
      .then(response => (this.clients = response.data))
      .catch(error => console.log(error.response));
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
</style>
