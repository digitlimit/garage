<script setup>
  import DefaultLayout from '@/Layouts/Default.vue';
  import PageTitle     from '@/Shared/Partials/PageTitle.vue';
  import router from "@/routes";

  const goHome = () => {
    router.push({name: 'landing.index'});
  };
</script>
<template>
  <DefaultLayout>
    <PageTitle title="Opps" subtitle="The page does not exists" />
    <section class="w-full"> 
        <button @click="goHome" class="inline-flex px-5 py-3 text-white bg-purple-600 hover:bg-purple-700 focus:bg-purple-700 rounded-md">
            Go Home
        </button>
    </section>
  </DefaultLayout>
</template>

