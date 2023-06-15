
<script setup>
    import {ref, onMounted} from "vue";
    import { useAuth }  from '@/Store/auth';
    
    import SubmitButton from '@/Shared/Partials/Button.vue';
    import TextInput    from '@/Shared/Fields/TextInput.vue';
  
    const auth = useAuth();

    // define models
    const creds = ref({
        email: null,
        password: null
    });

    // mounted
    onMounted(() => { 
        auth.reset();
    });

    // login user
    const onSubmit = async () => {
        auth.login(creds);
    };

</script>
<template>
    <form class="md:space-y-6 space-y-4">
        <div v-if="auth.success" 
            class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            <span class="font-medium">Success!</span> {{ auth.success }}
        </div>
        <div v-if="auth.error" 
            class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <span class="font-medium">Opps!</span> {{ auth.error }}
        </div>
        
        <div>
            <TextInput v-model="creds.email" :error="auth.errors.email" type="email" label="E-mail address" />
        </div>
        <div>
            <TextInput v-model="creds.password" :error="auth.errors.password" type="password" label="Your Password" />
        </div>

        <div class="flex justify-between items-center">
            <SubmitButton @click="onSubmit" :spin="auth.loading" label="Login" />
        </div>
    </form>
</template>