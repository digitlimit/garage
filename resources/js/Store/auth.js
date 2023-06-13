import { ref } from 'vue';
import { defineStore } from 'pinia';

import API    from '@/Shared/Helpers/API';
import Helper from '@/Shared/Helpers/Helper';

const storeId = 'auth';

export const useAuth = defineStore(storeId, () => {

    // states
    let errors   = ref([]);
    let loading  = ref(false);
    let complete = ref(false);
    let error    = ref('');
    let success  = ref('');
    let authUser = ref(null);
    let isAdmin  = ref(false);
    let isAuth   = ref(false);

    async function user() 
    {
        return await API
            .post('/auth/user', {}, () => {
                this.loading = false;
                this.success = 'Welcome';
            }, ({ message, errors }) => {
                this.loading = false;
                this.error   = message;
                this.errors  = errors;
            });
    }

    async function login(creds) 
    {
        const params = creds.value;
        const axios  = API.axios();

        axios.defaults.baseURL = Helper.siteBaseUrl();

        // fetch and sanctum csrf cookie in browser
        axios
        .get('/sanctum/csrf-cookie')
        .then(async response => {

            // attempt login
            axios.defaults.baseURL = Helper.apiBaseUrl();
            const user = API
            .post('/auth/login', params, () => {
                this.loading = false;
                this.success = 'Login was done.';

                console.log(user, 77)

            }, ({ message, errors }) => { 
                this.loading = false;
                this.error   = message;
                this.errors  = errors;
            });
        });
    }

    async function logout() 
    {
        return await API
            .post('/auth/logout', {}, () => {
                this.loading = false;
                this.success = 'Logout was done.';
            }, ({ message, errors }) => {
                this.loading = false;
                this.error   = message;
                this.errors  = errors;
            });
    }

    return { 
        errors,
        loading,
        complete,
        error,
        success,
        authUser,
        isAdmin,
        isAuth,
        user,
        login,
        logout
    }

}, {persist: {
    storage: sessionStorage
}});