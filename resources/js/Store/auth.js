import { ref } from 'vue';
import { defineStore } from 'pinia';

import Router from "@/routes";
import API    from '@/Shared/Helpers/API';
import Helper from '@/Shared/Helpers/Helper';

const storeId = 'auth';

export const useAuth = defineStore(storeId, () => {

    let errors   = ref([]);
    let loading  = ref(false);
    let complete = ref(false);
    let error    = ref('');
    let success  = ref('');
    let user     = ref(null);
    let loggedIn = ref(false);

    // states
    function reset()
    {
        errors.value   = [];
        loading.value  = false;
        complete.value = false;
        error.value    = '';
        success.value  = '';
    }

    async function login(creds) 
    {
        // this.reset();

        const params = creds.value;
        const axios  = API.axios();

        axios.defaults.baseURL = Helper.siteBaseUrl();

        // fetch and sanctum csrf cookie in browser
        axios
        .get('/sanctum/csrf-cookie')
        .then(async response => {

            // attempt login
            axios.defaults.baseURL = Helper.apiBaseUrl();

            const userData = await API
            .post('/auth/login', params, () => {
                this.loading  = false;
            }, ({ message, errors }) => { 
                this.loading = false;
                this.error   = message;
                this.errors  = errors;
            });

            // log user in
            if(userData.id) {
                this.user     = userData;
                this.loggedIn = true;
                Router.push({ name: 'dashboard.index' });
            }
        });
    }

    async function logoutLocal()
    {
        this.user     = null;
        this.loggedIn = false;

        Router.push({ name: 'landing.index' })
    }

    async function logout() 
    {
        return await API
            .post('/auth/logout', {}, () => {
                // log user out
                this.loading = false;
                this.logoutLocal();
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
        user,
        loggedIn,
        login,
        logoutLocal,
        logout,
        reset
    }

}, {persist: {
    storage: sessionStorage
}});