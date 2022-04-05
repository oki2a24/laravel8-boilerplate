import axios from "../../api/axios";

const state = {
  error: {},
};

const getters = {
  isInvalid: (state) => (errorsKey) => {
    const errors = state.error?.errors ?? {};
    return Object.keys(errors).some((element) => element === errorsKey);
  },
  invalidFeedbackMessage: (state) => (errorsKey) => {
    return state.error?.errors?.[errorsKey]?.reduce((pre, cur) => {
      return `${pre} ${cur}`;
    }, "");
  },
};

const actions = {
  async login({ commit }, credential) {
    axios
      .get("/sanctum/csrf-cookie")
      .then(() => {
        return axios.post("api/login", credential);
      })
      .then(() => {
        commit("setError", {});
      })
      .catch((error) => {
        commit("setError", error.response.data);
      });
  },
};
const mutations = {
  setError(state, data) {
    state.error = data;
  },
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations,
};
