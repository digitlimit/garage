<script setup>
  import {ref, onMounted} from "vue";
  import { useSlot }      from '@/Store/slot';

  import DashboardLayout  from '@/Layouts/Dashboard.vue';
  import PageTitle        from '@/Shared/Partials/PageTitle.vue';

  const slot        = useSlot();
  const closedSlots = ref([]);
  const closedDates = ref([]);

  onMounted( async () => { 
    // fetch closed slots
    closedSlots.value = await slot.closedSlots();
  });

  onMounted( async () => { 
    // fetch closed dates
    closedDates.value = await slot.closedDates(); 
  });

</script>
<template>
  <DashboardLayout>
    <PageTitle title="Blocked Slots" subtitle="Here is a list of blocked slots" />
    <section class="w-full"> 
        <div class="flex flex-col md:col-span-2 md:row-span-2 bg-white shadow rounded-lg">
        <div class="px-6 py-5 font-bold border-b border-gray-100">List of blocked slot and date</div>
        <div class="p-4 flex-grow">
          <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                  <tr>
                      <th scope="col" class="px-6 py-3">Name</th>
                      <th scope="col" class="px-6 py-3">Date</th>
                      <th scope="col" class="px-6 py-3">Action</th>
                  </tr>
              </thead>
              <tbody>
                  <tr 
                    v-for="(closedSlot, index) in closedSlots"
                    :key="index"
                    class="bg-white  dark:bg-gray-800  hover:bg-gray-50 dark:hover:bg-gray-600"
                  >
                    <template v-if="closedSlot.booking_slot_id">
                      <td class="px-6 py-4">{{ closedSlot.name }}</td>
                      <td class="px-6 py-4">{{ closedSlot.booking_slot_date }}</td>
                      <td class="px-6 py-4">Booked</td>
                    </template>
                    <template v-else-if="closedSlot.closed_slot_id">
                      <td class="px-6 py-4">{{ closedSlot.name }}</td>
                      <td class="px-6 py-4">{{ closedSlot.closed_slot_date }}</td>
                      <td class="px-6 py-4">Closed</td>
                    </template>
                  </tr>
              </tbody>
          </table>
        </div>
        </div>
    </section>

    <section class="w-full"> 
        <div class="flex flex-col md:col-span-2 md:row-span-2 bg-white shadow rounded-lg">
        <div class="px-6 py-5 font-bold border-b border-gray-100">List of blocked date</div>
        <div class="p-4 flex-grow">
          <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                  <tr>
                      <th scope="col" class="px-6 py-3">Date</th>
                  </tr>
              </thead>
              <tbody>
                  <tr 
                      v-for="(closedDate, index) in closedDates"
                      :key="index"
                      class="bg-white  dark:bg-gray-800  hover:bg-gray-50 dark:hover:bg-gray-600"
                  >
                    <td class="px-6 py-4">{{ closedDate.closed_date }}</td>
                  </tr>
              </tbody>
          </table>
        </div>
        </div>
    </section>
  </DashboardLayout>
</template>