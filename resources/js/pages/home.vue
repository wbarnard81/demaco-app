<template>
  <div>
    <Adminpanel />
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
