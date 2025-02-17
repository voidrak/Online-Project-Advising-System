<script setup>
import UserLayout from '@/layout/UserLayout.vue';
import { useAuthStore } from "@/stores/auth";
import { storeToRefs } from "pinia";
import { onMounted, reactive } from "vue";


const authStore = useAuthStore();
const { errors } = storeToRefs(useAuthStore());


const formData = reactive({
  email: "",
  password: "",
});

const submitForm = () => {
  authStore.authenticate("login", formData);
};

onMounted(() => (errors.value = {}));


</script>

<template>

  <UserLayout>
    <div class="relative mx-auto grid h-[calc(100vh-90px)] items-center justify-center px-4 py-6">
      <div
        class="max-w-md rounded-lg border border-gray-300 p-6 shadow-[0_2px_22px_-4px_rgba(93,96,127,0.2)] max-md:mx-auto">
        <form @submit.prevent="submitForm" class="space-y-4">
          <div class="mb-8">
            <h3 class="text-3xl font-extrabold text-gray-800">Sign in</h3>
            <p class="mt-4 text-sm leading-relaxed text-gray-500">
              Sign in to your account and access your Kombolcha City Water Supply Account
            </p>
          </div>

          <div>
            <label for="email" class="mb-2 block text-sm text-gray-800">Email</label>
            <div class="relative flex items-center">
              <input v-model="formData.email" id="email" name="email" type="email" autocomplete="email"
                class="w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-sm text-gray-800 outline-bg-light-green"
                placeholder="Enter email" />
              <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb"
                class="absolute right-4 h-[18px] w-[18px]" viewBox="0 0 24 24">
                <circle cx="10" cy="7" r="6" data-original="#000000"></circle>
                <path
                  d="M14 15H6a5 5 0 0 0-5 5 3 3 0 0 0 3 3h12a3 3 0 0 0 3-3 5 5 0 0 0-5-5zm8-4h-2.59l.3-.29a1 1 0 0 0-1.42-1.42l-2 2a1 1 0 0 0 0 1.42l2 2a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42l-.3-.29H22a1 1 0 0 0 0-2z"
                  data-original="#000000"></path>
              </svg>
            </div>

          </div>
          <div>
            <label for="password" class="mb-2 block text-sm text-gray-800">Password</label>
            <div class="relative flex items-center">
              <input v-model="formData.password" id="password" name="password" type="password"
                autocomplete="new-password"
                class="w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-sm text-gray-800 outline-bg-light-green"
                placeholder="Enter password" />
              <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb"
                class="absolute right-4 h-[18px] w-[18px] cursor-pointer" viewBox="0 0 128 128">
                <path
                  d="M64 104C22.127 104 1.367 67.496.504 65.943a4 4 0 0 1 0-3.887C1.367 60.504 22.127 24 64 24s62.633 36.504 63.496 38.057a4 4 0 0 1 0 3.887C126.633 67.496 105.873 104 64 104zM8.707 63.994C13.465 71.205 32.146 96 64 96c31.955 0 50.553-24.775 55.293-31.994C114.535 56.795 95.854 32 64 32 32.045 32 13.447 56.775 8.707 63.994zM64 88c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm0-40c-8.822 0-16 7.178-16 16s7.178 16 16 16 16-7.178 16-16-7.178-16-16-16z"
                  data-original="#000000"></path>
              </svg>
            </div>
            <p v-if="errors.email" class="text-sm text-red-500">
              Invalid credentials
            </p>
          </div>



          <div class="!mt-8">
            <button type="submit"
              class="w-full rounded-lg bg-green-600 px-4 py-3 text-sm tracking-wide text-white shadow-xl hover:bg-green-700 focus:outline-none">
              Log in
            </button>
          </div>

          <RouterLink :to="{ name: 'Register' }">
            <p class="!mt-8 text-center text-sm text-gray-800">
              Do have an account
              <span class="ml-1 whitespace-nowrap font-semibold text-green-600 hover:underline">Register here
              </span>
            </p>
          </RouterLink>
        </form>
      </div>
    </div>
  </UserLayout>
</template>