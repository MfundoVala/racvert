import { createStore } from "vuex";
import createPersistedState from "vuex-persistedstate";
import state from "./state";
import * as mutations from "./mutations";
import * as actions from "./actions";
import * as getters from "./getters";

const store = createStore({
  actions,
  mutations,
  state,
  getters,
  modules: {},
  plugins: [createPersistedState({ paths: ["user", "organisation"] })],
});

export default store;
