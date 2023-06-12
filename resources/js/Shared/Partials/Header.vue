<template>
    <header class="flex items-center h-20 px-6 sm:px-10 bg-white">
      
        <button class="block sm:hidden relative flex-shrink-0 p-2 mr-2 text-gray-600 hover:bg-gray-100 hover:text-gray-800
        focus:bg-gray-100 focus:text-gray-800 rounded-full">
            <span class="sr-only">Logout</span>
            <LogoutIcon />
        </button>
  
        <div class="flex flex-shrink-0 items-center ml-auto">
            <div class="border-l pl-3 ml-3 space-x-1">
            <button class="relative p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-600
            focus:bg-gray-100 focus:text-gray-600 rounded-full">
                <span class="sr-only">Logout</span>
                <LogoutIcon />
            </button>
            </div>
        </div>

    </header>
</template>

<script setup>
    import LogoutIcon from '@/Shared/Icons/Logout.vue';
</script>