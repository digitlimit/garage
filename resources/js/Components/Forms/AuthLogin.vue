
<script setup>
    import {ref, onMounted} from "vue";
    import { useAuth }  from '@/Store/auth';
    
    import SubmitButton from '@/Shared/Partials/Button.vue';
    import TextInput    from '@/Shared/Fields/TextInput.vue';
  
    const authStore = useAuth();

    // define models
    const creds = ref({
        email: null,
        password: null
    });

    // mounted
    onMounted(() => {

    });

    // create booking
    const onSubmit = async () => {
        authStore.login(creds);
    };

</script>
<template>
    <form class="md:space-y-6 space-y-4">
        <div>
            <TextInput v-model="creds.email" :error="authStore.errors.email" type="email" label="E-mail address" />
        </div>
        <div>
            <TextInput v-model="creds.password" :error="authStore.errors.password" type="password" label="Your Password" />
        </div>

        <div class="flex justify-between items-center">
            <SubmitButton @click="onSubmit" :spin="authStore.loading" label="Login" />
        </div>
    </form>
</template>