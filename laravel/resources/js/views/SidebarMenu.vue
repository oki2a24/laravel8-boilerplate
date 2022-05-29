<template>
  <!-- TODO サイドバー。スマホの時の挙動をどうするか? -->
  <!-- サイドバー -->
  <nav
    id="sidebarMenu"
    class="col-auto d-md-block bg-light sidebar collapse"
    @mouseover="showOffcanvas"
  >
    <div class="position-sticky pt-3">
      <ul class="nav flex-column">
        <li class="nav-item">
          <router-link
            class="nav-link"
            :to="{ name: 'Dashboard' }"
            :exact-active-class="'active'"
            ><i class="bi bi-house-door"></i
          ></router-link>
        </li>
        <li class="nav-item">
          <router-link
            class="nav-link"
            :to="{ name: 'UsersIndex' }"
            :exact-active-class="'active'"
            ><i class="bi bi-people"></i
          ></router-link>
        </li>
      </ul>
    </div>
  </nav>

  <!-- TODO オフキャンバス。スマホの時の挙動をどうするか? -->
  <!-- オフキャンバス -->
  <div
    id="sidebarMenuOffcanvas"
    ref="offcanvasElement"
    class="offcanvas offcanvas-start"
    tabindex="-1"
    aria-labelledby="sidebarMenuOffcanvasLabel"
    @mouseleave="hideOffcanvas"
  >
    <div class="offcanvas-header">
      <i
        class="bi bi-bootstrap-fill"
        alt="Bootstrap"
        style="font-size: 2.3rem; color: #7010f4"
      />
      <h5 id="sidebarMenuOffcanvasLabel" class="offcanvas-title">メニュー</h5>
      <button
        type="button"
        class="btn-close text-reset"
        data-bs-dismiss="offcanvas"
        aria-label="閉じる"
      ></button>
    </div>
    <div class="offcanvas-body">
      <ul class="nav flex-column">
        <li class="nav-item">
          <router-link
            class="nav-link"
            :to="{ name: 'Dashboard' }"
            :exact-active-class="'active'"
            ><i class="bi bi-house-door"></i> ダッシュボード</router-link
          >
        </li>
        <li class="nav-item">
          <router-link
            class="nav-link"
            :to="{ name: 'UsersIndex' }"
            :exact-active-class="'active'"
            ><i class="bi bi-people"></i> ユーザー</router-link
          >
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import { onMounted, ref } from "vue";
import { Offcanvas } from "bootstrap";

export default {
  name: "SidebarMenu",
  setup() {
    const offcanvasElement = ref(null);
    let bsOffcanvas = null;

    onMounted(() => {
      bsOffcanvas = new Offcanvas(offcanvasElement.value);
    });

    const showOffcanvas = () => {
      bsOffcanvas.show();
    };

    const hideOffcanvas = () => {
      bsOffcanvas.hide();
    };

    return {
      hideOffcanvas,
      offcanvasElement,
      showOffcanvas,
    };
  },
};
</script>

<style scoped>
/*
 * Sidebar
 */

.sidebar {
  position: fixed;
  top: 0;
  /* rtl:raw:
  right: 0;
  */
  bottom: 0;
  /* rtl:remove */
  left: 0;
  z-index: 100; /* Behind the navbar */
  padding: 48px 0 0; /* Height of navbar */
  box-shadow: inset -1px 0 0 rgba(0, 0, 0, 0.1);
}

@media (max-width: 767.98px) {
  .sidebar {
    top: 5rem;
  }
}

.sidebar-sticky {
  position: relative;
  top: 0;
  height: calc(100vh - 48px);
  padding-top: 0.5rem;
  overflow-x: hidden;
  overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
}

.sidebar .nav-link {
  font-weight: 500;
  color: #333;
}

.sidebar .nav-link .feather {
  margin-right: 4px;
  color: #727272;
}

.sidebar .nav-link.active {
  color: #007bff;
}

.sidebar .nav-link:hover .feather,
.sidebar .nav-link.active .feather {
  color: inherit;
}

.sidebar-heading {
  font-size: 0.75rem;
  text-transform: uppercase;
}

/*
 * オフキャンバス
 */
.offcanvas-body .nav-link {
  font-weight: 500;
  color: #333;
}

.offcanvas-body .nav-link.active {
  color: #007bff;
}
</style>
