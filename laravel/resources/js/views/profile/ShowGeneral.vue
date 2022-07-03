<template>
  <div class="mb-3 row">
    <label class="col-sm-2 col-form-label">名前</label>
    <div class="col-sm-10">
      <span class="form-control-plaintext">{{ profile.name }}</span>
    </div>
  </div>
  <div class="mb-3 row">
    <label class="col-sm-2 col-form-label">メールアドレス</label>
    <div class="col-sm-10">
      <span class="form-control-plaintext">{{ profile.email }}</span>
    </div>
  </div>
</template>

<script>
import { computed } from "vue";
import { useStore } from "vuex";

export default {
  name: "ProfileShowGeneral",
  setup() {
    const store = useStore();

    // プロフィール
    const profile = computed(() => store.getters["profile/data"]);
    store.dispatch("profile/getIfNeeded");

    return { profile };
  },
};
</script>
