<template>
  <div>
    <div class="flex justify-around  flex-wrap items-center space-x-2 px-4">
      <div class="flex flex-row items-center space-x-1">
        <div>
          <label>Digite para pesquisar</label>
          <Input
            @keydown.enter="$store.dispatch('cars/get', { url: null })"
            placeholder="Digite para pesquisar uma marca"
            v-model="search"
            :errors="$store.getters['getError']('name')"
          />
        </div>
        <div>
          <label>Campo:</label>
          <Input
            :errors="$store.getters['getError'](field)"
            type="select"
            placeholder="Pesquisar pelo campo"
            v-model="field"
            :options="[
              { key: 'model', value: 'Modelo' },
              { key: 'brand_name', value: 'Nome da marca' },
              { key: 'year', value: 'Ano' },
            ]"
          />
        </div>
      </div>
      <div class="flex items-center">
        <button
          @click="$store.dispatch('cars/get', { url: null })"
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
        <label>Modelo:</label>
        <Input
          placeholder="Modelo"
          v-model="model"
          :errors="$store.getters['getError']('model')"
        />
      </div>
      <div>
        <label>Ano:</label>
        <Input
          :errors="$store.getters['getError']('year')"
          placeholder="Ano"
          type="number"
          v-model="year"
        />
      </div>
      <div>
        <label>Marca:</label>
        <Input
          :errors="$store.getters['getError']('brand_id')"
          type="select"
          placeholder="Marca"
          v-model="brand_id"
          :options="$store.getters['brands/options']"
        />
      </div>
    </Modal>

    <Table
      :data="$store.state.cars.data"
      :next_page_url="$store.state.cars.next_page_url"
      :prev_page_url="$store.state.cars.prev_page_url"
      @next="$store.dispatch('cars/get', { url: $event })"
      @previous="$store.dispatch('cars/get', { url: $event })"
      @destroy="$store.dispatch('cars/destroy', $event.id)"
      @edit="edit($event)"
      :fields="[
        'id',
        'model',
        'year',
        'brand_name',
        'created_at',
        'updated_at',
      ]"
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
    brand_id: null,
    id: null,
    model: "",
    year: null,
    editing: false,
  }),
  computed: {
    search: {
      get() {
        return this.$store.state.cars.search;
      },
      set(value) {
        this.$store.commit("cars/SET_STATE", { key: "search", value });
      },
    },
    field: {
      get() {
        return this.$store.state.cars.field;
      },
      set(value) {
        this.$store.commit("cars/SET_STATE", { key: "field", value });
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
        .dispatch("cars/store", {
          model: this.model,
          year: this.year,
          brand_id: this.brand_id,
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
        .dispatch("cars/update", {
          model: this.model,
          year: this.year,
          brand_id: this.brand_id,
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
    edit({ model, year, brand_id, id }) {
      this.editing = true;
      this.model = model;
      this.year = year;
      this.brand_id = brand_id;
      this.id = id;
      this.isModalOpen = true;
    },
    clear() {
      this.id = null;
      this.brand_id = null;
      this.model = "";
      this.year = null;
      this.editing = false;
    },
  },
};
</script>
