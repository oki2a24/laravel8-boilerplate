<template>
  <header-menu />

  <div class="container-fluid">
    <div class="row">
      <sidebar-menu />

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <router-view />
      </main>
    </div>
  </div>
</template>

<script>
import HeaderMenu from "./HeaderMenu.vue";
import SidebarMenu from "./SidebarMenu.vue";

export default {
  name: "HeaderMenuSidebarMenu",
  components: { HeaderMenu, SidebarMenu },
  setup() {},
};
</script>
