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

    /************************ Get All Projects   **************** */
    async getAllOngoingProjects() {
      const res = await fetch('/api/admin/ongoing-projects', {
        method: 'GET',
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
        const res = await fetch('/api/projects', {
          method: 'POST',
          headers: {
            authorization: `Bearer ${localStorage.getItem("token")}`,
            "Content-Type": "application/json",
          },
          body: JSON.stringify(projectData),
        });

        const data = await res.json();
        if (data.errors) {
          this.errors = data.errors;
        } else {
          this.project = data;
          router.push('/'); // Redirect to the projects page or any other page
        }
      } catch (error) {
        console.error('Error registering project:', error);
        this.errors = { fetch: 'Failed to register project' };
      }
    },
    /********************* Delete Project  ********************** */
    async deleteProject(projectId) {
      const res = await fetch(`/api/admin/projects/${projectId}`, {
        method: 'DELETE',
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
  }

});
