<template>
  <div>
    <div class="shadow overflow-auto border border-gray-200 sm:rounded-lg m-6">
      <table class="w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th
              class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
            ></th>

            <th
              v-for="(field, key) in fields"
              :key="key"
              class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
            >
              {{ field }}
            </th>
            <th
              class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
            >
              Actions
            </th>
          </tr>
        </thead>
        <tbody class="bg-white text-xs divide-y divide-gray-200">
          <tr v-if="!data.length">
            <td
              :colspan="fields.length + 2"
              class="px-2 py-4 whitespace-nowrap text-center text-gray-600"
            >
              Nenhuma informação encontrada
            </td>
          </tr>
          <tr v-for="(item, key) in data" :key="key">
            <td class="px-2 py-4 whitespace-nowrap"></td>

            <!-- <div:key="fieldKey"> -->
            <td
              v-for="(field, fieldKey) in fields"
              :key="fieldKey"
              class="px-2 py-4 whitespace-nowrap"
            >
              {{ item[field] }}
            </td>
            <!-- </div> -->

            <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">
              <div class="flex justify-start space-x-1">
                <button
                  @click="$emit('edit', item)"
                  class="border-2 border-indigo-200 rounded-md p-1"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    class="h-4 w-4 text-gray-500"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                    />
                  </svg>
                </button>
                <button
                  @click="$emit('destroy', item)"
                  class="border-2 border-red-200 rounded-md p-1"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    class="h-4 w-4 text-red-500"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                    />
                  </svg>
                </button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
      <div class="py-2 flex justify-center align-middle">
        <nav class="block">
          <ul class="flex pl-0 rounded list-none flex-wrap">
            <li>
              <a
                @click.prevent="$emit('previous', prev_page_url)"
                href="#"
                class="first:ml-0 text-xs font-semibold flex w-8 h-8 mx-1 p-0 rounded-full items-center justify-center leading-tight relative border border-solid border-green-500 bg-white text-green-500"
              >
                Prev
              </a>
            </li>

            <li>
              <a
                @click.prevent="$emit('next', next_page_url)"
                href="#"
                class="first:ml-0 text-xs font-semibold flex w-8 h-8 mx-1 p-0 rounded-full items-center justify-center leading-tight relative border border-solid border-green-500 bg-white text-green-500"
              >
                Next
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    fields: {
      type: Array,
      required: true,
    },
    data: {
      type: Array,
      required: true,
    },
    next_page_url: {
      type: String,
      default: null,
    },
    prev_page_url: {
      type: String,
      default: null,
    },
  },
};
</script>
