<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import axios from 'axios';

interface User {
    id: number;
    name: string;
    // добавьте другие поля по необходимости
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Чаты',
        href: '/dashboard',
    },
];

const users = ref<User[]>([]);
const isLoading = ref(false);
const error = ref<string | null>(null);

const fetchUsers = async () => {
    isLoading.value = true;
    error.value = null;

    try {
        const response = await axios.get('/users');
        users.value = response.data;
    } catch (err) {
        console.error('Ошибка при загрузке пользователей:', err);
        error.value = 'Не удалось загрузить список пользователей';
    } finally {
        isLoading.value = false;
    }
};

onMounted(() => {
    fetchUsers();
});
</script>

<template>
    <Head title="Чаты" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div>
                <h2 class="text-xl font-semibold mb-4">Список пользователей</h2>

                <div v-if="isLoading" class="text-center py-4">
                    Загрузка...
                </div>

                <div v-else-if="error" class="text-red-500 py-4">
                    {{ error }}
                </div>

                <ul v-else class="space-y-2">
                    <li
                        v-for="user in users"
                        :key="user.id"
                        class="p-3  rounded transition-colors"
                    >
                        {{ user.name }}
                    </li>
                </ul>
            </div>
        </div>
    </AppLayout>
</template>
