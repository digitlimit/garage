import { ref } from 'vue';
import { defineStore } from 'pinia'
import API from '@/Shared/Helpers/API';
import Helper from '../Shared/Helpers/Helper';

const storeId = 'booking';

export const useBooking = defineStore(storeId, () => {

    // states
    let loading  = ref(false);
    let complete = ref(false);
    let error    = ref('');
    let success  = ref('');
    let errors   = ref([]);

    async function create(booking) 
    {
        const params = booking.value;

        params.date = Helper.dateYmd(params.date);

        return await API
            .post('/bookings', params, () => {
                this.loading = false;
                this.success = 'Booking created successfully. A confirmation email has been sent to you.';
                // booking.value = '';
            }, ({ message, errors }) => {
                this.loading = false;
                this.error   = message;
                this.errors  = errors;
            });
    }

    async function list(date) 
    {
        date = date ? Helper.dateYmd(date) : null;

        const filters = {
            date
        };

        const bookings = await API
            .get('/bookings', filters, () => {
                this.loading = false;
            }, ({ message, errors }) => {
                this.loading = false;
                this.error   = message;
                this.errors  = errors;
            });

        return bookings ? bookings : [];
    }
  
    return { 
        errors,
        complete,
        loading,
        error,
        success,
        create,
        list
    }
});