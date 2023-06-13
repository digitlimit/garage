import { ref } from 'vue';
import { defineStore } from 'pinia'
import API from '@/Shared/Helpers/API';

const storeId = 'booking';

export const useBooking = defineStore(storeId, () => {

    // states
    let loading  = ref(false);
    let complete = ref(false);
    let error    = ref('');
    let success  = ref('');
    let errors   = ref([]);

    async function createBooking(booking) 
    {
        const params = booking.value;

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
  
    return { 
        errors,
        complete,
        loading,
        error,
        success,
        createBooking,
    }
});