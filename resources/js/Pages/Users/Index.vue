<template>
  <AuthenticatedLayout>
    <div class="flex flex-col">
      <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
          <div class="overflow-hidden">
            <table
              class="min-w-full text-left text-sm font-light text-surface dark:text-white"
            >
              <thead
                class="border-b border-neutral-200 font-medium dark:border-white/10"
              >
                <tr>
                  <th scope="col" class="px-6 py-4">#</th>
                  <th scope="col" class="px-6 py-4">Nome</th>
                  <th scope="col" class="px-6 py-4">Email</th>
                  <th scope="col" class="px-6 py-4">ação</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="(user, idx) in users"
                  :key="idx"
                  class="border-b border-neutral-200 dark:border-white/10"
                >
                  <td class="whitespace-nowrap px-6 py-4 font-medium">
                    {{ user.id }}
                  </td>
                  <td class="whitespace-nowrap px-6 py-4">{{ user.name }}</td>
                  <td class="whitespace-nowrap px-6 py-4">{{ user.email }}</td>
                  <td class="whitespace-nowrap px-6 py-4">
                    <button class="bg-red">
                        <Link :href="route('user.edit',user.id)">Editar</Link>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import {Link} from '@inertiajs/vue3'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps({
  users: {
    Object,
    required: true,
    default: {},
  },
});
</script>

<style scoped>
</style>