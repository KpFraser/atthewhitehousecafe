<script setup>
import LoginLogo from '@/Components/LoginLogo.vue';
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <div class="mx-auto max-w-lg rounded-br-[6.5rem] bg-[#20351d] font-serif py-20 bg-opacity-75 max-h-28 flex items-center justify-between">
        <div class="text-white ml-10">
            <div class="text-[25px]">{{ $page.props.auth.user === null ? "vistor": $page.props.auth.user?.name}}</div>
            <div class="text-[16px]">{{ $page.props.auth.user === null ? "none@e-mail.com": $page.props.auth.user?.email }}</div>
            <Link :href="route('logout')" class="font-medium text-white hover:text-[#639f1e] !0px-0" method="post" as="button">
                Log Out
            </Link>
        </div>
        <div class="mr-5 sm:mr-16">
            <Link :href="route('logo')">
                <LoginLogo class="max-h-24 w-full"/>
            </Link>
        </div>
    </div>
</template>
