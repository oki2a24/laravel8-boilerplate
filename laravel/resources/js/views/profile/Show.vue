<template>
  <h1>プロフィール</h1>

  <ul class="nav nav-tabs">
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
