<template>
    <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
      <thead
        class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400"
      >
        <tr>
          <th v-for="column in columns" :key="column.key" class="px-4 py-4">
            {{ column.label }}
          </th>
          <th class="px-4 py-4">action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-if="rows.length === 0">
          <td :colspan="columns.length + 1" class="px-4 py-3 text-center">
            No data
          </td>
        </tr>
        <tr
          v-for="row in rows"
          :key="row.id"
          class="border-b dark:border-gray-700"
        >
          <td v-for="column in columns" :key="column.key" class="px-4 py-3">
            {{ row[column.key] }}
          </td>
          <td class="flex items-center px-4 py-3">

            <!-- authors.follows post -->
            <!-- authors.follows delete -->

            <pre>{{ JSON.stringify(row.followed, null, 2) }}</pre>

            <Link 
                    as="button"
                    :href="route('authors.follows', row.id)" method="post"
                    class="mr-2 flex items-center justify-center rounded-lg bg-blue-700 px-4 py-2 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                >
                Follow
            </Link>
            <Link 
                as="button"
                :href="route('authors.follows', row.id)" method="delete"
                class="flex items-center justify-center rounded-lg bg-red-700 px-4 py-2 text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
            >
                Unfollow
            </Link>
          </td>
        </tr>
      </tbody>
    </table>
  </template>
  
<script setup>
  import { Link } from '@inertiajs/vue3';

  const { rows, columns } = defineProps({
    rows: {
      type: Array,
      required: true
    },
    columns: {
      type: Array,
      required: true
    }
  })
  
  </script>