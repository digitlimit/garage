<script setup>
    import {ref, onMounted} from "vue";
    import { useAuth } from '@/Store/auth';
    import router from "@/routes";

    const auth = useAuth();

    const logout = () => {
        auth.logout();
        auth.flush();
        router.push({'name': 'auth.login'});
    }
</script>
<template>
    <header class="flex items-center h-20 px-6 sm:px-10 bg-white">
       <slot></slot>

        <div class="flex flex-shrink-0 items-center ml-auto">
            <div v-if="auth.loggedIn" class="pl-3 ml-3 space-x-1">
                <router-link :to="{ name: 'dashboard.index'}" class="relative p-2 text-gray-500 focus:text-gray-600">
                    Dashboard
                </router-link>
            </div>
            <div class="border-l pl-3 ml-3 space-x-1">
                <button v-if="auth.loggedIn" @click="logout" class="relative p-2 text-gray-500 focus:text-gray-600">
                    Logout
                </button>
                <router-link v-else :to="{ name: 'auth.login'}" class="relative p-2 text-gray-500 focus:text-gray-600">
                    Login
                </router-link>
            </div>
        </div>
    </header>
</template>