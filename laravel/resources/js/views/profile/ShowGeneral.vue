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
  <div class="mb-3 row">
    <button type="button" class="btn btn-primary col-auto" @click="goEdit">
      編集
    </button>
  </div>
</template>

<script>
import { computed } from "vue";
import { useRouter } from "vue-router";
import { useStore } from "vuex";

export default {
  name: "ProfileShowGeneral",
  setup() {
    const router = useRouter();
    const store = useStore();

    // プロフィール情報
    const profile = computed(() => store.getters["profile/data"]);
    store.dispatch("profile/getIfNeeded");

    // 編集ページへ移動
    const goEdit = () => {
      router.push({ name: "ProfileEditGeneral" });
    };

    return { goEdit, profile };
  },
};
</script>
