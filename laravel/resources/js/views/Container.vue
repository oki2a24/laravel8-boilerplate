<template>
  <header-menu />

  <div class="container-fluid">
    <div class="row">
      <!-- ヘッダー、サイドメニュー、コンテンツ、各部分の幅等についてお互いに関係しあっているので、パーツごとに分離するのは筋が悪いように思える -->
      <!-- サイドメニューの無いページはありそうなので、ヘッダーはパーツ化したままで良さそう -->
      <sidebar-menu />

      <main class="col-11 ms-auto pt-3">
        <router-view />
      </main>
    </div>
  </div>
</template>

<script>
import HeaderMenu from "./HeaderMenu.vue";
import SidebarMenu from "./SidebarMenu.vue";

export default {
  name: "Container",
  components: { HeaderMenu, SidebarMenu },
  setup() {},
};
</script>
