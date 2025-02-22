<script setup>
import UserLayout from '@/layout/UserLayout.vue';
import { useProjectStore } from '@/stores/project';
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();
const project = ref(null);
const { getProject } = useProjectStore();

const baseUrl = import.meta.env.VITE_BASE_URL;

onMounted(async () => {
  project.value = await getProject(route.params.id);
  console.log('Project details:', project.value);
});

</script>

<template>
  <UserLayout>
    <RouterLink :to="{ name: 'UserProject' }">
      <svg class="size-10 fill-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
        <path
          d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z" />
      </svg>
    </RouterLink>
    <div v-if="project">
      <h1 class="uppercase border-b border-gray-600 py-8  font-bold text-4xl text-green-700">Project Details</h1>

      <div class="mt-8 space-y-2 text-xl max-w-screen-md">
        <p>Project Title: <span class="font-bold"> {{ project.project_title }}</span></p>
        <p>Project Department: <span class="font-bold"> {{ project.department }}</span></p>
        <p>Project Submitter Student : <span class="font-bold"> {{ project.student?.name }}</span></p>
        <p>Project Advisor : <span class="font-bold"> {{ project.advisor?.name }}</span></p>
        <p>Project Description: <span class="text-base"> {{ project.description }}</span></p>
      </div>
      <div class="flex gap-x-4">
        <p class="mt-8">Download The File:</p>
        <a v-if="project.document" :href="baseUrl + '/storage/' + project.document"
          class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-6">
          Download
        </a>
        <p v-else class="mt-8 text-red-500">No document available</p>
      </div>
    </div>
    <div v-else>
      Loading project details...
    </div>
  </UserLayout>
</template>