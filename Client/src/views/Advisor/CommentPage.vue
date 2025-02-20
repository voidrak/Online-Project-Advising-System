<script setup>
import AdminLayout from "@/layout/AdminLayout.vue";
import AdvisorLayout from "@/layout/AdvisorLayout.vue";
import { useProjectStore } from "@/stores/project";
import { useAuthStore } from "@/stores/auth";
import { onMounted, ref } from "vue";
import { useRoute } from "vue-router";

const comments = ref([]);
const newComment = ref("");
const { getCommentsByProject, addComment } = useProjectStore();
const authStore = useAuthStore();
const route = useRoute();
const projectId = ref(route.params.projectId);

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
    <div class="flex flex-col items-center justify-center">
      <h1 class="text-center py-8 font-bold text-4xl text-blue-700 capitalize">
        Discussion Hub
      </h1>
    </div>
    <div class="w-full max-w-4xl mx-auto p-4">
      <div class="bg-white shadow-md rounded-lg p-4">
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
            <p class="text-xs text-gray-500">{{ comment.user.role }}</p>
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
    </div>
  </AdvisorLayout>
</template>
