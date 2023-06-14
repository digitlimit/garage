<script setup>
  import DefaultLayout from '@/Layouts/Default.vue';
  import PageTitle     from '@/Shared/Partials/PageTitle.vue';
  import CreateBooking from '@/Components/Forms/CreateBooking.vue';
</script>
<template>
  <DefaultLayout>
    <PageTitle title="Paul's Garage" subtitle="Welcome to Paul's Garage. You can now book online below." />
    <section class="w-full"> 
        <div class="flex flex-col md:col-span-2 md:row-span-2 bg-white shadow rounded-lg">
        <div class="px-6 py-5 font-bold border-b border-gray-100">Garage Booking</div>
        <div class="p-4 flex-grow">
            <CreateBooking />
        </div>
        </div>
    </section>
  </DefaultLayout>
</template>

