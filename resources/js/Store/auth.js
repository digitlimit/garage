import { ref } from 'vue';
import { defineStore } from 'pinia';

import router from "@/routes";
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

    /**
     * Check if user has any of the roles in the array
     * @param {*} roles 
     */
    function middleware(middlewares)
    {
        let role = 'guest';

        const userData = this.user;

        if(userData && this.loggedIn) {
            role = userData.is_admin ? 'admin' : 'user';
        }

        return middlewares.includes(role);
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
                router.push({ name: 'dashboard.index' });
            }
        });
    }

    async function flush()
    {
        reset();
        this.user     = null;
        this.loggedIn = false;
    }

    async function logout() 
    {
        return await API
            .post('/auth/logout', {}, () => {
                // log user out
                this.loading = false;
                this.flush();
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
        logout,
        flush,
        reset,
        middleware
    }

}, {persist: {
    storage: sessionStorage
}});