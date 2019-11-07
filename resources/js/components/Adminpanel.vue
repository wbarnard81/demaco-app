<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <div id="navbarNavAltMarkup" class="collapse navbar-collapse">
      <div class="navbar-nav mx-auto py-2">
        <a
          class="nav-item nav-link btn ml-4 btn-outline-success text-white"
          href="/home"
          @click="isTab = 'home'"
        >Home</a>
        <a
          class="nav-item nav-link btn ml-4 btn-outline-success text-white"
          href="/quotes"
          @click="isTab = 'addQuote'"
        >Add a Quote</a>
        <a
          class="nav-item nav-link btn ml-4 btn-outline-success text-white"
          href="/quotes/list"
          @click="isTab = 'listQuote'"
        >List of Quotes</a>
        <a
          class="nav-item nav-link btn ml-4 btn-outline-success text-white"
          href="/jobs"
          @click="isTab = 'jobs'"
        >Add a Client Job</a>
        <a
          class="nav-item nav-link btn ml-4 btn-outline-success text-white"
          href="/jobs/list"
          @click="isTab = 'list'"
        >List of Client Jobs</a>
        <a
          class="nav-item nav-link btn ml-4 btn-outline-success text-white"
          href="/Employees"
          @click="isTab = 'employees'"
        >Maintain Employees</a>
      </div>
    </div>
  </nav>
</template>
<script>
export default {
  data () {
    return {}
  }
}
</script>
