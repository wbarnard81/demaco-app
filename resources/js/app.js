import Vue from "vue";
import store from "~/store";
import router from "~/router";
import App from "~/components/App";
import Vue2Filters from "vue2-filters";

import "~/plugins";
import "~/components";

Vue.config.productionTip = false;

Vue.use(Vue2Filters);

/* eslint-disable no-new */
new Vue({
  store,
  router,
  ...App
});
