<script setup>
  import NavLink from '@/Shared/Partials/NavLink.vue';
</script>
<template>
    <aside class="hidden sm:flex sm:flex-col">
      <router-link :to="{name: 'dashboard.index'}" 
        class="inline-flex items-center justify-left h-20 w-20 font-bold pl-6">
          <router-link :to="{ name: 'landing.index'}">
            Garage
          </router-link>
      </router-link >
      <div class="flex-grow flex flex-col justify-between text-gray-500 bg-gray-800">
        <nav class="flex flex-col mx-4 my-6 space-y-4">
          <NavLink name="dashboard.index" :params="{}" title="Bookings" />
          <NavLink name="slots.list"      :params="{}" title="Slots" />
          <NavLink name="slots.close"     :params="{}" title="Block Slot" />
        </nav>
      </div>
    </aside>
</template>