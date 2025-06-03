<script setup lang="ts">
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { Link } from '@inertiajs/vue3';

interface User {
    id: number;
    name: string;
}

const props = defineProps<{
    initialUsers?: User[]; // опциональные начальные данные
}>();

const users = ref<User[]>(props.initialUsers || []);
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

// Если initialUsers не переданы, загружаем данные
onMounted(() => {
    if (!props.initialUsers?.length) {
        fetchUsers();
    }
});

// Экспортируем методы, если нужно использовать их из родителя
defineExpose({
    fetchUsers,
});
</script>

<template>
    <div>
        <div v-if="isLoading" class="text-center py-4">
            Загрузка...
        </div>

        <div v-else-if="error" class="text-red-500 py-4">
            {{ error }}
        </div>

        <ul v-else class="space-y-2">


            <Link
                v-for="user in users"
                :key="user.id"
                class="p-3 rounded transition-colors"
                :href="`/chats/${user.id}`"
            >
                {{ user.name }}
            </Link>

        </ul>
    </div>
</template>
