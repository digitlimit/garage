import { ref } from 'vue';
import { defineStore } from 'pinia'
import API from '@/Shared/Helpers/API';

const storeId = 'slot';
//to the hospital okay, you gon feel beeea okay?
export const useSlot = defineStore(storeId, () => {

    // states
    let loading  = ref(true);
    let complete = ref(false);
    let error    = ref('');
    let success  = ref('');
    let errors   = ref([]);

    async function options() 
    {
        this.loading = true;

        const lists = await API
            .get('/slots', {}, () => {
                this.loading = false;
            }, ({ message, errors }) => {
                this.loading = false;
                this.error   = message;
                this.errors  = errors;
            });

        lists.forEach((slot, index) => {
            lists[index] = {label: slot.name, value: slot.id}
        });

        return lists;
    }
  
    return { 
        errors,
        complete,
        loading,
        error,
        success,
        options
    }
});