<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import CompanyLogo from '@/Components/Logo.vue';
import LoginLogo from '@/Components/LoginLogo.vue';
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

import { Head } from '@inertiajs/inertia-vue3';
</script>

<template>
    <!-- <Head title="Dashboard" /> -->
    <BreezeAuthenticatedLayout>
        <div class="flex justify-center items-center max-w-lg mx-auto font-serif">
            <div class="w-full mb-28 justify-center">
                <div class="mb-8 mx-auto max-w-lg rounded-br-[6.5rem] bg-[#20351d] font-serif py-20 bg-opacity-75 max-h-28 flex items-center justify-between">
                    <div class="text-white ml-10">
                        <div class="text-[25px]">{{ $page.props.auth.user.name }}</div>
                        <div class="text-[16px]">{{ $page.props.auth.user.email }}</div>
                        <BreezeResponsiveNavLink :href="route('logout')" class="text-white underline !0px-0" method="post" as="button">
                                Log Out
                        </BreezeResponsiveNavLink>
                    </div>
                    <LoginLogo class="max-h-24 w-1/2"/>
                </div>
                <div class="space-y-8 h-fit flex my-10 justify-center text-[30px]">
                    <div class="w-full">
                        <div class="flex my-10 items-center justify-start space-x-6 ml-10">   
                            <LoginLogo class="max-h-10"/>
                            <div>Security</div>
                        </div>
                        <div class="flex my-10 items-center justify-start space-x-6 ml-10">   
                            <LoginLogo class="max-h-10"/>
                            <div>Personal</div>
                        </div>
                        <div class="flex my-10 items-center justify-start space-x-6 ml-10">   
                            <LoginLogo class="max-h-10"/>
                            <div>Healthcare</div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="fixed w-full bottom-0">
                <div class="grid mx-auto text-[13.5px] sm:text-[20px] justify-center max-w-lg bg-white py-4 border border-black grid-cols-4">
                    <div class="text-center hover:text-[#639f1e] text-gray-900">
                        <i class="mx-auto fa-2x far fa-file-invoice"></i>
                        <div class="text-center">surveys</div>
                    </div>
                    <div class="text-center hover:text-[#639f1e] text-gray-900">
                        <i class="mx-auto fa-2x fal fa-lightbulb-on"></i>
                        <div class="text-center">projects</div>
                    </div>
                    <div class="text-center hover:text-[#639f1e] text-gray-900">
                        <i class="mx-auto fa-2x fal fa-user-friends"></i>
                        <div class="text-center">relationships</div>
                    </div>
                    <div class="text-center text-[#639f1e] hover:text-green-600">
                        <i class="mx-auto fa-2x fas fa-user-circle"></i>
                        <div class="text-center text-gray-700">accounts</div>
                    </div>
                </div>
            </footer>
        </div> 
    </BreezeAuthenticatedLayout>
</template>
