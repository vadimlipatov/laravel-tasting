import "./bootstrap";
import { createApp } from "vue";
import { createRouter, createWebHistory } from "vue-router";

const app = createApp({});

import UserShow from "./components/Admin/User/Show.vue";
import ProductIndex from "./components/Admin/Product/Index.vue";
import ProductShow from "./components/Admin/Product/Show.vue";
import TastorShow from "./components/Tastor/Show.vue";

app.component("user-show", UserShow);
app.component("product-index", ProductIndex);
app.component("product-show", ProductShow);
app.component("tastor-show", TastorShow);

const routes = [];
const router = createRouter({
  history: createWebHistory(), // роуты без #
  routes,
});
app.use(router);
app.mount("#app");
