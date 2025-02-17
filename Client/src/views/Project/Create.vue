<script setup>
import { ref, onMounted } from 'vue';
import UserLayout from '@/layout/UserLayout.vue';

const formData = ref({
    project_title: "",
    description: "",
    student_id: "",
    advisor_id: "",
    department: "",
    document: "",
    due_date: "",
});

const errors = ref({});

const submitForm = () => {
    console.log(formData.value);
    //   registerProject(formData.value);
};

onMounted(() => (errors.value = {}));
</script>

<template>
    <UserLayout>
        <div class="flex max-h-[calc(100vh-90px)] mt-16 flex-col justify-center py-0 px-4">
            <div class="mx-auto w-full max-w-screen-md rounded-2xl border border-gray-300 p-8">
                <form @submit.prevent="submitForm">
                    <div class="space-y-6">
                        <div>
                            <label for="project_title" class="mb-2 block text-sm text-gray-800">Project Title</label>
                            <input v-model="formData.project_title" id="project_title" name="project_title" type="text"
                                autocomplete="project_title"
                                class="w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-sm text-gray-800 outline-bg-light-green"
                                placeholder="Enter project title" />
                        </div>
                        <div>
                            <label for="description" class="mb-2 block text-sm text-gray-800">Description</label>
                            <textarea v-model="formData.description" id="description" name="description"
                                autocomplete="description"
                                class="w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-sm text-gray-800 outline-bg-light-green"
                                placeholder="Enter project description"></textarea>
                        </div>
                        <div>
                            <label for="student_id" class="mb-2 block text-sm text-gray-800">Student ID</label>
                            <input v-model="formData.student_id" id="student_id" name="student_id" type="text"
                                autocomplete="student_id"
                                class="w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-sm text-gray-800 outline-bg-light-green"
                                placeholder="Enter student ID" />
                        </div>
                        <div>
                            <label for="advisor_id" class="mb-2 block text-sm text-gray-800">Advisor ID</label>
                            <input v-model="formData.advisor_id" id="advisor_id" name="advisor_id" type="text"
                                autocomplete="advisor_id"
                                class="w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-sm text-gray-800 outline-bg-light-green"
                                placeholder="Enter advisor ID" />
                        </div>
                        <div>
                            <label for="department" class="mb-2 block text-sm text-gray-800">Department</label>
                            <input v-model="formData.department" id="department" name="department" type="text"
                                autocomplete="department"
                                class="w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-sm text-gray-800 outline-bg-light-green"
                                placeholder="Enter department" />
                        </div>
                        <div>
                            <label for="document" class="mb-2 block text-sm text-gray-800">Document</label>
                            <input v-model="formData.document" id="document" name="document" type="text"
                                autocomplete="document"
                                class="w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-sm text-gray-800 outline-bg-light-green"
                                placeholder="Enter document URL" />
                        </div>
                        <div>
                            <label for="due_date" class="mb-2 block text-sm text-gray-800">Due Date</label>
                            <input v-model="formData.due_date" id="due_date" name="due_date" type="date"
                                autocomplete="due_date"
                                class="w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-sm text-gray-800 outline-bg-light-green"
                                placeholder="Enter due date" />
                        </div>
                        <div>
                            <button type="submit"
                                class="w-full rounded-md bg-green-500 px-4 py-3 text-sm text-white hover:bg-green-700 transition ease-in-out duration-300">
                                Register Project
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </UserLayout>
</template>