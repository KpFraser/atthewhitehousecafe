<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import LoginLogo from '@/Components/LoginLogo.vue';
import MasterHeader from '@/Components/MasterHeader.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import MasterFooter from '@/Components/MasterFooter.vue';
</script>

<template>
    <BreezeAuthenticatedLayout>
        <div class="flex justify-center items-center max-w-lg mx-auto font-serif">
            <div class="w-full mb-20 justify-center">
                <MasterHeader/>
                <div class="h-fit flex justify-center text-[30px]">
                    <div class="w-full">
                        <Link :href="route('security')" class="flex my-16 items-center justify-start space-x-6 ml-10">
                            <LoginLogo class="max-h-10"/>
                            <div>Security</div>
                        </Link>
                        <Link :href="route('personal')" class="flex my-16 items-center justify-start space-x-6 ml-10">
                            <LoginLogo class="max-h-10"/>
                            <div>Personal</div>
                        </Link>
                        <Link :href="route('healthcare')" class="flex my-16 items-center justify-start space-x-6 ml-10">
                            <LoginLogo class="max-h-10"/>
                            <div>Healthcare</div>
                        </Link> 
                    </div>
                </div>
            </div>
            <MasterFooter/>
        </div> 
    </BreezeAuthenticatedLayout>
</template>
