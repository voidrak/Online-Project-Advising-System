<script setup>
import AdminLayout from "@/layout/AdminLayout.vue";
import AdvisorLayout from "@/layout/AdvisorLayout.vue";
import { useProjectStore } from "@/stores/project";
import { onMounted, ref } from "vue";
import { useAuthStore } from "@/stores/auth";
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogPanel,
  DialogTitle,
} from "@headlessui/vue";

const isOpen = ref(false);

function closeModal() {
  isOpen.value = false;
}
function openModal() {
  isOpen.value = true;
}
const projects = ref([]);
const { getProjectsByAdvisor, updateApprovalStatus, deleteProject } =
  useProjectStore();
const authStore = useAuthStore();
onMounted(async () => {
  await authStore.getUser();
  projects.value = await getProjectsByAdvisor(authStore.user.id);
  console.log(projects.value);
});

const handleDecline = async (id) => {
  closeModal();
  await deleteProject(id);
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
      <h1 class="text-center py-8 font-bold text-4xl text-blue-700 capitalize">
        Project List that are Assigned To you
      </h1>
    </div>
    <table class="min-w-full divide-y divide-gray-200 overflow-x-auto">
      <thead class="bg-gray-50">
        <tr class="">
          <th
            scope="col"
            class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider"
          >
            Project Title
          </th>
          <th
            scope="col"
            class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider"
          >
            Department
          </th>
          <th
            scope="col"
            class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider"
          >
            Description
          </th>
          <th
            scope="col"
            class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider"
          >
            Student
          </th>
          <th
            scope="col"
            class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider"
          >
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
            <button
              @click="openModal"
              class="ml-2 bg-red-500 text-white hover:bg-red-600 w-24 px-2 rounded-md py-[10px]"
            >
              Decline
            </button>
            <TransitionRoot appear :show="isOpen" as="template">
              <Dialog as="div" @close="closeModal" class="relative z-10">
                <TransitionChild
                  as="template"
                  enter="duration-300 ease-out"
                  enter-from="opacity-0"
                  enter-to="opacity-100"
                  leave="duration-200 ease-in"
                  leave-from="opacity-100"
                  leave-to="opacity-0"
                >
                  <div class="fixed inset-0 bg-black/25" />
                </TransitionChild>

                <div class="fixed inset-0 overflow-y-auto">
                  <div
                    class="flex min-h-full items-center justify-center p-4 text-center"
                  >
                    <TransitionChild
                      as="template"
                      enter="duration-300 ease-out"
                      enter-from="opacity-0 scale-95"
                      enter-to="opacity-100 scale-100"
                      leave="duration-200 ease-in"
                      leave-from="opacity-100 scale-100"
                      leave-to="opacity-0 scale-95"
                    >
                      <DialogPanel
                        class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
                      >
                        <DialogTitle
                          as="h3"
                          class="text-lg font-medium leading-6 text-gray-900"
                          @click="openModal"
                        >
                          Decline Project
                        </DialogTitle>
                        <div class="mt-2">
                          <p class="text-sm text-gray-500">
                            If you decline this project, the project will be
                            removed from your list. adn this action cannot be
                            undone!.
                          </p>
                        </div>

                        <div class="mt-4">
                          <button
                            type="button"
                            class="inline-flex justify-center rounded-md border border-transparent bg-red-500 px-4 py-2 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                            @click.prevent="handleDecline(project.id)"
                          >
                            Okay
                          </button>
                          <button
                            type="button"
                            class="inline-flex justify-center rounded-md border border-transparent ml-6 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 border-blue-500"
                            @click="closeModal"
                          >
                            Cancel
                          </button>
                        </div>
                      </DialogPanel>
                    </TransitionChild>
                  </div>
                </div>
              </Dialog>
            </TransitionRoot>
            <button
              @click.prevent="handleApprove(project.id)"
              class="ml-2 bg-green-500 text-white hover:bg-green-600 px-2 rounded-md py-[10px]"
            >
              Approve
            </button>
            <!-- <button class="ml-2 bg-green-500 text-white hover:bg-green-600  px-1 rounded-md py-[5px] ">Update</button> -->
          </td>
        </tr>
      </tbody>
    </table>
  </AdvisorLayout>
</template>
