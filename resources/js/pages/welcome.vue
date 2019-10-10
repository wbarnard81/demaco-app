<template>
  <div class="bg-white">
    <div>
      <h1>Current Jobs</h1>
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
      <th scope="col">Hours Left</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">Komatsu</th>
      <td>Belly Plate</td>
      <td>10/10/2019</td>
      <td>13/10/2019</td>
      <td>14/10/2019</td>
      <td>Lawrence Mojele</td>
      <td>4 Days</td>
    </tr>
    <tr>
      <th scope="row">Universal Recycling</th>
      <td>Granulator</td>
      <td>03/10/2019</td>
      <td>14/10/2019</td>
      <td>16/10/2019</td>
      <td>Skipper Malapane</td>
      <td>4 Days</td>
    </tr>
    <tr>
      <th scope="row">Frys Metals</th>
      <td>Bushes</td>
      <td>10/10/2019</td>
      <td>10/10/2019</td>
      <td>10/10/2019</td>
      <td>Chris Stanz</td>
      <td>2 Hours</td>
    </tr>
  </tbody>
</table>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {

  metaInfo () {
    return { title: this.$t('home') }
  },

  data: () => ({
    title: window.config.appName
  }),

  computed: mapGetters({
    authenticated: 'auth/check'
  })
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
</style>
