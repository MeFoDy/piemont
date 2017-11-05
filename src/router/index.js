import About from "@/components/about/About.vue";
import Contacts from "@/components/contacts/Contacts.vue";
import Delivery from "@/components/delivery/Delivery.vue";
import Hero from "@/components/hero/Hero.vue";
import Production from "@/components/production/Production.vue";
import Router from "vue-router";
import Vue from "vue";

Vue.use(Router);

const router = new Router({
  routes: [
    { path: "/", redirect: { name: "main" } },
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
      path: "/delivery",
      name: "delivery",
      component: Delivery,
    },
    {
      path: "/contacts",
      name: "contacts",
      component: Contacts,
    },
  ],
  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition;
    }
    return { x: 0, y: 0 };
  },
});

router.beforeEach((to, from, next) => {
  if (router.app.emitter) {
    router.app.emitter.emit("loading-started");
  }
  next();
});
router.afterEach(() => {
  if (router.app.emitter) {
    router.app.emitter.emit("loading-finished");
  }
});

export default router;
