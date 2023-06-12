<script setup>
  import Sidebar       from '@/Shared/Partials/Sidebar.vue';
  import PageTitle     from '@/Shared/Partials/PageTitle.vue';
  import CreateBooking from '@/Components/Forms/CreateBooking.vue';
</script>
<template>
<div class="flex bg-gray-100 min-h-screen">
  
    <Sidebar />
  
  <div class="flex-grow text-gray-800">
    <header class="flex items-center h-20 px-6 sm:px-10 bg-white">
      <button class="block sm:hidden relative flex-shrink-0 p-2 mr-2 text-gray-600 hover:bg-gray-100 hover:text-gray-800 focus:bg-gray-100 focus:text-gray-800 rounded-full">
        <span class="sr-only">Logout</span>
          <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
        </svg>
      </button>
  
      <div class="flex flex-shrink-0 items-center ml-auto">
      
        <div class="border-l pl-3 ml-3 space-x-1">
          <button class="relative p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-600 focus:bg-gray-100 focus:text-gray-600 rounded-full">
            <span class="sr-only">Log out</span>
            <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
</svg>
          </button>
        </div>
      </div>
    </header>

    <main class="p-6 sm:p-10 space-y-6">
      
        <PageTitle title="Dashboard" subtitle="View a list of bookings" />
  
        <!-- <section class="grid md:grid-cols-2 xl:grid-cols-4 xl:grid-rows-3 xl:grid-flow-col gap-6">  -->
      <section class="w-full"> 
        <!-- w-full max-w-lg -->
        <div class="flex flex-col md:col-span-2 md:row-span-2 bg-white shadow rounded-lg">
          <div class="px-6 py-5 font-bold border-b border-gray-100">Garage Booking</div>
          <div class="p-4 flex-grow">
            <CreateBooking />
          </div>
        </div>
      </section>
    </main>
  </div>
</div>
</template>

