<template>
  <div class="row mb-3">
    <label for="current_password" class="col-sm-2 col-form-label"
      >現在のパスワード</label
    >
    <div class="col-sm-10">
      <input
        id="current_password"
        v-model="data.current_password"
        type="password"
        class="form-control"
        :class="invalidClassValue('current_password')"
      />
      <div id="current_password" class="invalid-feedback">
        {{ invalidFeedbackMessage("current_password") }}
      </div>
    </div>
  </div>
  <div class="row mb-3">
    <label for="password" class="col-sm-2 col-form-label"
      >新しいパスワード</label
    >
    <div class="col-sm-10">
      <input
        id="password"
        v-model="data.password"
        type="password"
        class="form-control"
        :class="invalidClassValue('password')"
      />
      <div id="name" class="invalid-feedback">
        {{ invalidFeedbackMessage("password") }}
      </div>
    </div>
  </div>
  <div class="mb-3 row">
    <button type="button" class="btn btn-primary col-auto" @click="update">
      編集
    </button>
  </div>
</template>

<script>
import { computed, reactive } from "vue";
import { useRouter } from "vue-router";
import { useStore } from "vuex";

export default {
  name: "EditPassword",
  setup() {
    const router = useRouter();
    const store = useStore();

    // パスワード情報
    const data = reactive({
      current_password: null,
      password: null,
    });

    // パスワード更新
    const update = async () => {
      await store.dispatch("profile/updatePassword", data);

      if (store.getters["profile/hasInvalid"]) {
        return;
      }

      router.push({ name: "ProfileShowPassword" });
    };
    const invalidClassValue = computed(
      () => store.getters["profile/invalidClassValue"]
    );
    const invalidFeedbackMessage = computed(
      () => store.getters["profile/invalidFeedbackMessage"]
    );

    return { data, invalidFeedbackMessage, invalidClassValue, update };
  },
};
</script>
