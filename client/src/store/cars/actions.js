import { Axios } from "@/utils/variables";
export default {
  async get({ commit, state }, { url = null }) {
    return await Axios.get(url ?? "/carros", {
      params: {
        [state.field]: state.search,
      },
    }).then(({ data }) => {
      const { data: items, next_page_url, prev_page_url } = data;
      commit("SET_STATE", { key: "search", value: null });
      commit("SET_STATE", { key: "data", value: items });
      commit("SET_STATE", { key: "next_page_url", value: next_page_url });
      commit("SET_STATE", { key: "prev_page_url", value: prev_page_url });
    });
  },

  async store({ dispatch }, payload) {
    return await Axios.post("/carros", payload).then(({ data }) => {
      dispatch("get", { url: null });
      return data;
    });
  },

  async update({ dispatch }, payload) {
    return await Axios.put(`/carros/${payload.id}`, payload).then(
      ({ data }) => {
        dispatch("get", { url: null });
        return data;
      }
    );
  },

  async destroy({ dispatch }, record) {
    await Axios.delete(`/carros/${record}`).then(() => {
      dispatch("get", { url: null });
    });
  },
};
