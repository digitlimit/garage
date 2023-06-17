
<script setup>
    import {ref, computed, onMounted} from "vue"; 
    import { useSlot }      from '@/Store/slot';
    import SlotHelper       from '../Helpers/SlotHeper';

    import SubmitButton from '@/Shared/Partials/Button.vue';
    import Alert        from '@/Shared/Partials/Alert.vue';
    import DateInput    from '@/Shared/Fields/DateInput.vue';
    import SelectInput  from '@/Shared/Fields/SelectInput.vue';
  
    const slot = useSlot();
   
    const slots = ref([]);
    const form  = ref({ date: null });

    const disabledDates = ref([]);

    // select options
    onMounted(async () => {
        slots.value = await SlotHelper.selectOptions();
    });

    // closed dates
    onMounted(async () => {
        const dates = await SlotHelper.disabledDates();
        disabledDates.value = dates;
    });

    const onSubmit = async () => { 
        const res = await slot.closeDate(form.value);
    };
</script>
<template>
    <form class="m-3">

        <Alert :show="slot.tag =='close-date'" :error="slot.error" :success="slot.success" />

        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <DateInput 
                    v-model="form.date" 
                    :disabled-dates="disabledDates"
                    :error="slot.errors.date" 
                    label="Date" 
                />
            </div>
        </div>

        <div class="flex items-center justify-between">
            <SubmitButton @click="onSubmit" :spin="slot.loading" label="Block" />
        </div>

    </form>
</template>