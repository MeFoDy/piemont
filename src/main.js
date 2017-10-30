// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import "vue-awesome/icons/envelope-o";
import "vue-awesome/icons/fax";
import "vue-awesome/icons/home";
import "vue-awesome/icons/minus";
import "vue-awesome/icons/phone";
import "vue-awesome/icons/plus";
import "vue-awesome/icons/user";

import App from "./App";
import Icon from "vue-awesome/components/Icon";
import Vue from "vue";
import VueResource from "vue-resource";
import YmapPlugin from "vue-yandex-maps";
import jquery from "jquery";
import router from "./router";


Vue.component("icon", Icon);

window.$ = window.jQuery = jquery;

Vue.use(YmapPlugin);
Vue.use(VueResource);
Vue.config.productionTip = false;

/* eslint-disable no-new */
new Vue({
  el: "#app",
  router,
  template: "<App/>",
  components: { App },
});
