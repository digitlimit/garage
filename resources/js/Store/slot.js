import { ref } from 'vue';
import { defineStore } from 'pinia'
import API from '@/Shared/Helpers/API';
import Helper from '../Shared/Helpers/Helper';

const storeId = 'slot';
export const useSlot = defineStore(storeId, () => {

    /**
     * States
     */
    let loading  = ref(false);
    let complete = ref(false);
    let error    = ref('');
    let tag      = ref('');
    let success  = ref('');
    let errors   = ref([]);

    /**
     * Clear states
     */
    function clear() {
        loading.value  = false;
        complete.value = false;
        error.value    = '';
        success.value  = '';
        errors.value   = [];
        tag.value      = '';
    }

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
     * Get booked slots
     * 
     * @param {*} slot 
     * @returns 
     */
     async function bookedSlots() 
     {
        clear();
        this.loading = true;
 
        const slots = await API
             .get('/slots/booked-slots', {}, () => {
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
        clear();
        this.tag = 'close-slot';
        date = date ? Helper.dateYmd(date) : null;

        if(!slot || !date) {
            this.error = "A slot and a date are required";
            return;
        }

        this.loading = true;
        const params = { slot, date };
        const res = await API
            .post('/slots/close-slot', params, () => {
                this.loading = false;
                this.success = `The slot was blocked for ${date}`;
            }, ({ message, errors }) => {
                this.loading = false;
                this.error   = message;
                this.errors  = errors;
            });

        return res;
    }

    /**
     * Close a Date
     * 
     * @param {*} param
     * @returns 
     */
     async function closeDate({ date }) 
     {
        clear();
        this.tag = 'close-date';
        date = date ? Helper.dateYmd(date) : null;

        if(!date) {
            this.error = "Please select a date";
            return;
        }

        this.loading = true;
        const params = { date };
        
        const res = await API
            .post('/slots/close-date', params, () => {
                this.loading = false;
                this.success = `The date ${date}, has been blocked for booking`;
            }, ({ message, errors }) => {
                this.loading = false;
                this.error   = message;
                this.errors  = errors;
            });

        return res;
    }

    /**
     * Close a slot 
     * 
     * @param {*} param
     * @returns 
     */
    async function openSlot({ slot, date }) 
    {
        clear();
        this.tag = 'open-slot';
        date = date ? Helper.dateYmd(date) : null;

        if(!slot || !date) {
            this.error = "A slot and a date are required";
            return;
        }

        this.loading = true;
        const params = { slot, date };
        const res = await API
            .post('/slots/open-slot', params, () => {
                this.loading = false;
                this.success = `The slot was blocked for ${date}`;
            }, ({ message, errors }) => {
                this.loading = false;
                this.error   = message;
                this.errors  = errors;
            });

        return res;
    }
 
    /**
     * Open a Date
     * 
     * @param {*} param
     * @returns 
     */
    async function openDate({ date }) 
    {
        clear();
        this.tag = 'open-date';
        date = date ? Helper.dateYmd(date) : null;

        if(!date) {
            this.error = "Please select a date";
            return;
        }

        this.loading = true;
        const params = { date };
        const res = await API
            .post('/slots/open-date', params, () => {
                this.loading = false;
                this.success = `The date ${date}, has been reopened for booking`;
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
        bookedSlots,
        closedSlots,
        closedDates,
        closeSlot,
        openSlot,
        closeDate,
        openDate
    }
});