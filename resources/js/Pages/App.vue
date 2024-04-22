<script setup>
import { Head } from '@inertiajs/vue3'
import Cadastrar from './Components/Cadastrar.vue'
import { Link } from '@inertiajs/vue3'
import Lista from './Components/Lista.vue'

</script>

<template>
    <div class="bg-primary p-2">
        <div class="container">
            <h3>CRUD LARAVUE</h3>
        </div>
    </div>

    <div class="container mt-4">

        <Head title="LaraVue" />

        <div class="alert alert-primary" role="alert">
            <Link href="/lista">Lista</Link>
        </div>

        <div class="alert alert-primary" role="alert">
            <Link href="/cadastrar">Cadastrar</Link>
        </div>
    </div>
</template>
