<template>
  <header
    class="navbar navbar-expand-lg navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow"
  >
    <div class="container-fluid ps-0">
      <router-link
        :to="{ name: 'Dashboard' }"
        class="navbar-brand col-md-auto col-lg-auto me-0 px-3 py-0"
      >
        <i
          class="bi bi-bootstrap-fill"
          alt="Bootstrap"
          style="font-size: 2.3rem; color: #7010f4"
        />
      </router-link>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div
        id="navbarNavDropdown"
        class="collapse navbar-collapse justify-content-end"
      >
        <ul class="navbar-nav px-3">
          <li class="nav-item dropdown">
            <a
              id="navbarDropdownMenuLink"
              class="nav-link dropdown-toggle"
              href="#"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              {{ profile.name }}
            </a>
            <ul
              class="dropdown-menu dropdown-menu-end"
              aria-labelledby="navbarDropdownMenuLink"
            >
              <li>
                <router-link
                  :to="{ name: 'ProfileShowGeneral' }"
                  class="dropdown-item"
                  ><i class="bi bi-person"></i> プロフィール</router-link
                >
              </li>
              <li>
                <button
                  type="button"
                  class="dropdown-item btn btn-link"
                  @click="logout"
                >
                  <i class="bi bi-box-arrow-right" /> ログアウト
                </button>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </header>
</template>

<script>
import { computed } from "vue";
import { useRouter } from "vue-router";
import { useStore } from "vuex";

export default {
  name: "HeaderMenu",
  setup() {
    const router = useRouter();
    const store = useStore();

    const profile = computed(() => store.getters["profile/data"]);

    // ページリロード時にログイン状態を保持するために実行
    store.dispatch("profile/getIfNeeded");

    const logout = async () => {
      await store.dispatch("auth/logout");
      if (store.getters["auth/isInvalid"]) {
        router.push({ name: "Login" });
      } else {
        // エラー時の処理を行う予定がないため、簡易的にブラウザ側で出力
        console.warn(store.state.auth.error);
      }
    };

    return { logout, profile };
  },
};
</script>

<style scoped>
/*
 * Navbar
 */

.navbar-brand {
  padding-top: 0.75rem;
  padding-bottom: 0.75rem;
  font-size: 1rem;
  background-color: rgba(0, 0, 0, 0.25);
  box-shadow: inset -1px 0 0 rgba(0, 0, 0, 0.25);
}

.navbar .navbar-toggler {
  top: 0.25rem;
  right: 1rem;
}
</style>
