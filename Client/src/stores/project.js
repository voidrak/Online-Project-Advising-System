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
 

    /****************  Approve Student Register  ***************/
    async approveProject(projectId) {
      const res = await fetch(`/api/approve-project/${projectId}`, {
        method: 'PUT',
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

 
  },
 
});
