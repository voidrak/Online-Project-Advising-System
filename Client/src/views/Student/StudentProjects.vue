<script setup>
import { onMounted, ref } from "vue";
import { useProjectStore } from "@/stores/project";
import { useAuthStore } from "@/stores/auth";
import UserLayout from "@/layout/UserLayout.vue";

const projectStore = useProjectStore();
const authStore = useAuthStore();
const projects = ref([]);

const getStatus = (project) => {
  if (!project.approved && !project.advisor_id) {
    return "Waiting Advisor Assignment";
  } else if (project.advisor_id && !project.approved) {
    return "Waiting Approval";
  } else if (project.approved && !project.completed) {
    return "Ongoing";
  } else if (project.completed) {
    return "Completed";
  }
  return "Unknown"; // Add a default case
};

onMounted(async () => {
  await authStore.getUser();
  projects.value = await projectStore.getApprovedProjectsByStudent(
    authStore.user.id
  );
});
</script>

<template>
  <UserLayout>
    <div class="flex flex-col items-center justify-center">
      <h1 class="text-center py-8 font-bold text-4xl text-blue-700 capitalize">
        Manage your Projects
      </h1>
    </div>
    <table class="min-w-full divide-y divide-gray-200 overflow-x-auto">
      <thead class="bg-gray-50">
        <tr class="">
          <th scope="col" class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">
            Project Title
          </th>

          <th scope="col" class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">
            Description
          </th>

          <th scope="col" class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">
            Status
          </th>

          <th scope="col" class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">
            Details
          </th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <tr v-for="(project, index) in projects" :key="index">
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
              <div class="ml-4">
                <div class="text-sm font-medium text-gray-900">
                  {{ project.project_title }}
                </div>
              </div>
            </div>
          </td>

          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">{{ project.description }}</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">{{ getStatus(project) }}</div>
          </td>

          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex">
            <RouterLink :to="{
              name: 'CommentPageStudent',
              params: { projectId: project.id },
            }" class="ml-2 text-white p-2 transition ease-in-out duration-150 rounded-md py-[10px]">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-6" viewBox="0 0 512 512">
                <path
                  d="M352 96l64 0c17.7 0 32 14.3 32 32l0 256c0 17.7-14.3 32-32 32l-64 0c-17.7 0-32 14.3-32 32s14.3 32 32 32l64 0c53 0 96-43 96-96l0-256c0-53-43-96-96-96l-64 0c-17.7 0-32 14.3-32 32s14.3 32 32 32zm-9.4 182.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L242.7 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128z" />
              </svg>
            </RouterLink>
          </td>
        </tr>
      </tbody>
    </table>
  </UserLayout>
</template>
