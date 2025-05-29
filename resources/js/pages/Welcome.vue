<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="authorize">
        <Link class="main-link" :href="route('login')">
            Есть аккаунт ?
        </Link>

        <Link class="main-link" :href="route('register')">
            Нет аккаунта ?
        </Link>
    </div>
</template>

<style>
:root {
    --main-hover-color: #ffcccc;
}

.authorize {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);

    display: flex;
    gap: 12px;
}

.main-link {
    font-size: 16px;
    transition: 0.3s;
}

.main-link:hover {
    color: var(--main-hover-color);
}
</style>

