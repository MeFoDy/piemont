import About from "@/components/about/About.vue";
import Contacts from "@/components/contacts/Contacts.vue";
import Hero from "@/components/hero/Hero.vue";
import Partners from "@/components/partners/Partners.vue";
import Production from "@/components/production/Production.vue";
import Router from "vue-router";
import Vue from "vue";

Vue.use(Router);

export default new Router({
  routes: [
    { path: "/", redirect: { name: "main" }},
    {
      path: "/main",
      name: "main",
      component: Hero,
    },
    {
      path: "/about",
      name: "about",
      component: About,
    },
    {
      path: "/production",
      name: "production",
      component: Production,
    },
    {
      path: "/partners",
      name: "partners",
      component: Partners,
    },
    {
      path: "/contacts",
      name: "contacts",
      component: Contacts,
    },
  ],
});
