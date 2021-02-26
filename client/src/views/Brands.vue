<template>
  <div>
    <div class="flex justify-between  flex-wrap items-center space-x-2 px-4">
      <div class="w-full sm:w-2/4 lg:w-1/4">
        <label>Nome da marca</label>
        <Input
          @keydown.enter="$store.dispatch('brands/get', { url: null })"
          placeholder="Digite para pesquisar uma marca"
          v-model="search"
          :errors="$store.getters['getError']('name')"
        />
      </div>
      <div class="flex items-center">
        <button
          @click="$store.dispatch('brands/get', { url: null })"
          class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded-full shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1"
          type="button"
          style="transition: all .15s ease"
        >
          Pesquisar
        </button>
        <button
          @click="create"
          class="bg-blue-500 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded-full shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1"
          type="button"
          style="transition: all .15s ease"
        >
          Criar
        </button>
      </div>
    </div>

    <Modal
      @saved="editing ? update() : store()"
      :title="editing ? 'Editando' : 'Criar novo registro'"
      :isOpen="isModalOpen"
      @close="isModalOpen = false"
      ><div>
        <label>Nome:</label>
        <Input
          placeholder="Nome"
          v-model="name"
          :errors="$store.getters['getError']('name')"
        />
      </div>
    </Modal>
    <Table
      :data="$store.state.brands.data"
      :next_page_url="$store.state.brands.next_page_url"
      :prev_page_url="$store.state.brands.prev_page_url"
      @next="$store.dispatch('brands/get', { url: $event })"
      @previous="$store.dispatch('brands/get', { url: $event })"
      @destroy="$store.dispatch('brands/destroy', $event.id)"
      @edit="edit($event)"
      :fields="['id', 'name', 'created_at', 'updated_at']"
    >
    </Table>
  </div>
</template>

<script>
import Input from "../components/Input.vue";
import Modal from "../components/Modal.vue";
import Table from "../components/Table.vue";

export default {
  name: "Home",
  components: { Table, Input, Modal },
  data: () => ({
    isModalOpen: false,
    brands: [],
    id: null,
    name: "",
    editing: false,
  }),
  computed: {
    search: {
      get() {
        return this.$store.state.brands.search;
      },
      set(value) {
        this.$store.commit("brands/SET_STATE", { key: "search", value });
      },
    },
  },
  methods: {
    create() {
      this.clear();
      this.isModalOpen = true;
    },
    store() {
      this.$store
        .dispatch("brands/store", {
          name: this.name,
        })
        .then((data) => {
          console.log(data);
          this.isModalOpen = false;
          this.clear();
          this.$store.commit("CLEAR_ERRORS");
        })
        .catch((error) => {
          this.$store.commit("SET_ERRORS", error.response.data.errors);
        });
    },
    update() {
      this.$store
        .dispatch("brands/update", {
          name: this.name,

          id: this.id,
        })
        .then(() => {
          this.isModalOpen = false;
          this.clear();
          this.$store.commit("CLEAR_ERRORS");
        })
        .catch((error) => {
          this.$store.commit("SET_ERRORS", error.response.data.errors);
        });
    },
    edit({ name, id }) {
      this.editing = true;
      this.name = name;
      this.id = id;
      this.isModalOpen = true;
    },
    clear() {
      this.id = null;
      this.name = "";
      this.editing = false;
    },
  },
};
</script>
