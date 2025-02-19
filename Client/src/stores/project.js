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


    /************************ Get All Project    **************** */
    async getProjectAll() {
      const res = await fetch('/api/coordinator/projects', {
        method: 'GET',
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
    /************************ Get Project Request   **************** */
    async getUnassignedProject() {
      const res = await fetch('/api/coordinator/project-requests', {
        method: 'GET',
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

      const res = await fetch("/api/projects", {
        method: "POST",
        headers: {
          authorization: `Bearer ${localStorage.getItem("token")}`,

        },
        body: projectData, // FormData object
      });

      const data = await res.json();
      if (data.errors) {
        this.errors = data.errors;
      } else {
        this.project = data;
        router.push({ name: "Home" });
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


    /****************  Approve Student Register  ***************/
    async assignAdvisor(projectId, formData) {
      const res = await fetch(`/api/assign-advisor/${projectId}`, {
        method: 'PUT',
        headers: {
          authorization: `Bearer ${localStorage.getItem("token")}`,
          "Content-Type": "application/json",
        },
        body: JSON.stringify(formData),

      });

      const data = res.status !== 204 ? await res.json() : {};
      console.log(data);

      if (data.errors) {
        this.errors = data.errors;
      } else {
        return data;
      }
    },

  }

});
