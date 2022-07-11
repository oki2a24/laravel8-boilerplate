<template>
  <h1>プロフィール概要編集</h1>

  <div class="row mb-3">
    <label for="name" class="col-sm-2 col-form-label">名前</label>
    <div class="col-sm-10">
      <input
        id="name"
        v-model="profile.name"
        type="text"
        class="form-control"
      />
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
      />
    </div>
  </div>
  <div class="mb-3 row">
    <button type="button" class="btn btn-primary col-auto" @click="update">
      編集
    </button>
  </div>
</template>

<script>
import { reactive } from "vue";
import { useStore } from "vuex";

export default {
  name: "EditGeneral",
  setup() {
    const store = useStore();

    // プロフィール情報
    const profile = reactive({
      id: null,
      name: null,
      email: null,
    });

    // 更新
    const update = () => {
      console.log("update start!!!!!!");
    };

    // 初期処理
    (async () => {
      await store.dispatch("profile/getIfNeeded");
      Object.assign(profile, store.getters["profile/data"]);
    })();

    return { profile, update };
  },
};
</script>
