<script setup>
import logo from "../assets/image/navbar-logo.svg";
import { useAuthStore } from '@/stores/auth';

const authStore = useAuthStore()
</script>

<template>

  <nav class="flex-wrap lg:flex items-center justify-between mb-5 lg:mb-10" x-data="{navbarOpen:false}">
    <div class="flex items-center justify-between mb-10 lg:mb-0">
      <img :src="logo" alt="Logo" />
    </div>
    <ul class="hidden lg:flex flex-col lg:flex-row lg:items-center lg:space-x-20">
      <RouterLink :to="{ name: 'Home' }"
        class="font-medium text-green-500 text-lg hover:text-green-300 transition ease-in-out duration-300 mb-5 lg:mb-0">
        Home
      </RouterLink>
      <li
        class="font-medium text-green-500 text-lg hover:text-green-300 transition ease-in-out duration-300 mb-5 lg:mb-0">
        <a href="#">Services</a>
      </li>
      <li
        class="font-medium text-green-500 text-lg hover:text-green-300 transition ease-in-out duration-300 mb-5 lg:mb-0">
        <a href="#">Works</a>
      </li>
      <li
        class="font-medium text-green-500 text-lg hover:text-green-300 transition ease-in-out duration-300 mb-5 lg:mb-0">
        <a href="#">Blog</a>
      </li>
      <div @click="authStore.logout" class="cursor-pointer " v-if="authStore.user">
        <li
          class="px-8 py-3 bg-red-500 font-medium text-white text-md md:text-lg rounded-md hover:bg-red-700 transition ease-in-out duration-300 mr-14">
          Log Out
        </li>
      </div>
      <div v-else class="flex gap-x-4">
        <RouterLink :to="{ name: 'Login' }">
          <li
            class="px-8 py-3 font-medium text-green-500 text-lg text-center border-2 border-green-500 rounded-md hover:bg-green-500 hover:text-white transition ease-linear duration-300">
            Login
          </li>
        </RouterLink>
        <RouterLink :to="{ name: 'Register' }">
          <li
            class="px-8 py-3 bg-green-500 font-medium text-white text-md md:text-lg rounded-md hover:bg-green-700 transition ease-in-out duration-300 mr-14">
            Register
          </li>
        </RouterLink>
      </div>
    </ul>
  </nav>


</template>
