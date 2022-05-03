<template>
  <header
    class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow"
  >
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 py-0" href="#">
      <i
        class="bi bi-bootstrap-fill"
        alt="Bootstrap"
        style="font-size: 2.3rem; color: #7010f4"
      />
    </a>
    <button
      class="navbar-toggler position-absolute d-md-none collapsed"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#sidebarMenu"
      aria-controls="sidebarMenu"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>

    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="#"><i class="bi bi-box-arrow-right" /> ログアウト</a>
      </li>
    </ul>
  </header>
</template>

<script>
export default {
  name: "HeaderMenu",
  setup() {},
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

.navbar .form-control {
  padding: 0.75rem 1rem;
  border-width: 0;
  border-radius: 0;
}
</style>
