<template>
    <AuthenticatedLayout>
        <template #header>
            <h1>Announcement Page</h1>
        </template>

        <p>This is an Announcement Page</p>
    </AuthenticatedLayout>
</template>

<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { useHead } from '@vueuse/head'

    useHead({
        title: 'Announcement',
    });
</script>