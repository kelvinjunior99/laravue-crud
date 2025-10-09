<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3'

// Estado reativo
const isMobileMenuOpen = ref(false);
const isMobileDropdownOpen = ref(false);
const showLoginModal = ref(false);
const isLoggedIn = ref(false);


// Estados para a pesquisa
const searchTerm = ref('')
const showMobileSearch = ref(false)

// Funções de pesquisa
const performSearch = () => {
  if (searchTerm.value.trim()) {
    router.get(route('livros.index', { search: searchTerm.value.trim() }))
  }
}

const clearSearch = () => {
  searchTerm.value = ''
  // Opcional: limpar a pesquisa atual
  router.get(route('livros.index'))
}

const toggleMobileSearch = () => {
  showMobileSearch.value = !showMobileSearch.value
  if (showMobileSearch.value) {
    isMobileMenuOpen.value = false
  }
}


// Dados do menu
const siteName = 'Laravue-Crud';
const menuItems = [
  { title: 'Início', path: '/livraria' },
  { title: 'Cadastrar', path: '/livro/create' },
  { title: 'Lista', path: '/livros' },
  { title: 'Perfil', path: '/livro/user/profile' },
];

const services = [
  { title: 'Web Design', path: '/servicos/web-design' },
  { title: 'Desenvolvimento', path: '/servicos/desenvolvimento' },
  { title: 'Marketing Digital', path: '/servicos/marketing' }
];

// Métodos
const toggleMobileMenu = () => {
  isMobileMenuOpen.value = !isMobileMenuOpen.value;
  if (isMobileMenuOpen.value) {
    isMobileDropdownOpen.value = false;
  }
};

const closeMobileMenu = () => {
  isMobileMenuOpen.value = false;
};

const toggleMobileDropdown = () => {
  isMobileDropdownOpen.value = !isMobileDropdownOpen.value;
};

const toggleLoginModal = () => {
  showLoginModal.value = !showLoginModal.value;
  if (showLoginModal.value) {
    isMobileMenuOpen.value = false;
  }
};

const handleLogin = (credentials) => {
  // Lógica de login aqui
  console.log('Login attempt with:', credentials);
  isLoggedIn.value = true;
  showLoginModal.value = false;
};
</script>

<template>
  <nav class="bg-white shadow-lg">
    <div class="max-w-6xl mx-auto px-4">
      <div class="flex justify-between">
        <!-- Logo -->
        <div class="flex items-center py-4">
          <Link href="/" class="flex items-center">
          <svg class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
          </svg>
          <span class="ml-2 text-xl font-semibold text-gray-800">{{ siteName }}</span>
          </Link>
        </div>

        <!-- Menu Desktop -->
        <div class="hidden lg:flex md:flex items-center space-x-1">
          <Link v-for="item in menuItems" :key="item.path" :href="item.path"
            class="py-4 px-3 text-gray-800 hover:text-blue-500 font-medium" active-class="text-blue-500">
          {{ item.title }}
          </Link>

          <!-- Dropdown -->
          <div class="relative group">
            <button class="py-4 px-3 text-gray-800 hover:text-blue-500 font-medium flex items-center">
              <span>Serviços</span>
              <svg class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </button>
            <div class="absolute hidden group-hover:block bg-white shadow-lg rounded-md mt-0 w-48 z-10">
              <router-link v-for="service in services" :key="service.path" :to="service.path"
                class="block px-4 py-2 text-gray-800 hover:bg-blue-500 hover:text-white">
                {{ service.title }}
              </router-link>
            </div>
          </div>

          <Link href="/logout" method="post"
            class="m-2 py-2 px-3 bg-red-400 text-white rounded-md hover:bg-red-600 font-medium transition duration-300 cursor-pointer">
          Sair
          </Link>
        </div>

        <!-- Botão Mobile -->
        <div class="md:hidden flex items-center space-x-2">

          <button @click="toggleMobileSearch" class="p-2 text-gray-800 hover:text-blue-500" aria-label="Abrir pesquisa">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
          </button>

          <button @click="toggleMobileMenu" class="outline-none mobile-menu-button p-2" aria-label="Toggle menu">
            <svg class="w-6 h-6 text-gray-800" fill="none" stroke-linecap="round" stroke-linejoin="round"
              stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
              <path d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Input de Pesquisa Mobile -->
    <div v-show="showMobileSearch" class="md:hidden border-t border-gray-200">
      <div class="px-4 py-3">
        <div class="relative">
          <input v-model="searchTerm" @keyup.enter="performSearch" type="text" placeholder="Pesquisar livros..."
            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
          </div>
          <button v-if="searchTerm" @click="clearSearch" class="absolute inset-y-0 right-0 pr-3 flex items-center">
            <svg class="h-4 w-4 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Menu Mobile -->
    <div v-show="isMobileMenuOpen" class="md:hidden mobile-menu">
      <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
        <router-link v-for="item in menuItems" :key="item.path" :to="item.path"
          class="block px-3 py-2 text-gray-800 hover:text-blue-500 font-medium" active-class="text-blue-500"
          @click="closeMobileMenu">
          {{ item.title }}
        </router-link>

        <!-- Dropdown Mobile -->
        <div class="relative">
          <button @click="toggleMobileDropdown"
            class="mobile-dropdown-btn flex items-center w-full px-3 py-2 text-gray-800 hover:text-blue-500 font-medium">
            <span>Serviços</span>
            <svg class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div v-show="isMobileDropdownOpen" class="mobile-dropdown-content pl-4">
            <router-link v-for="service in services" :key="service.path" :to="service.path"
              class="block px-3 py-2 text-gray-800 hover:text-blue-500 text-sm" @click="closeMobileMenu">
              {{ service.title }}
            </router-link>
          </div>
        </div>

        <button @click="toggleLoginModal" class="block w-full text-left px-3 py-2 text-blue-500 font-medium">
          {{ isLoggedIn ? 'Minha Conta' : 'Login' }}
        </button>
      </div>
    </div>
  </nav>  

</template>



<style scoped>
/* Transições suaves para o menu mobile */
.mobile-menu {
  transition: all 0.3s ease;
}

.mobile-dropdown-content {
  transition: all 0.3s ease;
}

/* Estilos para o input de pesquisa */
input::placeholder {
  color: #9CA3AF;
  font-size: 0.875rem;
}
</style>