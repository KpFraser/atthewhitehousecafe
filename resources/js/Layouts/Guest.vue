<script setup>
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <div class="flex justify-center bg-gray-100">
        <!-- <div>
            <Link href="/">
                <BreezeApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
            </Link>
        </div> -->

        <div class="w-full max-w-lg bg-white overflow-hidden">
            <slot />
        </div>
    </div>
</template>
