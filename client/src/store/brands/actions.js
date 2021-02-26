import { Axios } from "@/utils/variables";
export default {
  async get({ commit, state }, { url = null }) {
    const name = state.search ?? null;
    return await Axios.get(url ?? "/marcas", {
      params: {
        name,
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
    return await Axios.post("/marcas", payload).then(({ data }) => {
      dispatch("get", { url: null });
      return data;
    });
  },

  async update({ dispatch }, payload) {
    return await Axios.put(`/marcas/${payload.id}`, payload).then(
      ({ data }) => {
        dispatch("get", { url: null });
        return data;
      }
    );
  },

  async destroy({ dispatch }, record) {
    await Axios.delete(`/marcas/${record}`).then(() => {
      dispatch("get", { url: null });
    });
  },
};
