import Vue from "vue";
import Vuex from "vuex";
import { BrandModule as brands } from "./brands";
import { CarModule as cars } from "./cars";

Vue.use(Vuex);

export default new Vuex.Store({
  state: { errors: {} },
  mutations: {
    SET_ERRORS: (state, errors) => {
      state.errors = errors;
    },
    CLEAR_ERRORS: (state) => {
      state.errors = {};
    },
  },
  getters: {
    getError: (state) => (field) => {
      return state.errors[field] ?? null;
    },
  },
  actions: {},
  modules: {
    brands,
    cars,
  },
});
