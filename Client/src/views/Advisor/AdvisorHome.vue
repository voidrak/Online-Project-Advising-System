<script setup>
import AdminLayout from "@/layout/AdminLayout.vue";
import AdvisorLayout from "@/layout/AdvisorLayout.vue";
import { useProjectStore } from "@/stores/project";
import { onMounted, ref } from "vue";
import { useAuthStore } from "@/stores/auth";

const projects = ref([]);
const { getProjectsByAdvisor, updateApprovalStatus } = useProjectStore();
const authStore = useAuthStore();
onMounted(async () => {
  await authStore.getUser();
  projects.value = await getProjectsByAdvisor(authStore.user.id);
  console.log(projects.value);
});

const handleDecline = async (id) => {
  await updateApprovalStatus(id, false);
  projects.value = await getProjectsByAdvisor(authStore.user.id);
};

const handleApprove = async (id) => {
  await updateApprovalStatus(id, true);
  projects.value = await getProjectsByAdvisor(authStore.user.id);
};
</script>

<template>
  <AdvisorLayout>
    <div class="flex flex-col items-center justify-center">
      <h1 class="text-center py-8 font-bold text-4xl text-green-700 capitalize">
        Project List that are Assigned To you
      </h1>
    </div>
    <table class="min-w-full divide-y divide-gray-200 overflow-x-auto">
      <thead class="bg-gray-50">
        <tr class="">
          <th scope="col" class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">
            Project Title
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">
            Department
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">
            Description
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">
            Student
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">
            Actions
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
            <div class="text-sm text-gray-900">{{ project.department }}</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">{{ project.description }}</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">{{ project.student?.name }}</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex">
            <button @click.prevent="handleDecline(project.id)"
              class="ml-2 bg-red-500 text-white hover:bg-red-600 w-24 px-2 rounded-md py-[10px]">
              Decline
            </button>
            <button @click.prevent="handleApprove(project.id)"
              class="ml-2 bg-green-500 text-white hover:bg-green-600 px-2 rounded-md py-[10px]">
              Approve
            </button>
            <!-- <button class="ml-2 bg-green-500 text-white hover:bg-green-600  px-1 rounded-md py-[5px] ">Update</button> -->
          </td>
        </tr>
      </tbody>
    </table>
  </AdvisorLayout>
</template>
