
<template>
    <div class="flex flex-col space-y-6 md:space-y-0 md:flex-row justify-between">
        <div class="mr-6">
          <h1 class="text-4xl font-semibold mb-2">{{ title }}</h1>
          <h2 class="text-gray-600 ml-0.5">{{ subtitle }}</h2>
        </div>
      </div>
</template>

<script setup>
    defineProps({
        title: {
            type: String,
            default: ''
        },

        subtitle: {
            type: String,
            default: ''
        }
    });
</script>