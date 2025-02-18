<script setup>
import { useProjectStore } from '@/stores/project';
import { useUserStore } from '@/stores/user';
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue'
import { ChevronDownIcon } from '@heroicons/vue/20/solid'
import { storeToRefs } from 'pinia';
import { onMounted, reactive, ref } from "vue";


const { getAdvisors } = useUserStore()
const { errors } = storeToRefs(useUserStore())
const { approveProject } = useProjectStore()

const emit = defineEmits(['handleUpdate'])


const advisors = ref([])

const props = defineProps(({
  projectId: Number
}))

onMounted(async () => {
  advisors.value = await getAdvisors();
  // console.log(advisors.value);
})
const submit = async () => {
  await approveProject(props.projectId, formData)
  emit('handleUpdate');

  // console.log(formData);
}

const formData = reactive({
  advisor_id: "",
  due_date: "",
});

const getMinDate = () => {
  const today = new Date();
  const year = today.getFullYear();
  let month = today.getMonth() + 1;
  let day = today.getDate();

  month = month < 10 ? `0${month}` : month;
  day = day < 10 ? `0${day}` : day;

  return `${year}-${month}-${day}`;
};






const departments = [
  "Information System",
  "Information Technology",
  "Software Engineering",
  "Computer Science",
];

</script>

<template>
  <div class="   w-full min-w-[300px] px-4">
    <Popover v-slot="{ open }" class="relative">
      <PopoverButton :class="open ? 'text-black' : 'text-black/90'"
        class="group inline-flex items-center rounded-md bg-orange-700 px-3 py-2 text-base font-medium hover:text-black focus:outline-none focus-visible:ring-2 focus-visible:ring-white/75">
        <span>Approve</span>
        <ChevronDownIcon :class="open ? 'text-orange-300' : 'text-orange-300/70'"
          class="ml-2 h-5 w-5 transition duration-150 ease-in-out group-hover:text-orange-300/80" aria-hidden="true" />
      </PopoverButton>

      <transition enter-active-class="transition duration-200 ease-out" enter-from-class="translate-y-1 opacity-0"
        enter-to-class="translate-y-0 opacity-100" leave-active-class="transition duration-150 ease-in"
        leave-from-class="translate-y-0 opacity-100" leave-to-class="translate-y-1 opacity-0">
        <PopoverPanel class="absolute left-1/2 z-10 mt-3 w-full -translate-x-1/2 transform px-4 sm:px-0  ">
          <div class="overflow-hidden rounded-lg shadow-lg ring-1 ring-black/5">
            <div class="relative grid gap-8 bg-white p-7 ">
              <div>
                <label for="department" class="  mb-2 block text-sm text-gray-800">Select Advisor</label>
                <select v-model="formData.advisor_id" id="department" name="department"
                  class="w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-sm text-gray-800 outline-bg-light-green">
                  <option value="" disabled>Select Advisor</option>
                  <option v-for="advisor in advisors" :key="advisor?.id" :value="advisor?.id">
                    {{ advisor?.name }}
                  </option>
                </select>
                <p v-if="errors.advisor_id" class="text-sm text-red-500">
                  {{ errors.advisor_id[0] }}
                </p>
              </div>

              <div class="">
                <label for="due_date" class="  mb-2 block text-sm text-gray-800">Select Due Date</label>
                <input
                  class="w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-sm text-gray-800 outline-bg-light-green"
                  v-model="formData.due_date" type="date" name="due_date" id="due_date" :min="getMinDate()">
              </div>
              <button @click.prevent="submit"
                class="ml-2 bg-green-500 text-white hover:bg-green-600  px-2 rounded-md py-[10px] ">Approve Request
              </button>

            </div>
          </div>
        </PopoverPanel>
      </transition>
    </Popover>
  </div>
</template>
