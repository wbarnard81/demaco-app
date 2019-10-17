<template>
  <div>
    <Adminpanel />
    <div class="container">
      <h1 class="text-center">Jobs that need urgent attention</h1>
    </div>
  </div>
</template>

<script>
import Adminpanel from "~/components/Adminpanel";
export default {
  components: { Adminpanel },

  middleware: "auth",

  metaInfo() {
    return { title: this.$t("home") };
  }
};
</script>
