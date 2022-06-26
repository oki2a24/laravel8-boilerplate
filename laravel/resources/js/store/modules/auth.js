import axios from "../../api/axios";

const state = {
  data: {},
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
  isLoggedIn: (state) => {
    return Object.keys(state.data).length > 0;
  },
  user: (state) => {
    return state.data;
  },
};

const actions = {
  async login({ dispatch, commit }, credential) {
    await axios
      .get("/sanctum/csrf-cookie")
      .then(() => {
        return axios.post("api/login", credential);
      })
      .then(() => {
        return dispatch("getUser");
      })
      .then(() => {
        commit("setError", {});
      })
      .catch((error) => {
        commit("setError", error.response.data);
      });
  },
  async logout({ commit }) {
    await axios
      .post("/api/logout")
      .then(() => {
        commit("setData", {});
        commit("setError", {});
      })
      .catch((error) => {
        commit("setError", error.response.data);
      });
  },
  async getUser({ commit }) {
    await axios.get("api/user").then((response) => {
      commit("setData", response.data);
    });
  },
  getUserIfNeeded({ dispatch, getters }) {
    if (getters["isLoggedIn"]) {
      return;
    }
    dispatch("getUser");
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
