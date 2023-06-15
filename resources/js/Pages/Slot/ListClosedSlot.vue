<script setup>
  import {ref, onMounted} from "vue";
  import { useSlot }      from '@/Store/slot';

  import DashboardLayout  from '@/Layouts/Dashboard.vue';
  import PageTitle        from '@/Shared/Partials/PageTitle.vue';
  import TableSlot        from '@/Shared/Tables/TableSlot.vue';

  const slot        = useSlot();
  const bookedSlots = ref([]);
  const closedSlots = ref([]);
  const closedDates = ref([]);

  onMounted( async () => { 
    // fetch booked slots
    bookedSlots.value = await slot.bookedSlots();
  });

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
      <div class="px-6 py-5 font-bold border-b border-gray-100">Blocked Dates</div>
        <div class="p-4 flex-grow">
          <TableSlot :slots="closedDates" />
        </div>
      </div>
    </section>

    <section class="w-full"> 
      <div class="flex flex-col md:col-span-2 md:row-span-2 bg-white shadow rounded-lg">
      <div class="px-6 py-5 font-bold border-b border-gray-100">Blocked Slots</div>
        <div class="p-4 flex-grow">
          <TableSlot :slots="closedSlots" />
        </div>
      </div>
    </section>

    <section class="w-full"> 
      <div class="flex flex-col md:col-span-2 md:row-span-2 bg-white shadow rounded-lg">
      <div class="px-6 py-5 font-bold border-b border-gray-100">Booked Slots</div>
        <div class="p-4 flex-grow">
          <TableSlot :slots="bookedSlots" />
        </div>
      </div>
    </section>
    
  </DashboardLayout>
</template>