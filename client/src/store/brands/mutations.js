export default {
  SET_STATE(state, { key, value }) {
    state[key] = value;
  },

  SET_FORM(state, { key, value }) {
    state.form[key] = value;
  },

  CLEAR(state) {
    state.form.name = "";
    state.id = null;
  },
};
