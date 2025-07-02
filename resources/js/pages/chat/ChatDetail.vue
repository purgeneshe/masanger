<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import { ref, onMounted, watch } from 'vue';

const props = defineProps({
    user: Object
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: `Чат с ${props.user?.name}`,
        href: '/dashboard',
    },
];

const messages = ref([]);
const newMessage = ref('');
const isLoading = ref(false);
const error = ref(null);

const fetchMessages = async () => {
    isLoading.value = true;
    error.value = null;

    try {
        const response = await axios.get('/messages', {
            params: { user_id: props.user?.id }
        });
        messages.value = response.data;
    } catch (err) {
        console.error('Ошибка при загрузке сообщений:', err);
        error.value = 'Не удалось загрузить сообщения';
    } finally {
        isLoading.value = false;
    }
};

const sendMessage = async () => {
    if (!newMessage.value.trim()) return;

    try {
        const response = await axios.post('/messages', {
            receiver_id: props.user?.id,
            content: newMessage.value
        });

        messages.value.push(response.data);
        newMessage.value = '';
    } catch (err) {
        console.error('Ошибка при отправке сообщения:', err);
        error.value = 'Не удалось отправить сообщение';
    }
};




onMounted(fetchMessages);
</script>

<template>
    <Head title="Чаты" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div>
                <h2 class="text-xl font-semibold mb-4">{{ user?.name }}</h2>
            </div>

            <div class="flex-1 overflow-y-auto space-y-4">
                <div v-for="message in messages" :key="message.id" 
                     :class="['flex', message.sender_id === $page.props.auth.user.id ? 'justify-end' : 'justify-start']">
                    <div :class="['p-3 rounded-lg max-w-xs', 
                                message.sender_id === $page.props.auth.user.id ? 'bg-blue-500 text-white' : 'bg-purple-500']">
                        {{ message.content }}
                        <div class="text-xs mt-1 opacity-70">
                            {{ new Date(message.created_at).toLocaleTimeString() }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex gap-2">
                <input v-model="newMessage" @keyup.enter="sendMessage" 
                       class="flex-1 border rounded-lg p-2" placeholder="Введите сообщение...">
                <button @click="sendMessage" class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                    Отправить
                </button>
            </div>
        </div>
    </AppLayout>
</template>