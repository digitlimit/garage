<script setup>
  import DashboardLayout from '@/Layouts/Dashboard.vue';
  import PageTitle       from '@/Shared/Partials/PageTitle.vue';
  import CloseSlot       from '@/Shared/Forms/CloseSlot.vue';
  import CloseDate       from '@/Shared/Forms/CloseDate.vue';
</script>
<template>
  <DashboardLayout>
    <PageTitle title="Slots Blocking" subtitle="Here you can block a slot or date from being booked" />
    
    <section class="w-full"> 
        <div class="flex flex-col md:col-span-2 md:row-span-2 bg-white shadow rounded-lg">
        <div class="px-6 py-5 font-bold border-b border-gray-100">
          Close a slot for given date
        </div>
        <div class="p-4 flex-grow">
          <CloseSlot />
        </div>
        </div>
    </section>

    <section class="w-full"> 
        <div class="flex flex-col md:col-span-2 md:row-span-2 bg-white shadow rounded-lg">
        <div class="px-6 py-5 font-bold border-b border-gray-100">
          Close a date 
        </div>
        <div class="p-4 flex-grow">
          <CloseDate />
        </div>
        </div>
    </section>

  </DashboardLayout>
</template>