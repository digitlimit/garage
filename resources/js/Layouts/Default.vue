<script setup>
  import MainHeader from '@/Shared/Partials/Header.vue';
</script>
<template>
    <div class="flex bg-gray-100 min-h-screen">
        <div class="flex-grow text-gray-800">
            <MainHeader>
                <p class="text-left md:text-center text-lg text-blue-600/100 uppercase font-bold">
                    Garage
                </p>
            </MainHeader>
            <main class="p-6 sm:p-10 space-y-6">
                <slot></slot>
            </main>
        </div>
    </div>
</template>

