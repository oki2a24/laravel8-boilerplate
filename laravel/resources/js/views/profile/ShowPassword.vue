<template>
  <div class="mb-3 row">
    <label class="col-sm-2 col-form-label">パスワード</label>
    <div class="col-sm-10">
      <span class="form-control-plaintext">**********</span>
    </div>
  </div>
  <div class="mb-3 row">
    <button type="button" class="btn btn-primary col-auto" @click="goEdit">
      編集
    </button>
  </div>
</template>

<script>
import { useRouter } from "vue-router";

export default {
  name: "ProfileShowPassword",
  setup() {
    const router = useRouter();

    // 編集ページへ移動
    const goEdit = () => {
      router.push({ name: "ProfileEditPassword" });
    };

    return { goEdit };
  },
};
</script>
