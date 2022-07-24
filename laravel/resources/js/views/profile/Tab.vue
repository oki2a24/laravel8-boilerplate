<template>
  <h1 class="mb-3">プロフィール</h1>

  <ul class="nav nav-tabs mb-5">
    <li class="nav-item">
      <router-link
        :to="{ name: 'ProfileShowGeneral' }"
        class="nav-link"
        :class="{ active: isExactActive('general', routeName) }"
        >概要</router-link
      >
    </li>
    <li class="nav-item">
      <router-link
        :to="{ name: 'ProfileShowPassword' }"
        class="nav-link"
        :class="{ active: isExactActive('password', routeName) }"
        >パスワード</router-link
      >
    </li>
  </ul>

  <router-view />
</template>

<script>
import { computed } from "@vue/runtime-core";
import { useRoute } from "vue-router";

export default {
  name: "ProfileTab",
  setup() {
    const route = useRoute();

    /*
     * 複数のページを一つのタブに割り当てる必要があるため
     * class に active を設定するかどうかの判定を制御
     */
    const routeName = computed(() => route.name);
    const isExactActive = (tab, routeName) => {
      const tabRoutes = [
        {
          tab: "general",
          routes: ["ProfileEditGeneral", "ProfileShowGeneral"],
        },
        { tab: "password", routes: ["ProfileShowPassword"] },
      ];

      const routes = tabRoutes.find((tabRoute) => tabRoute.tab === tab).routes;
      const isExactActive = routes.find((route) => route === routeName);

      return isExactActive;
    };

    return { isExactActive, routeName };
  },
};
</script>
