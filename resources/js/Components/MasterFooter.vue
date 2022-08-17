<script setup>
import { Link } from '@inertiajs/inertia-vue3';
const props = defineProps({
        footerLists: {
            Type: Object,
            required: true
        }
    })
</script>
<template>
    <footer class="fixed w-full bottom-0">
        <div class="grid mx-auto text-[13.5px] sm:text-[20px] justify-center max-w-lg bg-white py-4 border border-black grid-cols-4">
            <div class="text-center text-[#639f1e] hover:text-green-600" v-for="footer in footerLists">
                <Link :href="route(footer.to)">
                    <i :class="`mx-auto fa-2x ${footer.class}`"></i>
                <div class="text-center">{{ footer.label }}</div>
                </Link>
            </div>
        </div>
    </footer>
</template>
