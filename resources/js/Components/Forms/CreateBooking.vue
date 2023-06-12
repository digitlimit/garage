
<script setup>
  import SubmitButton  from '@/Shared/Partials/Button.vue';
  import TextInput     from '@/Shared/Fields/TextInput.vue';
  import DateTimeInput from '@/Shared/Fields/DateTimeInput.vue';
</script>
<template>
    <form class="m-3">
        <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <TextInput name="name" type="text" label="Your name" />
        </div>
        <div class="w-full md:w-1/3 px-3">
            <TextInput name="email" type="email" label="E-mail address" />
        </div>
        <div class="w-full md:w-1/3 px-3">
            <TextInput name="phone" type="text" label="Phone Number" />
        </div>
        </div>

        <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <TextInput name="make" type="text" label="Vehicle Make" />
        </div>
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <TextInput name="model" type="text" label="Vehicle Model" />
        </div>
        </div>

        <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <DateTimeInput name="start_time" type="text" label="Start Time" />
        </div>
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <DateTimeInput name="end_time" type="text" label="End Time" />
        </div>
        </div>

        <div class="flex items-center justify-between">
        <SubmitButton label="Book Now" />
        </div>
    </form>
</template>