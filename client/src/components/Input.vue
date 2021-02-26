<template>
  <div class="mb-3 pt-0">
    <select
      @input="$emit('input', $event.target.value)"
      class="px-3 py-3 placeholder-gray-400 text-gray-700 relative bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full"
      v-if="type === 'select'"
    >
      <option v-if="!options.length" value="">Selecionar</option>
      <option :value="option.key" v-for="(option, key) in options" :key="key">{{
        option.value
      }}</option>
    </select>
    <input
      v-else
      @keydown="$emit('keydown', $event)"
      :type="type"
      :value="value"
      @input="$emit('input', $event.target.value)"
      :placeholder="placeholder"
      class="px-3 py-3 placeholder-gray-400 text-gray-700 relative bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full"
    />

    <div v-if="errors">
      <span
        v-for="(error, key) in errors"
        :key="key"
        class="text-sm antialiased text-red-500"
      >
        {{ error }}</span
      >
    </div>
  </div>
</template>

<script>
export default {
  props: {
    placeholder: {
      default: "placeholder",
    },
    value: {
      required: true,
    },
    type: {
      type: String,
      default: "text",
    },
    errors: {
      type: Array,
      default: () => {
        return [];
      },
    },
    options: {
      type: Array,
      default: () => {
        return [];
      },
    },
  },
};
</script>
