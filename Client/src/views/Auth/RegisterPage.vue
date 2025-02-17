<script setup>
import { onMounted, reactive } from "vue";
import UserLayout from '@/layout/UserLayout.vue';
// import Logo from "@/ui/Logo.vue";
import { useAuthStore } from "@/stores/auth";
import { storeToRefs } from "pinia";

const authStore = useAuthStore();
const { errors } = storeToRefs(useAuthStore());

const formData = reactive({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
});

const submitForm = () => {
  authStore.registerRequestForStudent(formData);
};

onMounted(() => (errors.value = {}));

</script>

<template>

  <UserLayout>
    <div class="flex max-h-[calc(100vh-90px)] mt-16 flex-col justify-center py-0 px-4">
      <div class="mx-auto w-full max-w-screen-md rounded-2xl border border-gray-300 p-8">
        <!-- <div class="mb-12 text-center">
          <Logo />
        </div> -->

        <form @submit.prevent="submitForm">
          <div class="space-y-6">
            <div>
              <label for="name" class="mb-2 block text-sm text-gray-800">Full Name</label>
              <input v-model="formData.name" id="name" name="name" type="text" autocomplete="name"
                class="w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-sm text-gray-800 outline-bg-light-green"
                placeholder="Enter name" />
              <p v-if="errors.name" class="text-sm text-red-500">
                {{ errors.name[0] }}
              </p>
            </div>
            <div>
              <label for="email" class="mb-2 block text-sm text-gray-800">Email</label>
              <input v-model="formData.email" id="email" name="email" type="email" autocomplete="email"
                class="w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-sm text-gray-800 outline-bg-light-green"
                placeholder="Enter email" />
              <p v-if="errors.email" class="text-sm text-red-500">
                {{ errors.email[0] }}
              </p>
            </div>
            <div>
              <label for="password" class="mb-2 block text-sm text-gray-800">Password</label>
              <input v-model="formData.password" id="password" name="password" type="password"
                autocomplete="new-password"
                class="w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-sm text-gray-800 outline-bg-light-green"
                placeholder="Enter password" />
              <p v-if="errors.password" class="text-sm text-red-500">
                {{ errors.password[0] }}
              </p>
            </div>
            <div>
              <label for="password_confirmation" class="mb-2 block text-sm text-gray-800">Confirm Password</label>
              <input v-model="formData.password_confirmation" id="password_confirmation" name="password_confirmation"
                type="password" autocomplete="new-password"
                class="w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-sm text-gray-800 outline-bg-light-green"
                placeholder="Confirm password" />

              <p v-if="errors.password_confirmation" class="text-sm text-red-500">
                {{ errors.password_confirmation[0] }}
              </p>
            </div>
          </div>
          <div>

            <div class="mx-auto w-[250px]">
              <button type="submit" class="w-full  rounded-md bg-green-500 p-2 mt-8 text-white">
                Register
              </button>
            </div>

            <RouterLink :to="{ name: 'Login' }">
              <p class="!mt-8 text-center text-sm text-gray-800">
                Do have an account
                <span class="ml-1 whitespace-nowrap font-semibold text-green-600 hover:underline">Login here
                </span>
              </p>
            </RouterLink>
          </div>
        </form>
      </div>
    </div>
  </UserLayout>
</template>