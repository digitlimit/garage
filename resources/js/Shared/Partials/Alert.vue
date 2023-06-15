<script setup>

const props = defineProps({
    success: {
        type: String,
        default: ''
    },
    error: {
        type: String,
        default: ''
    },
    title: {
        type: String,
        default: ''
    }
});
</script>

<template>
    <div v-if="success" 
        class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        <span v-if="title" class="font-medium">{{ title }}</span> {{ success }}
    </div>
    <div v-else-if="error" 
        class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <span v-if="title" class="font-medium">{{ title }}</span> {{ error }}
    </div>
</template>