<template>
  <AuthenticatedLayout>
    <main class="w-50 flex justify-center items-center">
    <form @submit.prevent="submit">
      <div>
        <InputLabel for="name" value="Name" />

        <TextInput
          id="name"
          type="text"
          class="mt-1 block w-full"
          v-model="user.name"
          required
          autofocus
          autocomplete="name"
        />

        <InputError class="mt-2" :message="user.errors.name" />
      </div>

      <div class="mt-4 mb-2">
        <InputLabel for="email" value="Email" />

        <TextInput
          id="email"
          type="email"
          class="mt-1 block w-full"
          v-model="user.email"
          required
          autocomplete="username"
        />

        <InputError class="mt-2" :message="user.errors.email" />
      </div>
        <PrimaryButton class="bg-zinc-400" type="submit">Editar</PrimaryButton>
    </form>
  </main>
  </AuthenticatedLayout>
</template>
  
<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
  users: {
    Object,
    required: true,
    default: {},
  },
});

const user = useForm(props.users);

const submit = () => {
  user.put(route("user.update",user.id), {
    onSuccess: () => {
       console.log('sucesso')
    },
  });
};

</script>