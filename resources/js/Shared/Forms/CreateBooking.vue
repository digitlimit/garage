
<script setup>
    import {ref, computed, onMounted} from "vue";
    import { useBooking } from "@/Store/booking";
    import { useSlot }    from "@/Store/slot";

    import Alert        from '@/Shared/Partials/Alert.vue';
    import SubmitButton from '@/Shared/Partials/Button.vue';
    import TextInput    from '@/Shared/Fields/TextInput.vue';
    import DateInput    from '@/Shared/Fields/DateInput.vue';
    import SelectInput  from '@/Shared/Fields/SelectInput.vue';
  
    const bookingStore = useBooking();
    const slotStore    = useSlot();

    // define models
    const booking = ref({
        name: null,
        email: null,
        phone: null,
        make: null,
        model: null,
        date: null,
        slot: null
    });

    const slots = ref([]);

    onMounted(async () => {
        // fetch slots for select menu
        const options = await slot.slots();

        options.forEach((slot, index) => {
            options[index] = {label: slot.name, value: slot.id}
        });
        
        slots.value = options;
    });

    // create booking
    const onSubmit = async () => {
        bookingStore.create(booking);
    };

</script>
<template>
    <form class="m-3">

        <Alert :error="bookingStore.error" :success="bookingStore.success" />

        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <TextInput v-model="booking.name" :error="bookingStore.errors.name" type="text" label="Your name" />
            </div>
            <div class="w-full md:w-1/3 px-3">
                <TextInput v-model="booking.email" :error="bookingStore.errors.email" type="email" label="E-mail address" />
            </div>
            <div class="w-full md:w-1/3 px-3">
                <TextInput v-model="booking.phone" :error="bookingStore.errors.phone" type="text" label="Phone Number" />
            </div>
        </div>

        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <TextInput v-model="booking.make" :error="bookingStore.errors.make" type="text" label="Vehicle Make" />
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <TextInput v-model="booking.model" :error="bookingStore.errors.model" type="text" label="Vehicle Model" />
            </div>
        </div>

        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <SelectInput v-model="booking.slot" :error="bookingStore.errors.slot" :options="slots" label="Slot" />
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <DateInput v-model="booking.date" :error="bookingStore.errors.date" type="text" label="Date" />
            </div>
        </div>

        <div class="flex items-center justify-between">
            <SubmitButton @click="onSubmit" :spin="slotStore.loading" label="Book Now" />
        </div>
    </form>
</template>