<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav mx-auto py-2">
        <a
          class="nav-item nav-link btn ml-4 btn-outline-success text-white"
          v-on:click="isTab = 'home'"
          href="/home"
        >Home</a>
        <a
          class="nav-item nav-link btn ml-4 btn-outline-success text-white"
          v-on:click="isTab = 'addQuote'"
          href="/quotes"
        >Add a Quote</a>
        <a
          class="nav-item nav-link btn ml-4 btn-outline-success text-white"
          v-on:click="isTab = 'listQuote'"
          href="/quotes/list"
        >List of Quotes</a>
        <a
          class="nav-item nav-link btn ml-4 btn-outline-success text-white"
          v-on:click="isTab = 'jobs'"
          href="/jobs"
        >Add a Client Job</a>
        <a
          class="nav-item nav-link btn ml-4 btn-outline-success text-white"
          v-on:click="isTab = 'list'"
          href="/jobs/list"
        >List of Client Jobs</a>
        <a
          class="nav-item nav-link btn ml-4 btn-outline-success text-white"
          v-on:click="isTab = 'employees'"
          href="/Employees"
        >Maintain Employees</a>
      </div>
    </div>
  </nav>
</template>
<script>
export default {
  data() {
    return {};
  }
};
</script>
