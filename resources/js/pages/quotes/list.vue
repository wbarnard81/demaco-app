<template>
  <div>
    <div>
      <Adminpanel />
    </div>
    <div class="container bg-white">
      <h1 class="text-center display-4">List of Quotes</h1>
      <div>
        <div class="text-center ">
          <label>Search for quote number:</label>
          <input
            class="rounded-pill pl-3 border border-success"
            type="text"
            v-model="searchTerm"
            placeholder="Search..."
          />
        </div>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">
                Quote Number
              </th>
              <th scope="col">Customer</th>
              <th scope="col">Scope of Work</th>
              <th scope="col">Quote Total</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="quote in filteredList" :key="quote.id">
              <th scope="row">{{ quote.id }}</th>
              <td>{{ quote.customer }}</td>
              <td>{{ quote.scope_of_work | truncate(50) }}</td>
              <td>{{ quote.quote_total }}</td>
              <td>
                <router-link
                  :to="{ name: 'edit a quote', params: { id: quote.id } }"
                  class="btn btn-sm btn-warning"
                  >Edit</router-link
                >
              </td>
            </tr>
          </tbody>
        </table>
        <hr />
        <nav aria-label="Page navigation example" class="py-2" @click.prevent>
          <ul class="pagination justify-content-center">
            <li class="page-item" :class="[{ disabled: !prev_page_url }]">
              <a
                class="page-link"
                href
                tabindex="-1"
                @click="getQuotes(prev_page_url)"
                >Previous</a
              >
            </li>
            <li class="page-item">
              <a class="page-link text-dark"
                >{{ current_page }} of {{ last_page }}</a
              >
            </li>
            <li class="page-item" :class="[{ disabled: !next_page_url }]">
              <a class="page-link" href @click="getQuotes(next_page_url)"
                >Next</a
              >
            </li>
          </ul>
        </nav>
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
      prev_page_url: "",
      next_page_url: "",
      current_page: "",
      last_page: "",
      searchTerm: "",
      quotes: [],
      editData: {}
    };
  },
  mounted() {
    this.getQuotes();
  },
  methods: {
    getQuotes: function(pageUrl) {
      pageUrl = pageUrl || "/api/quotes";
      axios
        .get(pageUrl)
        .then(response => {
          this.prev_page_url = response.data.prev_page_url;
          this.next_page_url = response.data.next_page_url;
          this.current_page = response.data.current_page;
          this.last_page = response.data.last_page;
          this.quotes = response.data.data;
        })
        .catch(error => {
          console.log(error.response.data.message);
        });
    }
  },
  computed: {
    filteredList() {
      return this.quotes.filter(quote => {
        if (this.searchTerm === "") {
          return quote;
        }
        const jobcard = "jq" + quote.id;
        return jobcard.includes(parseInt(this.searchTerm));
      });
    }
  }
};
</script>

<style scoped>
input:focus {
  outline: none;
}
</style>
