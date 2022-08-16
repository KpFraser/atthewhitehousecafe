<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import MasterFooter from '@/Components/MasterFooter.vue';
import MasterHeader from '@/Components/MasterHeader.vue';
import BreezeButton from '@/Components/Button.vue';
import useFooterList from "../../../use/useFooterList";
import { Head, Link } from '@inertiajs/inertia-vue3';
import {ref, onMounted, reactive } from "vue";
 
const { footerLists } = useFooterList()

</script>

<template>
    <!-- <Head title="Dashboard" /> -->
    <BreezeAuthenticatedLayout>
        <div class="flex justify-center bg-white items-center max-w-lg mx-auto font-serif">
            <div class="w-full">
                <MasterHeader/>
                <form class="text-black border-4 border-b-4 border-[#20351d] mx-10 border-opacity-75 pb-5 mt-10 mb-28 space-y-4 bg-white text-lg">
                    <div class="flex border-opacity-75 border-[#20351d] border-b-4 justify-between">
                        <button class="text-center border-opacity-75 border-[#20351d] bg-opacity-75 text-white font-bold bg-[#20351d] border-r-4 py-2 w-1/2">All</button>
                        <button class="text-center py-2 font-bold w-1/2">User</button>
                    </div>
                    <div class="flex justify-end mr-4">
                        <Link :href="route('projectshome')" class="text-[25px] bg-[#639f1e] p-1 text-center font-bold bg-opacity-75">
                            <i class="fas fa-home"></i>
                        </Link>
                    </div>
                    <div class="flex items-center">
                        <BreezeLabel class="ml-5" value="Project 1"/><i class="fas ml-5 fa-2x rotate-45 fa-key-skeleton"></i>
                    </div>
                    <input type="file" class="border-[#639f1e] mx-auto !mt-0 !pt-0 flex justify-center focus:ring-[#639f1e] focus:border-[#639f1e] border-opacity-75 border-2"/>
                    <div class="flex items-center">
                        <BreezeLabel class="ml-5" value="Project 2"/>
                    </div>
                    <input type="file" class="border-[#639f1e] mx-auto !mt-0 !pt-0 flex justify-center focus:ring-[#639f1e] focus:border-[#639f1e] border-opacity-75 border-2"/>
                    <div class="flex items-center">
                        <BreezeLabel class="ml-5" value="Project 3"/>
                    </div>
                    <input type="file" class="border-[#639f1e] mx-auto !mt-0 !pt-0 flex justify-center focus:ring-[#639f1e] focus:border-[#639f1e] border-opacity-75 border-2"/>
                     <div class="flex items-center">
                        <BreezeLabel class="ml-5" value="Project 4"/>
                    </div>
                    <input type="file" class="border-[#639f1e] mx-auto !mt-0 !pt-0 flex justify-center focus:ring-[#639f1e] focus:border-[#639f1e] border-opacity-75 border-2"/>
                </form>
                <form class="text-black border-4 border-b-4 border-[#20351d] mx-10 border-opacity-75 pb-5 mt-10 mb-28 space-y-4 bg-white text-lg">
                    <div class="flex border-opacity-75 border-[#20351d] border-b-4 justify-between">
                        <button class="text-center border-opacity-75 border-[#20351d] font-bold border-r-4 py-2 w-1/2">All</button>
                        <button class="text-center py-2 w-1/2  bg-opacity-75 text-white font-bold bg-[#20351d]">User</button>
                    </div>
                    <div class="flex justify-end mr-4">
                        <Link :href="route('projectshome')" class="text-[25px] bg-[#639f1e] p-1 text-center font-bold bg-opacity-75">
                            <i class="fas fa-home"></i>
                        </Link>
                    </div>
                    <div class="flex items-center">
                        <BreezeLabel class="ml-5" value="Project 1"/>
                    </div>
                    <input type="file" class="border-[#639f1e] mx-auto !mt-0 !pt-0 flex justify-center focus:ring-[#639f1e] focus:border-[#639f1e] border-opacity-75 border-2"/>
                    <div class="flex items-center">
                        <BreezeLabel class="ml-5" value="Project 2"/>
                    </div>
                    <input type="file" class="border-[#639f1e] mx-auto !mt-0 !pt-0 flex justify-center focus:ring-[#639f1e] focus:border-[#639f1e] border-opacity-75 border-2"/>
                    <div class="flex items-center">
                        <BreezeLabel class="ml-5" value="Project 3"/>
                    </div>
                    <input type="file" class="border-[#639f1e] mx-auto !mt-0 !pt-0 flex justify-center focus:ring-[#639f1e] focus:border-[#639f1e] border-opacity-75 border-2"/>
                     <div class="flex items-center">
                        <BreezeLabel class="ml-5" value="Project 4"/>
                    </div>
                    <input type="file" class="border-[#639f1e] mx-auto !mt-0 !pt-0 flex justify-center focus:ring-[#639f1e] focus:border-[#639f1e] border-opacity-75 border-2"/>
                </form>
            </div>
            <MasterFooter
                :footerLists="footerLists"
            />
        </div>
    </BreezeAuthenticatedLayout>
</template>
