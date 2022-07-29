import { createRouter, createWebHistory } from "vue-router";
import Container from "../views/Container.vue";
import Home from "../views/Home.vue";
import Login from "../views/Login.vue";
import ProfileTab from "../views/profile/Tab.vue";
import ProfileEditGeneral from "../views/profile/EditGeneral.vue";
import ProfileEditPassword from "../views/profile/EditPassword.vue";
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
        name: "ProfileTab",
        component: ProfileTab,
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
          {
            path: "password/edit",
            name: "ProfileEditPassword",
            component: ProfileEditPassword,
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
