<script setup>
  import SubmitButton from '@/Shared/Partials/Button.vue';
  const props = defineProps({
    slots: {
        type: Array,
        default: []
    },
    openable: {
        type: Boolean,
        default: false
    }
  });

const emit = defineEmits(['open:slot']);

const handleOpen = (value) => {
  emit('open:slot', value);
};

</script>
<template>
    <table v-if="slots.length" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Name</th>
                <th scope="col" class="px-6 py-3">Date</th>
                <th v-if="openable" scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr 
            v-for="(slot, index) in slots"
            :key="index"
            class="bg-white  dark:bg-gray-800  hover:bg-gray-50 dark:hover:bg-gray-600"
            >
                <td class="px-6 py-4">{{ slot.name ?? '-- All slots --' }}</td>
                <td class="px-6 py-4">{{ slot.date }}</td>
                <td v-if="openable" class="px-6 py-4">
                    <SubmitButton @click="handleOpen(slot)" label="Reopen" />
                </td>
            </tr>
        </tbody>
    </table>
</template>