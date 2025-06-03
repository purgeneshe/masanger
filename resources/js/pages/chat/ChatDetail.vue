<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    user: Array // Тип соответствует тому, что вы передали (123 - число)
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: `Чат с ${props.user.name}`,
        href: '/dashboard',
    },
];


</script>

<template>
    <Head title="Чаты" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div>
                <h2 class="text-xl font-semibold mb-4">{{ user.name }}</h2>
            </div>
        </div>
    </AppLayout>
</template>
