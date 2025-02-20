<script setup>
import AdminLayout from "@/layout/AdminLayout.vue";
import AdvisorLayout from "@/layout/AdvisorLayout.vue";
import { useCommentStore } from "@/stores/comment";
import { useAuthStore } from "@/stores/auth";
import { onMounted, ref } from "vue";
import { useRoute } from "vue-router";

const comments = ref([]);
const newComment = ref("");
const { getCommentsByProject, addComment } = useCommentStore();
const authStore = useAuthStore();
const route = useRoute();
const projectId = ref(route.params.projectId);

const formatDate = (dateString) => {
  const options = {
    month: "long",
    day: "numeric",
    hour: "2-digit",
    minute: "2-digit",
  };
  return new Date(dateString).toLocaleDateString(undefined, options);
};

onMounted(async () => {
  await authStore.getUser();
  comments.value = await getCommentsByProject(projectId.value);
});

const handleAddComment = async () => {
  if (newComment.value.trim() !== "") {
    await addComment(projectId.value, newComment.value, authStore.user.id);
    comments.value = await getCommentsByProject(projectId.value);
    newComment.value = "";
  }
};
</script>

<template>
  <AdvisorLayout>
    <RouterLink :to="{ name: 'ApprovedProjects' }">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6" viewBox="0 0 448 512">
        <path
          d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"
        />
      </svg>
    </RouterLink>
    <div class="flex flex-col items-center justify-center">
      <h1 class="text-center py-8 font-bold text-4xl text-green-700 capitalize">
        Discussion Hub
      </h1>
    </div>
    <div class="w-full max-w-4xl mx-auto p-4">
      <div class="bg-white shadow-md rounded-lg p-4">
        <div class="flex flex-col space-y-4">
          <div v-for="comment in comments" :key="comment.id" :class="{
            'self-end bg-blue-100': comment.user_id === authStore.user.id,
            'self-start bg-gray-100': comment.user_id !== authStore.user.id,
          }" class="p-2 rounded-lg max-w-xs">
            <p class="text-sm">{{ comment.content }}</p>
            <p class="text-xs text-gray-500">
              {{ comment.user.role }} - {{ formatDate(comment.created_at) }}
            </p>
          </div>
        </div>
        <div class="mt-4 flex">
          <input v-model="newComment" type="text" placeholder="Type your comment..."
            class="flex-1 p-2 border rounded-l-lg" />
          <button @click="handleAddComment" class="bg-blue-500 text-white p-2 rounded-r-lg">
            Send
          </button>
        </div>
      </div>
    </div>
  </AdvisorLayout>
</template>
