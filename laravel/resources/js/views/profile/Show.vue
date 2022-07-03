<template>
  <h1 class="mb-3">プロフィール</h1>

  <ul class="nav nav-tabs mb-5">
    <li class="nav-item">
      <router-link
        :to="{ name: 'ProfileShowGeneral' }"
        :exact-active-class="'active'"
        class="nav-link"
        >概要</router-link
      >
    </li>
    <li class="nav-item">
      <router-link
        :to="{ name: 'ProfileShowPassword' }"
        :exact-active-class="'active'"
        class="nav-link"
        >パスワード</router-link
      >
    </li>
  </ul>

  <router-view />
</template>

<script>
export default {
  name: "ProfileShow",
  setup() {},
};
</script>
