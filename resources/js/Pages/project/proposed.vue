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
            <div class="w-full justify-center">
                <MasterHeader/>
                <form class="text-black mt-10 mb-28 space-y-4 bg-white text-lg mx-10">
                    <div class="flex justify-end mr-4">
                        <Link :href="route('projectshome')" class="text-[25px] bg-[#639f1e] px-1 text-center font-bold bg-opacity-75">X</Link>
                    </div>
                    <div class="flex items-center">
                        <BreezeLabel value="Name" />
                        <!-- <div v-if="!personal.name" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.name">{{ message }}</div> -->
                    </div>
                    <BreezeInput />
                    <div class="flex items-center">
                        <BreezeLabel value="Possible Location" />
                        <!-- <div v-if="!personal.phone_number" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.phone_number">{{ message }}</div> -->
                    </div>
                    <BreezeInput />
                    <div class="flex items-center">
                        <BreezeLabel value="Frequency" />
                        <!-- <div v-if="!personal.address" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.address">{{ message }}</div> -->
                    </div>
                    <BreezeInput />
                    <div class="flex items-center">
                        <BreezeLabel value="Requirements" />
                        <!-- <div v-if="!personal.postcode" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.postcode">{{ message }}</div> -->
                    </div>
                    <BreezeInput />
                    <div class="flex items-center">
                        <BreezeLabel value="Leadership" />
                        <!-- <div v-if="!personal.postcode" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.postcode">{{ message }}</div> -->
                    </div>
                    <BreezeInput />
                    <BreezeButton class="bg-opacity-75 mt-4 bg-[#639f1e] text-white w-full font-sans submit mx-auto py-3 justify-center text-[25px] font-bold">
                        Update
                    </BreezeButton>
                    <Link class="inline-flex items-center font-bold transition ease-in-out duration-150 bg-opacity-75 mt-4 bg-[#639f1e] text-white w-full font-sans submit mx-auto py-3 justify-center text-[25px]">
                        Approved
                    </Link>
                </form>
            </div>
            <MasterFooter
                :footerLists="footerLists"
            />
        </div>
    </BreezeAuthenticatedLayout>
</template>
