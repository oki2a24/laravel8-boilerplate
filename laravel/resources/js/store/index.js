import { createStore } from "vuex";
import auth from "./modules/auth";
import profile from "./modules/profile";

export default createStore({
  state: {},
  mutations: {},
  actions: {},
  modules: {
    auth,
    profile,
  },
});
