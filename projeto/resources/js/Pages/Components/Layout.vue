<script setup>
import { Link } from '@inertiajs/vue3'

</script>

<template>
      <div class="container mt-4">

        <div class="alert alert-primary" role="alert">
            <Link href="/lista">Lista</Link>
        </div>

        <div class="alert alert-primary" role="alert">
            <Link href="/cadastrar">Cadastrar</Link>
        </div>
    </div>

</template>

<style scoped>
.menu {
    margin-top: 70px;
}
</style>