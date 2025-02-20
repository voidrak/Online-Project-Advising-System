import { defineStore } from "pinia";
import router from "@/router";
export const useProjectStore = defineStore("projectStore", {
  state: () => {
    return {
      errors: {},
      project: null,
    };
  },
  actions: {
    /************************ Get Project Request   **************** */
    async getProjectRequests() {
      const res = await fetch("/api/coordinator/project-requests", {
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
    /************************ Get All Ongoing Projects   **************** */

    async getAllOngoingProjects() {
      const res = await fetch("/api/admin/ongoing-projects", {
        method: "GET",
        headers: {
          authorization: `Bearer ${localStorage.getItem("token")}`,
          "Content-Type": "application/json",
        },
      });

      const data = res.status !== 204 ? await res.json() : {};
      // console.log(data);

      if (data.errors) {
        this.errors = data.errors;
      } else {
        return data;
      }
    },

    /********************* Register Project***********/

    async registerProject(projectData) {
      try {
        const res = await fetch("/api/projects", {
          method: "POST",
          headers: {
            authorization: `Bearer ${localStorage.getItem("token")}`,
            // Do not set Content-Type header, let the browser set it automatically
          },
          body: projectData, // FormData object
        });

        const data = await res.json();
        if (data.errors) {
          this.errors = data.errors;
        } else {
          this.project = data;
          router.push("/"); // Redirect to the projects page or any other page
        }
      } catch (error) {
        console.error("Error registering project:", error);
        this.errors = { fetch: "Failed to register project" };
      }
    },
    /********************* Delete Project  ********************** */
    async deleteProject(projectId) {
      const res = await fetch(`/api/admin/projects/${projectId}`, {
        method: "DELETE",
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

    /****************  Approve Project Register  ***************/
    async updateApprovalStatus(projectId, approved) {
      const res = await fetch(`/api/projects/${projectId}/approval-status`, {
        method: "PUT",
        headers: {
          authorization: `Bearer ${localStorage.getItem("token")}`,
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ approved }),
      });

      const data = res.status !== 204 ? await res.json() : {};
      console.log(data);

      if (data.errors) {
        this.errors = data.errors;
      } else {
        return data;
      }
    },

    async approveProject(projectId) {
      return this.updateApprovalStatus(projectId, true);
    },

    async declineProject(projectId) {
      return this.updateApprovalStatus(projectId, false);
    },

    /************************ Get Projects by Advisor   **************** */
    async getProjectsByAdvisor(advisorId) {
      const res = await fetch(`/api/projects/advisor/${advisorId}`, {
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

    /**************** Get Approved projects by Advisor********** */
    async getApprovedProjectsByAdvisor(advisorId) {
      const res = await fetch(`/api/projects/advisor/${advisorId}/approved`, {
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
