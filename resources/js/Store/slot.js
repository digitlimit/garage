import { ref } from 'vue';
import { defineStore } from 'pinia'
import API from '@/Shared/Helpers/API';
import Helper from '../Shared/Helpers/Helper';

const storeId = 'slot';
export const useSlot = defineStore(storeId, () => {

    /**
     * States
     */
    let loading  = ref(true);
    let complete = ref(false);
    let error    = ref('');
    let success  = ref('');
    let errors   = ref([]);

    /**
     * Fetch a list of slot
     * @returns 
     */
    async function slots() 
    {
        this.loading = true;

        const slots = await API
            .get('/slots', {}, () => {
                this.loading = false;
            }, ({ message, errors }) => {
                this.loading = false;
                this.error   = message;
                this.errors  = errors;
            });

        return slots ? slots : [];
    }

    /**
     * Get closed slots
     * 
     * @param {*} slot 
     * @returns 
     */
    async function closedSlots() 
    {
        this.loading = true;

        const slots = await API
            .get('/slots/closed-slots', {}, () => {
                this.loading = false;
            }, ({ message, errors }) => {
                this.loading = false;
                this.error   = message;
                this.errors  = errors;
            });

        return slots ? slots : [];
    }

    /**
     * Get closed slots for dates from today
     * 
     * @returns 
     */
    async function closedDates() 
    {
        this.loading = true;

        const dates = await API
            .get('/slots/closed-dates', {}, () => {
                this.loading = false;
            }, ({ message, errors }) => {
                this.loading = false;
                this.error   = message;
                this.errors  = errors;
            });

        return dates ? dates : [];
    }


    /**
     * Close a slot 
     * 
     * @param {*} param
     * @returns 
     */
    async function closeSlot({ slot, date }) 
    {
        this.loading = true;

        date = Helper.dateYmd(date);
        const params = {slot, date};

        const res = await API
            .post('/slots/close', params, () => {
                this.loading = false;
            }, ({ message, errors }) => {
                this.loading = false;
                this.error   = message;
                this.errors  = errors;
            });

        return res;
    }

    /**
     * Open closed slot
     * 
     * @param {*} slot 
     * @returns 
     */
    async function openSlot({slot, date}) 
    {
        this.loading = true;
        date = Helper.dateYmd(date);

        const params = {slot, date};

        const res = await API
            .post('/slots/open', params, () => {
                this.loading = false;
            }, ({ message, errors }) => {
                this.loading = false;
                this.error   = message;
                this.errors  = errors;
            });

        return res;
    }

    return { 
        errors,
        complete,
        loading,
        error,
        success,
        slots,
        closeSlot,
        openSlot,
        closedSlots,
        closedDates
    }
});