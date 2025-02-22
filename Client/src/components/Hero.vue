<script setup>
import heroImage from "@/assets/image/home-img.svg";
import { useAuthStore } from "@/stores/auth";

const authStore = useAuthStore();
</script>

<template>
  <section class="flex-col xl:flex-row flex justify-between">
    <div class="mx-auto text-center xl:text-left xl:mx-0 mb-20 xl:mb-0 mt-20">
      <h1
        class="font-bold text-gray-700 text-3xl md:text-6xl leading-tight mb-10"
      >
        Online <br />
        Project Advising <br />
        System!
      </h1>
      <p class="font-normal text-gray-500 text-sm md:text-lg mb-10">
        A digital platform for project advising and management. <br />
        designs.
      </p>

      <div class="flex items-center justify-center lg:justify-start">
        <RouterLink
          :to="{ name: 'createProject' }"
          class="px-8 py-3 bg-green-500 font-medium text-white text-md md:text-lg rounded-md hover:bg-green-700 transition ease-in-out duration-300 mr-14"
        >
          Create Project</RouterLink
        >

        <RouterLink
          :to="{ name: 'studentProjects' }"
          v-if="authStore.user"
          class="px-8 py-3 font-medium text-green-500 text-lg text-center border-2 border-green-500 rounded-md hover:bg-green-500 hover:text-white transition ease-linear duration-300"
          >My Projects</RouterLink
        >

        <RouterLink
          :to="{ name: 'Register' }"
          v-else
          class="px-8 py-3 font-medium text-green-500 text-lg text-center border-2 border-green-500 rounded-md hover:bg-green-500 hover:text-white transition ease-linear duration-300"
          >Register</RouterLink
        >
      </div>
    </div>

    <div class="mx-auto xl:mx-0">
      <img :src="heroImage" alt="Image" />
    </div>
  </section>
</template>
