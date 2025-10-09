<template>
    <Dashboard />

    <Head title="Meu Perfil" />

    <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Cabeçalho -->
            <div class="mb-8">
                <!---<h1 class="text-3xl font-bold text-gray-900">Meu Perfil</h1>--->
                <p class="text-gray-600 mt-2">Gerencie suas informações pessoais</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Coluna Lateral - Informações do Usuário -->
                <div class="lg:col-span-1">
                    <!-- Card de Perfil -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                        <div class="text-center">
                            <!-- Avatar -->
                            <div class="relative inline-block mb-4">
                                <div
                                    class="w-24 h-24 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white text-2xl font-bold">
                                    {{ user.initials }}
                                </div>
                                <div
                                    class="absolute bottom-2 right-2 w-6 h-6 bg-green-500 rounded-full border-2 border-white flex items-center justify-center">
                                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>

                            <!-- Informações Básicas -->
                            <h2 class="text-xl font-bold text-gray-900">{{ user.name }}</h2>
                            <p class="text-gray-600 mt-1">{{ user.email }}</p>
                            <p class="text-sm text-gray-500 mt-2">Membro desde
                                {{ new Date(user.created_at).toLocaleDateString('pt-BR', {
                                    day: '2-digit', month:
                                        'long', year: 'numeric'
                                }) }}
                            </p>

                            <!-- Badge de Status -->
                            <div
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 mt-3">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Conta Verificada
                            </div>
                        </div>
                    </div>

                    <!-- Estatísticas Rápidas -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Minhas Estatísticas</h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Livros Cadastrados</span>
                                <span class="font-medium text-gray-900">{{ totalLivros || 'nenhum' }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Último Acesso</span>
                                <span class="text-sm text-gray-500">{{ user.last_login_at ? new
                                    Date(user.last_login_at).toLocaleString("pt-BR") : 'Nunca acessou' }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Atividade</span>
                                <span
                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    ---
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Coluna Principal - Detalhes do Perfil -->
                <div class="lg:col-span-2">
                    <!-- Informações Pessoais -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-semibold text-gray-900">Informações Pessoais</h3>
                            
                            <!---<button @click="editarPerfil"
                                class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                                Editar
                            </button>----->

                            <button @click="abrirModal"
                                class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Editar
                            </button>

                          
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nome Completo</label>
                                <p class="text-gray-900">{{ user.name }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <p class="text-gray-900">{{ user.email }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Telefone</label>
                                <p class="text-gray-900">{{ user.phone || 'Não informado' }}</p>
                            </div>

                        </div>
                    </div>

                    <!-- Atividade Recente -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-6">Atividade Recente</h3>

                        <div class="space-y-4">
                            <div v-for="actividade in actividades" :key="actividade.id" class="flex items-start">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center"
                                        :class="getActivityColor(actividade.tipo)">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path :d="getActivityIcon(actividade.tipo)"></path>
                                        </svg>
                                    </div>

                                </div>

                                <div class="ml-4 flex-1">
                                    <p class="text-sm text-gray-900">
                                        {{ actividade.action }}

                                        <span class="font-medium text-indigo-600 m-1">
                                            {{ actividade.subject ? actividade.subject.titulo : 'Indisponível' }}
                                        </span>

                                    </p>
                                    <p class="text-xs text-gray-500 mt-1">({{ new
                                        Date(actividade.created_at).toLocaleString() }})</p>
                                </div>
                            </div>

                            <div v-if="actividades.length === 0" class="text-center py-4">
                                <p class="text-gray-500">Nenhuma atividade recente</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>


    </div>
</template>

<script setup>
import Dashboard from '../Dashboard.vue'
import { ref, reactive, computed } from 'vue'
import { Head } from '@inertiajs/vue3';

defineProps({
    user: Object,
    totalLivros: Number,
    actividades: Array
})



// Funções utilitárias
const getActivityColor = (tipo) => {
    const colors = {
        cadastrou_livro: 'bg-blue-500',
        perfil: 'bg-green-500',
        sistema: 'bg-purple-500'
    }
    return colors[tipo] || 'bg-gray-500'
}

const getActivityIcon = (tipo) => {
    const icons = {
        cadastrou_livro: 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
        perfil: 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
        sistema: 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z'
    }
    return icons[tipo] || 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'
}


</script>

<style scoped>
/* Estilos específicos do componente */
.bg-white {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.bg-white:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}
</style>