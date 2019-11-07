<template>
  <div class="bg-white mx-5">
    <div class>
      <h1 class="text-center my-2">
        Current Jobs
      </h1>
    </div>
    <div>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">
              Customer
            </th>
            <th scope="col">
              Job Description
            </th>
            <th scope="col">
              Starting Date
            </th>
            <th scope="col">
              Deadline Date
            </th>
            <th scope="col">
              Delivery Date
            </th>
            <th scope="col">
              Boilermaker
            </th>
            <th scope="col">
              Due in
            </th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="activeJob in activeJobs"
            :key="activeJob.id"
            :style="[{ backgroundColor: activeJob.color} , {color: getContrastYIQ(activeJob.color)}]"
          >
            <th class="border border-dark" scope="row">
              {{ activeJob.customer }}
            </th>
            <td class="border border-dark">
              {{ activeJob.description }}
            </td>
            <td class="border border-dark">
              {{ activeJob.start_date }}
            </td>
            <td class="border border-dark">
              {{ activeJob.deadline_date }}
            </td>
            <td class="border border-dark">
              {{ activeJob.delivery_date }}
            </td>
            <td class="border border-dark">
              <p
                v-for="employee in activeJob.employees"
                :key="employee.id"
              >
                {{ employee.first_name }}
              </p>
            </td>
            <td class="border border-dark">
              {{ calcTime(activeJob.deadline_date) }}
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import { formatDistance, parseISO } from 'date-fns'

export default {
  metaInfo () {
    return { title: 'Home' }
  },

  data: () => {
    return {
      title: window.config.appName,
      jobs: []
    }
  },

  computed: {
    activeJobs: function () {
      return this.jobs.filter(function (job) {
        return job.completed === 0
      })
    }
  },

  mounted () {
    this.getJobs()
    setInterval(() => {
      this.getJobs()
    }, 10000)
  },

  methods: {
    calcTime: function (date) {
      return formatDistance(new Date(), parseISO(date))
    },
    getContrastYIQ (hexcolor) {
      hexcolor = hexcolor.replace('#', '')
      var r = parseInt(hexcolor.substr(0, 2), 16)
      var g = parseInt(hexcolor.substr(2, 2), 16)
      var b = parseInt(hexcolor.substr(4, 2), 16)
      var yiq = (r * 299 + g * 587 + b * 114) / 1000
      return yiq >= 128 ? 'black' : 'white'
    },
    getJobs () {
      axios
        .get('/api/jobs')
        .then(response => (this.jobs = response.data))
        .catch(error => console.log(error.response.data.message))
    }
  }
}
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
