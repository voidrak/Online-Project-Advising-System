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
    }

});
