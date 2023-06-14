<script setup>
    const props = defineProps({
        title: {
            type: String,
            required: true
        },
        name: {
            type: String,
            required: true
        },
        params: {
            type: Object,
            default: {}
        },
    });

    const route = { name: props.name, params: props.params };
</script>
<template>
    <router-link 
        :to="route"  
        class="inline-flex items-center justify-left py-2 px-2 hover:text-gray-400
             hover:bg-gray-700 focus:text-gray-400 focus:bg-gray-700 rounded-lg"
    >
        <span class="font-bold">{{ title }}</span>
    </router-link>
</template>