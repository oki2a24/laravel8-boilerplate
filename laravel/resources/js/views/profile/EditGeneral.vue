<template>
  <div class="row mb-3">
    <label for="name" class="col-sm-2 col-form-label">名前</label>
    <div class="col-sm-10">
      <input
        id="name"
        v-model="profile.name"
        type="text"
        class="form-control"
        :class="invalidClassValue('name')"
      />
      <div id="name" class="invalid-feedback">
        {{ invalidFeedbackMessage("name") }}
      </div>
    </div>
  </div>
  <div class="row mb-3">
    <label for="email" class="col-sm-2 col-form-label">メールアドレス</label>
    <div class="col-sm-10">
      <input
        id="email"
        v-model="profile.email"
        type="email"
        class="form-control"
        :class="invalidClassValue('email')"
      />
      <div id="name" class="invalid-feedback">
        {{ invalidFeedbackMessage("email") }}
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
  name: "EditGeneral",
  setup() {
    const router = useRouter();
    const store = useStore();

    // プロフィール情報
    const profile = reactive({
      id: null,
      name: null,
      email: null,
    });

    // 更新
    const update = async () => {
      await store.dispatch("profile/update", profile);

      if (store.getters["profile/hasInvalid"]) {
        return;
      }

      router.push({ name: "ProfileShowGeneral" });
    };
    const invalidClassValue = computed(
      () => store.getters["profile/invalidClassValue"]
    );
    const invalidFeedbackMessage = computed(
      () => store.getters["profile/invalidFeedbackMessage"]
    );

    // 初期処理
    store.commit("profile/resetError");
    (async () => {
      await store.dispatch("profile/getIfNeeded");
      Object.assign(profile, store.getters["profile/data"]);
    })();

    return { invalidFeedbackMessage, invalidClassValue, profile, update };
  },
};
</script>
