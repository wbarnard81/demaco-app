<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a
          class="nav-item nav-link"
          :class="{active :isTab==='home'}"
          v-on:click="isTab = 'home'"
          href="#"
        >Home</a>
        <a
          class="nav-item nav-link"
          :class="{active :isTab==='features'}"
          v-on:click="isTab = 'addQuote'"
          href="/quotes"
        >Add a Quote</a>
        <a
          class="nav-item nav-link"
          :class="{active :isTab==='features'}"
          v-on:click="isTab = 'listQuote'"
          href="/quotes/list"
        >List of Quotes</a>
        <a
          class="nav-item nav-link"
          :class="{active :isTab==='jobs'}"
          v-on:click="isTab = 'jobs'"
          href="/clients"
        >Client Jobs</a>
        <a
          class="nav-item nav-link"
          :class="{active :isTab==='list'}"
          v-on:click="isTab = 'list'"
          href="/clients/list"
        >List the Clients</a>
        <a
          class="nav-item nav-link"
          :class="{active :isTab==='list'}"
          v-on:click="isTab = 'list'"
          href="/Employees"
        >Employees</a>
      </div>
    </div>
  </nav>
</template>
<script>
export default {
  data() {
    return { isTab: "home" };
  }
};
</script>
