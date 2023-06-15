
<script setup>
    import {ref, onMounted} from "vue";
    import { useSlot }      from '@/Store/slot';

    import SubmitButton from '@/Shared/Partials/Button.vue';
    import Alert        from '@/Shared/Partials/Alert.vue';
    import DateInput    from '@/Shared/Fields/DateInput.vue';
    import SelectInput  from '@/Shared/Fields/SelectInput.vue';
  
    const slot = useSlot();
   
    const form = ref({
        date: null,
        slot: null
    });
    const slots       = ref([]);
    const closedSlots = ref([]);
    const closedDates = ref([]);

    onMounted( async () => { 
        // fetch closed slots
        closedSlots.value = await slot.closedSlots();
    });

    onMounted( async () => { 
        // fetch closed dates
        closedDates.value = await slot.closedDates(); 
    });

    onMounted(async () => {
        // fetch slots for select menu
        const options = await slot.slots();

        options.forEach((slot, index) => {
            options[index] = {label: slot.name, value: slot.id}
        });
        
        slots.value = options;
    });

    // close the given slot and date or only date
    const onSubmit = async () => { 
     const res = await slot.closeSlot(form.value);
    //  console.log(res);
    };

</script>
<template>
    <form class="m-3">

        <Alert :error="slot.error" :success="slot.success" />

        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <SelectInput v-model="form.slot" :error="slot.errors.slot" :options="slots" label="Slot" />
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <DateInput v-model="form.date" :error="slot.errors.date" type="text" label="Date" />
            </div>
        </div>

        <div class="flex items-center justify-between">
            <SubmitButton @click="onSubmit" :spin="slot.loading" label="Block" />
        </div>

    </form>
</template>