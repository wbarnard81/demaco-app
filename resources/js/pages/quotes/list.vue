<template>
  <div>
    <div>
      <Adminpanel />
    </div>
    <div>
      <h1>List of Quotes</h1>
    </div>
  </div>
</template>

<script>
import Adminpanel from "../../components/Adminpanel";
export default {
  name: "CreateQuote",
  metaInfo() {
    return { title: this.$t("List Quote") };
  },
  middleware: "auth",
  components: {
    Adminpanel
  }
};
</script>
