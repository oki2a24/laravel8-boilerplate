import { createRouter, createWebHistory } from "vue-router";
import HeaderMenuSidebarMenu from "../views/HeaderMenuSidebarMenu.vue";
import Home from "../views/Home.vue";
import Login from "../views/Login.vue";
import UsersIndex from "../views/users/Index.vue";

const routes = [
  { path: "/", name: "Home", component: Home },
  { path: "/login", name: "Login", component: Login },
  {
    path: "",
    component: HeaderMenuSidebarMenu,
    children: [
      { path: "/dashboard", name: "Dashboard", component: UsersIndex },
      { path: "/users", name: "UsersIndex", component: UsersIndex },
    ],
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
