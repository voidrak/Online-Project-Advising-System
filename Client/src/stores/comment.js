import { defineStore } from "pinia";
import router from "@/router";
export const useCommentStore = defineStore("commentStore", {
  state: () => {
    return {
      errors: {},
    };
  },
  actions: {
    /**************** Get Comments by Project ********** */
    async getCommentsByProject(projectId) {
      const res = await fetch(`/api/projects/${projectId}/comments`, {
        method: "GET",
        headers: {
          authorization: `Bearer ${localStorage.getItem("token")}`,
          "Content-Type": "application/json",
        },
      });

      const data = res.status !== 204 ? await res.json() : {};
      console.log(data);

      if (data.errors) {
        this.errors = data.errors;
      } else {
        return data;
      }
    },

    /**************** Add Comment to Project ********** */
    async addComment(projectId, content, userId) {
      const res = await fetch(`/api/projects/${projectId}/comments`, {
        method: "POST",
        headers: {
          authorization: `Bearer ${localStorage.getItem("token")}`,
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ content, user_id: userId }),
      });

      const data = res.status !== 204 ? await res.json() : {};
      console.log(data);

      if (data.errors) {
        this.errors = data.errors;
      } else {
        return data;
      }
    },
  },
});
