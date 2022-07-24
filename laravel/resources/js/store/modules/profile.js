import axios from "../../api/axios";

const state = {
  data: {},
  error: {},
};

const getters = {
  data: (state) => {
    return state.data;
  },
  exists: (state) => {
    return Object.keys(state.data).length > 0;
  },
  hasInvalid: (state) => {
    const errors = state.error?.errors ?? {};
    return Object.keys(errors).length > 0;
  },
  invalidClassValue: (state) => (errorsKey) => {
    return state.error?.errors?.[errorsKey] ? "is-invalid" : "";
  },
  invalidFeedbackMessage: (state) => (errorsKey) => {
    return state.error?.errors?.[errorsKey]?.reduce((pre, cur) => {
      return `${pre} ${cur}`;
    }, "");
  },
};

const actions = {
  async get({ commit }) {
    await axios.get("api/user").then((response) => {
      commit("setData", response.data);
    });
  },
  async getIfNeeded({ dispatch, getters }) {
    if (getters.exists) {
      return;
    }
    await dispatch("get");
  },
  async update({ commit }, data) {
    await axios
      .put("api/user/profile-information", data)
      .then((response) => {
        commit("setData", response.data);
        commit("setError", {});
      })
      .catch((error) => {
        commit("setError", error.response.data);
      });
  },
};
const mutations = {
  setData(state, data) {
    state.data = data;
  },
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
