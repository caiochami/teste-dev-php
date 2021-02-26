import Vue from "vue";
import App from "./App.vue";
import "./registerServiceWorker";
import router from "./router";
import store from "./store";
import "./assets/tailwind.css";
import { Axios } from "./utils/variables";
window._ = require("lodash");
Vue.prototype.$axios = Axios;

Vue.config.productionTip = false;

window.app = new Vue({
  router,
  store,
  render: (h) => h(App),
}).$mount("#app");
