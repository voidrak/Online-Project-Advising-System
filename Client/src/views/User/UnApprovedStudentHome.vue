<script setup>

import { useAuthStore } from '@/stores/auth';

const authStore = useAuthStore()
</script>

<template>

  <div class="h-svh flex  flex-col items-center gap-y-8 justify-center">
    <p class="text-xl text-green-500 font-semibold">Your request has been received and is currently under review. Please
      check shortly</p>

    <div @click="authStore.logout"
      class="cursor-pointer px-8 py-3 bg-red-500 font-medium text-white text-md md:text-lg rounded-md hover:bg-red-700 transition ease-in-out duration-300 mr-14 "
      v-if="authStore.user">

      Log Out

    </div>
  </div>
</template>