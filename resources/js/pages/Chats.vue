<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import UsersList from './chat/UserList.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Чаты',
        href: '/dashboard',
    },
];
</script>

<template>
    <Head title="Чаты" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div>
                <h2 class="text-xl font-semibold mb-4">Список пользователей</h2>
                <UsersList />
            </div>
        </div>
    </AppLayout>
</template>
