<template>
    <transition name="fade">
        <div v-if="show" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg relative">
                <!-- Cabeçalho -->
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold">{{ title }}</h3>
                    <button @click="$emit('close')" class="text-gray-500 hover:text-gray-700">✖</button>
                </div>

                <!-- Conteúdo -->
                <div>
                    <slot></slot>
                </div>

                <!-- Rodapé -->
                <div v-if="$slots.footer" class="mt-4 flex justify-end gap-2">
                    <slot name="footer"></slot>
                </div>
            </div>
        </div>
    </transition>
</template>

<script setup>
defineProps({
    show: Boolean,
    title: {
        type: String,
        default: 'Modal'
    }
})

defineEmits(['close'])
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: all 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
    transform: translateY(-20px);
}
</style>
