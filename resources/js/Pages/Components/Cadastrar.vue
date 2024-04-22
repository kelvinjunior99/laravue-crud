<script setup>
import { reactive, computed } from 'vue'
import { Link } from '@inertiajs/vue3'
import { router, usePage } from '@inertiajs/vue3'
import Header from './Header.vue'
import { Head } from '@inertiajs/vue3'

defineProps({ errors: Object })
 
const form = reactive({
    nome: '',
    numero: '',
    cp: '',
});

function submit() {
    router.post('create', form);
}

</script>

<template>

    <Head title="Cadastrar" />
    <Header />


    <form class="container mt-4" @submit.prevent="submit">

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label fw-bold">Nome</label>
            <input type="text" v-model="form.nome" class="form-control" id="exampleFormControlInput1" placeholder="Nome">
         
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label fw-bold">Numero</label>
            <input type="text" v-model="form.numero" class="form-control" id="exampleFormControlInput1" placeholder="Numero">
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label fw-bold">CP</label>
            <input type="text" v-model="form.cp" class="form-control" id="exampleFormControlInput1" placeholder="">
        </div>

        <div class="d-grid gap-2">
            <button class="btn btn-success" type="submit">Cadastrar</button>
        </div>

    </form>

</template>



<style scoped>
.form-control {
    border-color: #9e9d9d;
}
</style>