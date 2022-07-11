import { createRouter, createWebHistory } from "vue-router";
import Container from "../views/Container.vue";
import Home from "../views/Home.vue";
import Login from "../views/Login.vue";
import ProfileShow from "../views/profile/Show.vue";
import ProfileEditGeneral from "../views/profile/EditGeneral.vue";
import ProfileShowGeneral from "../views/profile/ShowGeneral.vue";
import ProfileShowPassword from "../views/profile/ShowPassword.vue";
import UsersIndex from "../views/users/Index.vue";

const routes = [
  { path: "/", name: "Home", component: Home },
  { path: "/login", name: "Login", component: Login },
  {
    path: "",
    component: Container,
    children: [
      { path: "/dashboard", name: "Dashboard", component: UsersIndex },
      {
        path: "/profile",
        name: "ProfileShow",
        component: ProfileShow,
        children: [
          {
            path: "",
            name: "ProfileShowGeneral",
            component: ProfileShowGeneral,
          },
          {
            path: "edit",
            name: "ProfileEditGeneral",
            component: ProfileEditGeneral,
          },
          {
            path: "password",
            name: "ProfileShowPassword",
            component: ProfileShowPassword,
          },
        ],
      },
      { path: "/users", name: "UsersIndex", component: UsersIndex },
    ],
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
