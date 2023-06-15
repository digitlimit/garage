<script setup>
    import AuthLayout from "@/Layouts/Auth.vue";
    import LoginForm  from '@/Shared/Forms/AuthLogin.vue';
</script>
<template>
    <AuthLayout>
        <h1 class="text-xl leading-tight  font-bold  text-gray-900 md:text-2xl tracking-tight dark:text-white">
            Login below
        </h1>
        <LoginForm />
    </AuthLayout>
</template>