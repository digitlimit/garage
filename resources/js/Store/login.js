import { ref, computed } from 'vue';
import { defineStore } from 'pinia'
import API from '@/Shared/Helpers/API';

const storeId = 'login';

export const useLogin = defineStore(storeId, () => {

    // states
    let loading  = ref(false);
    let complete = ref(false);
    let error    = ref('');
    let success  = ref('');

    return { 
    
    }
}, {persist: {
    storage: sessionStorage
}});