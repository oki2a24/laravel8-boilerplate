<template>
  <header-menu />

  <div class="container-fluid">
    <div class="row">
      <sidebar-menu />

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div
          class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
        >
          <h1>dashbord Index.vue</h1>
          <router-view />
        </div>
      </main>
    </div>
  </div>
</template>

<script>
import HeaderMenu from "../HeaderMenu.vue";
import SidebarMenu from "../SidebarMenu.vue";

export default {
  name: "DashboardIndex",
  components: { HeaderMenu, SidebarMenu },
  setup() {},
};
</script>
