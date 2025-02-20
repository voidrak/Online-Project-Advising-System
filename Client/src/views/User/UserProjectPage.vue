<script setup>
import UserLayout from '@/layout/UserLayout.vue';
import { useProjectStore } from '@/stores/project';
import { computed, onMounted, ref } from 'vue';

const { getProjectCompleted } = useProjectStore()

const projects = ref([]);
const searchQuery = ref("")

onMounted(async () => {
  projects.value = await getProjectCompleted();
  console.log(projects.value);
})

const filteredProject = computed(() => {
  if (!searchQuery.value) {
    return projects.value;
  }
  const searchTerm = searchQuery.value.toLowerCase();
  return projects.value.filter(project =>
    project.project_title.toLowerCase().includes(searchTerm) ||
    project.student.name.toLowerCase().includes(searchTerm) ||
    project.department.toLowerCase().includes(searchTerm) ||
    project.advisor.name.toLowerCase().includes(searchTerm)
  );
});

const getYear = (dateString) => {
  const date = new Date(dateString);
  return date.getFullYear();
};

</script>

<template>
  <UserLayout>

    <div v-if="projects" class="">
      <h1 class="uppercase ml-8 py-8  font-bold text-4xl text-blue-700">Projects
      </h1>

      <div class="pt-2 relative pl-6 py-4 max-w-screen-md  text-gray-600">
        <input v-model="searchQuery"
          class="border-2 w-full border-gray-300 bg-white h-10 py-2 px-5 pr-16 rounded-lg text-sm focus:outline-none"
          type="search" name="search" placeholder="Search">
        <button type="submit" class="absolute right-0 top-0 mt-5 mr-4">
          <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
            viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
            width="512px" height="512px">
            <path
              d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
          </svg>


        </button>
      </div>

      <table class="min-w-full divide-y divide-gray-200 overflow-x-auto">
        <thead class="bg-gray-50">
          <tr class="">
            <th scope="col" class="px-6 py-3 text-left text-xs font-bold  uppercase tracking-wider">
              #
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-bold  uppercase tracking-wider">
              Project Title
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-bold  uppercase tracking-wider">
              Student
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-bold  uppercase tracking-wider">
              Department
            </th>


            <th scope="col" class="px-6 py-3 text-left text-xs font-bold  uppercase tracking-wider">
              Assigned
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-bold  uppercase tracking-wider">
              Year
            </th>

          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="(project, index) in filteredProject" :key="index"
            class="hover:bg-green-500 uppercase hover:cursor-pointer  ">
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">{{ index + 1 }} </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center">

                <div class="ml-4">
                  <div class="text-sm font-medium text-gray-900">
                    {{ project.project_title }}
                  </div>
                </div>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">{{ project.student?.name }} </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">{{ project.department }} </div>

            </td>
            <td class="px-6 py-4 whitespace-nowrap ">
              <span class="" v-if="project.advisor_id">{{ project.advisor.name }}</span>
              <span class="text-red-500" v-else>No Assigned</span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span>{{ getYear(project.updated_at) }}</span>
            </td>

          </tr>
        </tbody>
      </table>
    </div>
  </UserLayout>
</template>