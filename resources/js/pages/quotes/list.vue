<template>
  <div>
    <div>
      <Adminpanel />
    </div>
    <div>
      <h1>List of Quotes</h1>
      <div>
        <ul>
          <li
            v-for="quote in quotes"
            :key="quote.id"
          >{{ quote.id }} - {{ quote.customer }} - {{ quote.sow }} - R Total</li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import Adminpanel from "../../components/Adminpanel";
import axios from "axios";

export default {
  name: "ListQuotes",
  metaInfo() {
    return { title: "List Quotes" };
  },
  middleware: "auth",
  components: {
    Adminpanel
  },
  data() {
    return {
      quotes: []
    };
  },
  methods: {
    getQuotes() {
      axios
        .get("/api/quotes")
        .then(response => {
          this.quotes = response.data;
        })
        .catch(error => {
          console.log(error.response.data.message);
        });
    }
  },
  mounted() {
    this.getQuotes();
  }
};
</script>
