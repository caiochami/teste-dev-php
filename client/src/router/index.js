import Vue from "vue";
import VueRouter from "vue-router";
import Cars from "../views/Cars.vue";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "home",
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/Home.vue"),
  },
  {
    path: "/cars",
    name: "cars",
    component: Cars,
  },
  {
    path: "/brands",
    name: "brands",
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/Brands.vue"),
  },
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});

export default router;
