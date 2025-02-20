<script setup>
import AdminLayout from '@/layout/AdminLayout.vue';
import { useUserStore } from '@/stores/user';
import { storeToRefs } from 'pinia';
import { reactive, ref, onMounted } from 'vue';



const { registerAdvisor } = useUserStore()
const { errors } = storeToRefs(useUserStore());
const formData = reactive({
  name: "",
  email: "",
  password: "",
  department: "",
  department: "",
});


const departments = [
  "Information System",
  "Information Technology",
  "Software Engineering",
  "Computer Science",
];

const submitForm = () => {
  console.log(formData);
  registerAdvisor(formData);
};

onMounted(() => (errors.value = {}));
</script>

<template>

  <AdminLayout>
    <form @submit.prevent="submitForm" class="px-8  ml-10 mt-8 pb-8">
      <div class="space-y-0">
        <div class="border-b border-gray-900/10 pb-12">
          <div class="border-b border-gray-900/10 py-2">
            <h2 class="text-base/7 font-semibold text-green-500">Register New Advisor</h2>
          </div>
          <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 mx-auto  ">
            <div class="max-w-sm">
              <label for="name" class="block text-sm/6 font-medium text-gray-900">Full Name</label>
              <div class="mt-2">
                <input v-model="formData.name" type="text" name="name" id="name" autocomplete="given-name"
                  class="block w-full rounded-md bg-white px-3 py-2 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                <p v-if="errors.name" class="text-sm text-red-500">
                  {{ errors.name[0] }}
                </p>
              </div>
            </div>
            <div class="max-w-sm">
              <label for="email" class="block text-sm/6 font-medium text-gray-900">Email</label>
              <div class="mt-2">
                <input v-model="formData.email" type="email" name="email" id="email" autocomplete="given-name"
                  class="block w-full rounded-md bg-white px-3 py-2 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                <p v-if="errors.email" class="text-sm text-red-500">
                  {{ errors.email[0] }}
                </p>
              </div>
            </div>
            <div class="max-w-sm">
              <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
              <div class="mt-2">
                <input v-model="formData.password" type="password" name="password" id="password"
                  autocomplete="given-name"
                  class="block w-full rounded-md bg-white px-3 py-2 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                <p v-if="errors.password" class="text-sm text-red-500">
                  {{ errors.password[0] }}
                </p>
              </div>
            </div>
            <div class="max-w-sm">
              <label for="password_confirmation" class="block text-sm/6 font-medium text-gray-900">Confirm
                Password</label>
              <div class="mt-2">
                <input v-model="formData.password_confirmation" type="password" name="password_confirmation"
                  id="password_confirmation" autocomplete="given-name"
                  class="block w-full rounded-md bg-white px-3 py-2 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                <p v-if="errors.password_confirmation" class="text-sm text-red-500">
                  {{ errors.password_confirmation[0] }}
                </p>
              </div>
            </div>
            <div class="max-w-sm">
              <label for="department" class="block text-sm/6 font-medium text-gray-900">Department</label>
              <div class="mt-2">
                <select v-model="formData.department" name="department" id="department"
                  class="block w-full rounded-md bg-white px-3 py-3 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                  <option value="" disabled>Select Department</option>
                  <option v-for="department in departments" :key="department" :value="department" class="py-1">
                    {{ department }}
                  </option>
                </select>
                <p v-if="errors.department" class="text-sm text-red-500">
                  {{ errors.department[0] }}
                </p>
              </div>
            </div>




          </div>



        </div>
      </div>

      <div class="mt-6 flex items-center ml-4 gap-x-6">
        <button type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
        <button type="submit"
          class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
      </div>
    </form>
  </AdminLayout>
</template>
