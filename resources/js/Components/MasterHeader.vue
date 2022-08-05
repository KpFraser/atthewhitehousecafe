<script setup>
import LoginLogo from '@/Components/LoginLogo.vue';
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
</script>

<template>
<div class="mx-auto max-w-lg rounded-br-[6.5rem] bg-[#20351d] font-serif py-20 bg-opacity-75 max-h-28 flex items-center justify-between">
    <div class="text-white ml-10">
        <div class="text-[25px]">{{ $page.props.auth.user.name }}</div>
        <div class="text-[16px]">{{ $page.props.auth.user.email }}</div>
        <BreezeResponsiveNavLink :href="route('logout')" class="text-white !0px-0" method="post" as="button">
            Log Out
        </BreezeResponsiveNavLink>
    </div>
    <LoginLogo class="max-h-24 mx-2 w-1/2"/>
</div>
</template>