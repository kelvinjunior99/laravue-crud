<script setup>
import { Link } from '@inertiajs/vue3'
import { Head, usePage, router } from '@inertiajs/vue3'
import Header from './Header.vue'

const { dados } = usePage().props;

function editar(id) {
    router.get('/cadastro/'+id+'/editar');
}
</script>
<template>
    <Head title="Lista" />
    <Header />
    <div class="container">
        <table class=" table mt-3">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Numero</th>
                <th scope="col">CP</th>

            </tr>
        </thead>
        <tbody>
            <tr v-for="dado in dados" :key="dado.id">
                <th scope="row">1</th>
                <td>{{ dado.nome }}</td>
                <td>{{ dado.numero }}</td>
                <td>{{ dado.cp }}</td>
                <td>
                    <button type="button" @click.prevent="editar(dado.id)" class="btn btn-success m-2">editar</button>
                    <a href="" class="btn btn-danger">eliminar</a>
                </td>
                <td>
                    
                </td>
            </tr>
        </tbody>
    </table>

    
    </div>
    
    <br>
    <div class="d-grid gap-2 mt-4">
        <Link href="/cadastrar" class="btn btn-secondary">Criar Novo</Link>
    </div>

</template>