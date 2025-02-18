import { defineStore } from "pinia";
import router from "@/router";

export const useUserStore = defineStore("userStore", {
  state: () => {
    return {
      errors: {},
      user: null,
      advisors: [],
    };
  },
  // getters: {},
  actions: {
    /********************* Delete User  ********************** */
    async deleteUser(userId) {
      const res = await fetch(`/api/admin/users/${userId}`, {
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

    /****************  Approve Student Register  ***************/
    async approveStudentRegistration(userId) {
      const res = await fetch(`/api/admin/approve-register/${userId}`, {
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

    /********************* Get All Register Request  ********************** */
    async getRegisterRequests() {
      const res = await fetch('/api/admin/register-requests', {
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

    /********************* Get All Users  ********************** */
    async getAllUsers() {
      const res = await fetch('/api/admin/users', {
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
    /********************* Get All Register Request  ********************** */

    async registerCoordinator(formData) {
      const res = await fetch(`/api/admin/register-coordinator`, {
        method: "post",
        headers: {
          authorization: `Bearer ${localStorage.getItem("token")}`,
          "Content-Type": "application/json",

        },
        body: JSON.stringify(formData),
      });

      const data = await res.json();
      console.log(data);
      if (data.errors) {
        this.errors = data.errors;
      } else {
        this.errors = {};

        router.push({ name: "Home" });
      }
    },
    async registerAdvisor(formData) {
      const res = await fetch(`/api/admin/register-Advisor`, {
        method: "post",
        headers: {
          authorization: `Bearer ${localStorage.getItem("token")}`,
          "Content-Type": "application/json",

        },
        body: JSON.stringify(formData),
      });

      const data = await res.json();
      console.log(data);
      if (data.errors) {
        this.errors = data.errors;
      } else {
        this.errors = {};

        router.push({ name: "Home" });
      }
    },


    /********************* Get Advisor *****************************/
    async getAdvisors() {
      try {
        const res = await fetch('/api/advisors', {
          method: 'GET',
          headers: {
            authorization: `Bearer ${localStorage.getItem("token")}`,
            "Content-Type": "application/json",
          },
        });
        const data = await res.json();
        console.log(data);
        if (data.errors) {
          this.errors = data.errors;
        } else {
          this.advisors = data.map(advisor => ({
            id: advisor.id,
            name: advisor.name
          }));
          console.log(this.advisors);
        }
      } catch (error) {
        console.error('Error fetching advisors:', error);
        this.errors = { fetch: 'Failed to fetch advisors' };
      }
    },


  },
});
