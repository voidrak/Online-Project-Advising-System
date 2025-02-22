<script setup>
import AdminLayout from "@/layout/AdminLayout.vue";
import AdvisorLayout from "@/layout/AdvisorLayout.vue";
import { useCommentStore } from "@/stores/comment";
import { useAuthStore } from "@/stores/auth";
import { onMounted, ref } from "vue";
import { useRoute } from "vue-router";
import UserLayout from "@/layout/UserLayout.vue";
import { useProjectStore } from "@/stores/project";

const comments = ref([]);
const newComment = ref("");
const { getCommentsByProject, addComment } = useCommentStore();
const authStore = useAuthStore();
const route = useRoute();
const projectId = ref(route.params.projectId);
const projectName = ref("");
const projectDescription = ref("");
const { getProjectById, updateProjectDocument } = useProjectStore(); // Assuming you have a project store
const currentFile = ref(null);
const currentFileUrl = ref(null);
const selectedFile = ref(null); // Add this line
const baseUrl = import.meta.env.VITE_BASE_URL;
const formatDate = (dateString) => {
  const options = {
    month: "long",
    day: "numeric",
    hour: "2-digit",
    minute: "2-digit",
  };
  return new Date(dateString).toLocaleDateString(undefined, options);
};
const formData = ref(new FormData());

onMounted(async () => {
  await authStore.getUser();
  comments.value = await getCommentsByProject(projectId.value);
  const project = await getProjectById(projectId.value);
  console.log(project.id);
  projectName.value = project.project_title;
  projectDescription.value = project.description;
  currentFile.value = project.document; // Assuming the document field contains the file path
  currentFileUrl.value = `${baseUrl}/storage/${project.document}`; // Assuming the file is stored in the public storage
  console.log(projectName.value);

  // formData.value.set("project_id", projectId.value);
  formData.value.set("user_id", authStore.user.id);
  formData.value.set("document", null);
});

const handleAddComment = async () => {
  if (newComment.value.trim() !== "") {
    await addComment(projectId.value, newComment.value, authStore.user.id);
    comments.value = await getCommentsByProject(projectId.value);
    newComment.value = "";
  }
};

const handleFileChange = (event) => {
  selectedFile.value = event.target.files[0];
  formData.value.set("document", event.target.files[0]);
};

const handleFileUpload = async () => {
  if (selectedFile.value) {
    console.log(selectedFile.value);
    await updateProjectDocument(projectId.value, formData.value);
    currentFile.value = selectedFile.value.name; // Update the current file display
    currentFileUrl.value = URL.createObjectURL(selectedFile.value); // Update the current file URL
    selectedFile.value = null;
    console.log("File uploaded successfully");
  }
};
</script>

<template>
  <UserLayout>
    <RouterLink :to="{ name: 'studentProjects' }">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6" viewBox="0 0 448 512">
        <path
          d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"
        />
      </svg>
    </RouterLink>
    <div class="">
      <h1 class="text-center py-8 font-bold text-4xl text-blue-700 capitalize">
        Discussion Hub - {{ projectName }}
      </h1>
      <p class="text-left">Description: {{ projectDescription }}</p>
    </div>

    <div class="w-full mx-auto p-4 flex">
      <div class="bg-white shadow-md rounded-lg p-4 w-3/4">
        <div class="flex flex-col space-y-4">
          <div
            v-for="comment in comments"
            :key="comment.id"
            :class="{
              'self-end bg-blue-100': comment.user_id === authStore.user.id,
              'self-start bg-gray-100': comment.user_id !== authStore.user.id,
            }"
            class="p-2 rounded-lg max-w-xs"
          >
            <p class="text-sm">{{ comment.content }}</p>
            <p class="text-xs text-gray-500">
              {{ comment.user.role }} - {{ formatDate(comment.created_at) }}
            </p>
          </div>
        </div>
        <div class="mt-4 flex">
          <input
            v-model="newComment"
            type="text"
            placeholder="Type your comment..."
            class="flex-1 p-2 border rounded-l-lg"
          />
          <button
            @click="handleAddComment"
            class="bg-blue-500 text-white p-2 rounded-r-lg"
          >
            Send
          </button>
        </div>
      </div>
      <div class="w-1/4 p-4">
        <div class="overflow-x-hidden">
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
          <button
            @click="handleFileUpload"
            class="bg-blue-500 text-white p-2 mt-2 w-full rounded-lg"
          >
            Upload
          </button>
          <div
            v-if="currentFile"
            class="mt-4 bg-green-500 text-white p-2 w-full rounded-lg text-center flex items-center justify-center"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="w-6 h-6 mr-2"
              viewBox="0 0 384 512"
            >
              <path
                fill="#fff"
                d="M320 464c8.8 0 16-7.2 16-16l0-288-80 0c-17.7 0-32-14.3-32-32l0-80L64 48c-8.8 0-16 7.2-16 16l0 384c0 8.8 7.2 16 16 16l256 0zM0 64C0 28.7 28.7 0 64 0L229.5 0c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3L384 448c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64L0 64z"
              />
            </svg>
            <a :href="currentFileUrl" download target="_blank" class="">
              Download
            </a>
          </div>
        </div>
      </div>
    </div>
  </UserLayout>
</template>
