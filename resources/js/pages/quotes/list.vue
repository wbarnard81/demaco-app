<template>
  <div>
    <div>
      <Adminpanel />
    </div>
    <div>
      <h1 class="text-center bg-white">List of Quotes</h1>
      <div class="container bg-white">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Customer</th>
              <th scope="col">Scope of Work</th>
              <th scope="col">Quote Total</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="quote in quotes" :key="quote.id">
              <th scope="row">{{ quote.id }}</th>
              <td>{{ quote.customer }}</td>
              <td>{{ quote.sow | truncate(50) }}</td>
              <td>{{ quote.quote_total }}</td>
              <td>
                <button class="btn btn-sm btn-warning" @click="editQuote(quote)">Edit</button>
              </td>
            </tr>
          </tbody>
        </table>
        <hr />
        <nav aria-label="Page navigation example" class="py-2" @click.prevent>
          <ul class="pagination justify-content-center">
            <li class="page-item" :class="[{disabled: !prev_page_url}]">
              <a class="page-link" href tabindex="-1" @click="getQuotes(prev_page_url)">Previous</a>
            </li>
            <li class="page-item">
              <a class="page-link text-dark">{{ current_page }} of {{ last_page }}</a>
            </li>
            <li class="page-item" :class="[{disabled: !next_page_url}]">
              <a class="page-link" href @click="getQuotes(next_page_url)">Next</a>
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
      quotes: [],
      editData: {}
    };
  },
  methods: {
    getQuotes(page_url) {
      page_url = page_url || "/api/quotes";
      axios
        .get(page_url)
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
    },
    editQuote(quote) {
      console.log("/api/quotes/" + quote.id);
      axios
        .get("/api/quotes/" + quote.id)
        .then(response => {
          console.log(response);
          this.editData = response;
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
