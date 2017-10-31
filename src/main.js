import "vue-awesome/icons/envelope-o";
import "vue-awesome/icons/fax";
import "vue-awesome/icons/home";
import "vue-awesome/icons/minus";
import "vue-awesome/icons/phone";
import "vue-awesome/icons/plus";
import "vue-awesome/icons/refresh";
import "vue-awesome/icons/user";

import App from "./App";
import Icon from "vue-awesome/components/Icon";
import NanoEvents from "nanoevents";
import Vue from "vue";
import VueResource from "vue-resource";
import YmapPlugin from "vue-yandex-maps";
import basket from "@/basket";
import jquery from "jquery";
import router from "./router";

const emitter = new NanoEvents();

Vue.component("icon", Icon);

window.$ = window.jQuery = jquery;

Vue.use(YmapPlugin);
Vue.use(VueResource);

const VueInputMask = require("vue-inputmask").default;
Vue.use(VueInputMask);

Vue.config.productionTip = false;

/* eslint-disable no-new */
new Vue({
  data: {
    basket: basket.basket,
    categories: basket.categories,
    emitter: emitter,
  },
  el: "#app",
  router,
  template: "<App/>",
  components: { App },
});
