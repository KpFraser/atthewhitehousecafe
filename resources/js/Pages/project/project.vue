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
                        <Link :href="route('projectshome')" class="text-[25px] bg-[#639f1e] p-1 text-center font-bold bg-opacity-75">
                            <i class="fas fa-home"></i>
                        </Link>
                    </div>
                    <div class="flex items-center">
                        <BreezeLabel value="Name" />
                        <!-- <div v-if="!personal.name" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.name">{{ message }}</div> -->
                    </div>
                    <BreezeInput />
                    <div class="flex items-center">
                        <BreezeLabel value="Frequency" />
                        <!-- <div v-if="!personal.address" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.address">{{ message }}</div> -->
                    </div>
                    <BreezeInput />
                    <BreezeLabel value="Events" />
                    <div class="flex items-center">
                        <select class="w-full bg-opacity-75 hover:bg-opacity-75 focus:ring-[#639f1e] border-none focus:border-[#639f1e] hover:bg-[#639f1e] bg-[#639f1e]">
                          <option class="" value="">Event</option>  
                          <option class="" value="">Event1</option>  
                          <option class="" value="">Event2</option>  
                          <option class="" value="">Event3</option>  
                        </select>
                        <!-- <div v-if="!personal.postcode" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.postcode">{{ message }}</div> -->
                    </div>
                    <div class="flex items-center">
                        <BreezeLabel value="Roles" />
                        <!-- <div v-if="!personal.postcode" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.postcode">{{ message }}</div> -->
                    </div>
                    <textarea class="focus:ring-[#639f1e] border-none focus:border-[#639f1e] w-full h-28 bg-[#639f1e] bg-opacity-75"></textarea>
                    <div class="flex items-center">
                        <BreezeLabel value="Goles" />
                        <!-- <div v-if="!personal.postcode" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.postcode">{{ message }}</div> -->
                    </div>
                    <textarea class="focus:ring-[#639f1e] border-none focus:border-[#639f1e] w-full h-28 bg-[#639f1e] bg-opacity-75"></textarea>
                </form>
            </div>
            <MasterFooter
                :footerLists="footerLists"
            />
        </div>
    </BreezeAuthenticatedLayout>
</template>
