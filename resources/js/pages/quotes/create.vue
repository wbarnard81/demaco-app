<template>
  <div>
    <div>
      <Adminpanel />
    </div>
    <div>
      <h1>Add a Quote</h1>
    </div>
  </div>
</template>

<script>
import Adminpanel from "../../components/Adminpanel";
export default {
  name: "CreateQuote",
  metaInfo() {
    return { title: this.$t("Add Quote") };
  },
  middleware: "auth",
  components: {
    Adminpanel
  }
};
</script>
