<template>
    <button 
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
        :type="type" 
    >
        {{ label }}
    </button>
</template>

<script setup>
    defineProps({
        id: {
            type: String,
            default() {
                return `button-${Math.random() * 1000}`;
            },
        },

        type: {
            type: String,
            default: 'button'
        },
       
        label: {
            type: String,
            default: 'Submit'
        },
    });
</script>