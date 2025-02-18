import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import { useAuthStore } from "@/stores/auth";
import LoginPage from '@/views/Auth/LoginPage.vue';
import RegisterPage from '@/views/Auth/RegisterPage.vue';
import AdminHome from '@/views/Admin/AdminHome.vue';
import AdminRegistrationRequest from '@/views/Admin/AdminRegistrationRequest.vue';
import Create from '@/views/Project/Create.vue';
import UnApprovedStudentHome from '@/views/User/UnApprovedStudentHome.vue';
import AddCoordinator from '@/views/Admin/AddCoordinator.vue';
import AddAdvisor from '@/views/Admin/AddAdvisor.vue';
import AdminOngoingProjects from '@/views/Admin/AdminOngoingProjects.vue';
import CoordinatorHome from '@/views/Coordinator/CoordinatorHome.vue';


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'Home',
      component: HomeView,
      meta: { welcome: true },
    },
    {
      path: '/createProject',
      name: 'createProject',
      component: Create,
      meta: { auth: true },


    },
    {
      path: '/login',
      name: 'Login',
      component: LoginPage,
      meta: { guest: true },
    },
    {
      path: '/register',
      name: 'Register',
      component: RegisterPage,
      meta: { guest: true },
    },
    {
      path: '/admin',
      name: 'AdminHome',
      component: AdminHome,
      meta: { admin: true },
    },
    {
      path: '/admin/register-request',
      name: 'AdminRegistrationRequest',
      component: AdminRegistrationRequest,
      meta: { admin: true },
    },
    {
      path: '/admin/register-coordinator',
      name: 'AddCoordinator',
      component: AddCoordinator,
      meta: { admin: true },
    },
    {
      path: '/admin/register-Advisor',
      name: 'AddAdvisor',
      component: AddAdvisor,
      meta: { admin: true },
    },
    {
      path: '/admin/ongoing-projects',
      name: 'AdminOngoingProjects',
      component: AdminOngoingProjects,
      meta: { admin: true },
    },

    {
      path: '/unApprovedStudent',
      name: 'UnApprovedStudent',
      component: UnApprovedStudentHome,
      meta: { UnApprovedStudent: true },
    },
    {
      path: '/coordinator',
      name: 'CoordinatorHome',
      component: CoordinatorHome,
      meta: { coordinator: true },
    },



  ],
})


router.beforeEach(async (to, from) => {
  const authStore = useAuthStore();
  await authStore.getUser();

  if (authStore.user?.role === "admin" && to.meta.guest) {
    return { name: "AdminHome" };
  }
  if (authStore.user?.role === "admin" && to.meta.auth) {
    return { name: "AdminHome" };
  }
  if (authStore.user?.role === "admin" && to.meta.welcome) {
    return { name: "AdminHome" };
  }
  if (authStore.user?.role === "student" && !authStore.user?.approved && to.meta.welcome) {
    return { name: "UnApprovedStudent" };
  }
  if (authStore.user?.role === "student" && !authStore.user?.approved && to.meta.guest) {
    return { name: "UnApprovedStudent" };
  }

  if (authStore.user?.role === "coordinator" && to.meta.guest) {
    return { name: "CoordinatorHome" };
  }
  if (authStore.user?.role === "coordinator" && to.meta.auth) {
    return { name: "CoordinatorHome" };
  }
  if (authStore.user?.role === "coordinator" && to.meta.welcome) {
    return { name: "CoordinatorHome" };
  }
  if (authStore.user?.role === "coordinator" && to.meta.admin) {
    return { name: "CoordinatorHome" };
  }

  if (authStore.user?.role === 'admin' && !to.meta.admin) {
    return next(false);
  }
  if (authStore.user && to.meta.guest) {
    return { name: "Home" };
  }
  if (!authStore.user && to.meta.auth) {
    return { name: "Login" };
  }
});

export default router
