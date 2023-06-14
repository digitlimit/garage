<script setup>
  import NavLink from '@/Shared/Partials/NavLink.vue';
</script>
<template>
    <aside class="hidden sm:flex sm:flex-col">
    <a href="#" class="inline-flex items-center justify-left h-20 w-20 font-bold pl-6">
      Garage
    </a>

    <div class="flex-grow flex flex-col justify-between text-gray-500 bg-gray-800">
      <nav class="flex flex-col mx-4 my-6 space-y-4">
        <NavLink name="admin.dashboard"   :params="{}" title="Dashboard" />
        <NavLink name="bookings.list"     :params="{}" title="Bookings" />
        <NavLink name="slots.closed.list" :params="{}" title="Slots" />
      </nav>
    </div>
  </aside>
</template>