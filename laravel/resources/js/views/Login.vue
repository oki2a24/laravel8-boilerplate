<template>
  <main class="text-center form-signin">
    <form @submit.prevent="login">
      <i
        class="bi bi-bootstrap-fill"
        alt="Bootstrap"
        style="font-size: 4rem; color: #7010f4"
      ></i>
      <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

      <div class="form-floating">
        <input
          id="floatingInput"
          v-model="credential.email"
          type="email"
          class="form-control"
          :class="{ 'is-invalid': isInvalid('email') }"
          placeholder="name@example.com"
          aria-describedby="floatingInputFeedback"
        />
        <div id="floatingInputFeedback" class="invalid-feedback">
          {{ invalidFeedbackMessage("email") }}
        </div>
        <label for="floatingInput">Email address</label>
      </div>
      <div class="form-floating">
        <input
          id="floatingPassword"
          v-model="credential.password"
          type="password"
          class="form-control"
          :class="{ 'is-invalid': isInvalid('password') }"
          placeholder="Password"
          aria-describedby="floatingPasswordFeedback"
        />
        <div id="floatingPasswordFeedback" class="invalid-feedback">
          {{ invalidFeedbackMessage("password") }}
        </div>
        <label for="floatingPassword">Password</label>
      </div>

      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me" /> Remember me
        </label>
      </div>
      <button class="w-100 btn btn-lg btn-primary" type="submit">
        Sign in
      </button>
      <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
    </form>
  </main>
</template>

<script>
import { computed } from "@vue/runtime-core";
import { reactive } from "@vue/reactivity";
import { useRouter } from "vue-router";
import { useStore } from "vuex";

export default {
  name: "Login",
  setup() {
    const router = useRouter();
    const store = useStore();

    const credential = reactive({
      email: "",
      password: "",
    });

    const login = async () => {
      await store.dispatch("auth/login", credential);
      if (store.getters["auth/isInvalid"]) {
        router.push({ name: "Dashboard" });
      }
    };
    const isInvalid = computed(() => store.getters["auth/isInvalid"]);
    const invalidFeedbackMessage = computed(
      () => store.getters["auth/invalidFeedbackMessage"]
    );

    return {
      credential,
      invalidFeedbackMessage,
      isInvalid,
      login,
    };
  },
};
</script>

<style scoped>
body {
  height: 100%;
}

body {
  display: flex;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

html,
.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}

.form-signin .checkbox {
  font-weight: 400;
}

.form-signin .form-floating:focus-within {
  z-index: 2;
}

.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

.bd-placeholder-img {
  font-size: 1.125rem;
  text-anchor: middle;
  -webkit-user-select: none;
  -moz-user-select: none;
  user-select: none;
}

@media (min-width: 768px) {
  .bd-placeholder-img-lg {
    font-size: 3.5rem;
  }
}
</style>
