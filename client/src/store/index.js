import { createStore } from "vuex";
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
});

export default store;
