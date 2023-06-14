<script setup>
  import MainHeader from '@/Shared/Partials/Header.vue';
  import Sidebar    from '@/Shared/Partials/Sidebar.vue';
</script>
<template>
    <div class="flex bg-gray-100 min-h-screen">
        <Sidebar />
        <div class="flex-grow text-gray-800">
            <MainHeader>
            
            </MainHeader>
            <main class="p-6 sm:p-10 space-y-6">
                <slot></slot>
            </main>
        </div>
    </div>
</template>

