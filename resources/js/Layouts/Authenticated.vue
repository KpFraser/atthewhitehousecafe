<script setup>
import { ref } from 'vue';

const showingNavigationDropdown = ref(false);
</script>

<template>
        <div class="min-h-screen bg-gray-100">
            <main>
                <slot />
            </main>
        </div>
</template>
