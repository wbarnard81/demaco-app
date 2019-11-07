<template>
  <div class="bg-white">
    <Adminpanel />
    <div class="container">
      <h1 class="text-center text-danger display-4 my-4">
        Jobs that need urgent attention
      </h1>
      <table class="table table-striped table-danger">
        <thead class="bg-white">
          <tr>
            <th scope="col" />
            <th scope="col">
              Customer
            </th>
            <th scope="col">
              Deadline Date
            </th>
            <th scope="col">
              Boilermaker
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="job in urgentJobs" :key="job.id">
            <th scope="row">
              <button
                type="button"
                class="btn btn-dark"
                data-toggle="modal"
                data-target="#details"
                @click="loadDetails(job)"
              >
                Details
              </button>
            </th>
            <td>{{ job.customer }}</td>
            <td>{{ job.deadline_date }}</td>
            <td>
              <p
                v-for="employee in job.employees"
                :key="employee.id"
              >
                {{ employee.first_name }} {{ employee.last_name }}
              </p>
            </td>
          </tr>
        </tbody>
      </table>
      <div
        id="details"
        class="modal fade"
        tabindex="-1"
        role="dialog"
        aria-labelledby="detailsTitle"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 id="detailsTitle" class="modal-title">
                Modal title
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>
                <strong>Customer Name:</strong>
                {{ jobDetails.customer }}
              </p>
              <p>
                <strong>Job Description:</strong>
                {{ jobDetails.description }}
              </p>
              <p>
                <strong>Start Date:</strong>
                {{ jobDetails.start_date }}
              </p>
              <p>
                <strong>Deadline Date:</strong>
                {{ jobDetails.deadline_date }}
              </p>
              <p>
                <strong>Delivery Date:</strong>
                {{ jobDetails.delivery_date }}
              </p>
              <p v-for="employee in jobDetails.employees" :key="employee.id">
                <strong>Boilermaker:</strong>
                {{ employee.first_name }} {{ employee.last_name }}
              </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">
                Close
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Adminpanel from '~/components/Adminpanel'
import axios from 'axios'
export default {
  components: { Adminpanel },

  middleware: 'auth',

  metaInfo () {
    return { title: 'Home' }
  },
  data () {
    return {
      urgentJobs: [],
      jobDetails: []
    }
  },
  mounted () {
    this.getJobs()
    setInterval(() => {
      this.getJobs()
    }, 10000)
  },
  methods: {
    getJobs () {
      axios
        .get('/api/urgentjobs')
        .then(response => {
          this.urgentJobs = response.data
        })
        .catch(error => {
          alert(error.response.data.message)
        })
    },
    loadDetails (job) {
      this.jobDetails = job
    }
  }
}
</script>
