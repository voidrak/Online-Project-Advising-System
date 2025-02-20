<script setup>
import { ref, onMounted } from "vue";
import UserLayout from "@/layout/UserLayout.vue";
import { useUserStore } from "@/stores/user";
import { useAuthStore } from "@/stores/auth";
import { useProjectStore } from "@/stores/project";

const formData = ref(new FormData());
const errors = ref({});

const userStore = useUserStore();
const authStore = useAuthStore();
const projectStore = useProjectStore();

const submitForm = () => {
  projectStore.registerProject(formData.value);
};

onMounted(async () => {
  errors.value = {};
  await userStore.getAdvisors();
  await authStore.getUser();
  if (authStore.user) {
    formData.value.set("department", authStore.user.department);
    formData.value.set("student_id", authStore.user.student_id);
  }
});

const handleInputChange = (field, value) => {
  formData.value.set(field, value);
};

const handleFileChange = (event) => {
  formData.value.set("document", event.target.files[0]);
};
</script>

<template>
  <UserLayout>
    <div class="flex mt-16 flex-col justify-center py-0 px-4">
      <div
        class="mx-auto w-full max-w-screen-md rounded-2xl border border-gray-300 p-8"
      >
        <form @submit.prevent="submitForm">
          <div class="space-y-6">
            <div>
              <label
                for="project_title"
                class="mb-2 block text-sm text-gray-800"
                >Project Title</label
              >
              <input
                @input="handleInputChange('project_title', $event.target.value)"
                id="project_title"
                name="project_title"
                type="text"
                autocomplete="project_title"
                class="w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-sm text-gray-800 outline-bg-light-green"
                placeholder="Enter project title"
              />
            </div>
            <div>
              <label for="description" class="mb-2 block text-sm text-gray-800"
                >Description</label
              >
              <textarea
                @input="handleInputChange('description', $event.target.value)"
                id="description"
                name="description"
                autocomplete="description"
                class="w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-sm text-gray-800 outline-bg-light-green"
                placeholder="Enter project description"
              ></textarea>
            </div>
            <div>
              <label for="student_id" class="mb-2 block text-sm text-gray-800"
                >Student ID</label
              >
              <input
                :value="authStore.user.student_id"
                id="student_id"
                name="student_id"
                type="text"
                autocomplete="student_id"
                class="w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-sm text-gray-800 outline-bg-light-green"
                placeholder="Enter student ID"
                readonly
              />
            </div>
            <div>
              <label for="department" class="mb-2 block text-sm text-gray-800"
                >Department</label
              >
              <input
                :value="authStore.user.department"
                id="department"
                name="department"
                type="text"
                autocomplete="department"
                class="w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-sm text-gray-800 outline-bg-light-green"
                placeholder="Enter department"
                readonly
              />
            </div>
            <div>
              <label for="document" class="mb-2 block text-sm text-gray-800"
                >Document</label
              >
              <input
                @change="handleFileChange"
                id="document"
                name="document"
                type="file"
                accept=".pdf,.doc,.docx,.jpeg,.png"
                class="w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-sm text-gray-800 outline-bg-light-green"
              />
            </div>
            <div>
              <button
                type="submit"
                class="w-full rounded-md bg-green-500 px-4 py-3 text-sm text-white hover:bg-green-700 transition ease-in-out duration-300"
              >
                Register Project
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </UserLayout>
</template>
