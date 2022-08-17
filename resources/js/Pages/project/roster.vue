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
                <form class="text-black border-4 border-b-4 p-10 border-[#20351d] border-opacity-75 mt-10 mb-28 space-y-4 bg-white text-lg">
                    <div class="flex justify-end">
                        <Link :href="route('projectshome')" class="text-[25px] bg-[#639f1e] p-1 text-center font-bold bg-opacity-75">
                            <i class="fas fa-home"></i>
                        </Link>
                    </div>
                    <div class="flex justify-between">
                        <div class="p-4 bg-opacity-75 bg-[#639f1e]">Date</div>
                        <div class="p-4 bg-opacity-75 bg-[#639f1e]">Start Time</div>
                        <div class="p-4 bg-opacity-75 bg-[#639f1e]">End Time</div>
                    </div>
                    <BreezeLabel value="Roster"/>
                    <div class="bg-[#639f1e] py-5 bg-opacity-75">
                        <div class="flex items-center justify-between mx-5">
                            <input type="radio" name="project" class="text-[#639f1e] bg-[#cccccc] focus:ring-[#639f1e] transition ease-in-out">
                            <BreezeLabel class="ml-5" value="Project 1"/>
                            <i class="far fa-pen"></i>
                        </div>
                        <div class="flex items-center justify-between mx-5">
                            <input type="radio" name="project" class="text-[#639f1e] bg-[#cccccc] focus:ring-[#639f1e] transition ease-in-out">
                            <BreezeLabel class="ml-5" value="Project 2"/>
                            <i class="far fa-pen"></i>
                        </div> 
                        <div class="flex items-center justify-between mx-5">
                            <input type="radio" name="project" class="text-[#639f1e] bg-[#cccccc] focus:ring-[#639f1e] transition ease-in-out">
                            <BreezeLabel class="ml-5" value="Project 3"/>
                            <i class="far fa-pen"></i>
                        </div> 
                        <div class="flex items-center justify-between mx-5">
                            <input type="radio" name="project" class="text-[#639f1e] bg-[#cccccc] focus:ring-[#639f1e] transition ease-in-out">
                            <BreezeLabel class="ml-5" value="Project 4"/>
                            <i class="far fa-pen"></i>
                        </div> 
                        <div class="flex items-center justify-between mx-5">
                            <input type="radio" name="project" class="text-[#639f1e] bg-[#cccccc] focus:ring-[#639f1e] transition ease-in-out">
                            <BreezeLabel class="ml-5" value="Project 5"/>
                            <i class="far fa-pen"></i>
                        </div> 
                        <div class="flex items-center justify-between mx-5">
                            <input type="radio" name="project" class="text-[#639f1e] bg-[#cccccc] focus:ring-[#639f1e] transition ease-in-out">
                            <BreezeLabel class="ml-5" value="Project 6"/>
                            <i class="far fa-pen"></i>
                        </div>
                    </div>
                    <BreezeLabel value="Group Comment"/>
                    <textarea class="w-full h-28 bg-opacity-75 bg-[#639f1e]"></textarea>
                    <BreezeButton class="bg-opacity-75 px-10 mt-4 bg-[#639f1e] text-white w-full font-sans submit py-3 justify-center text-[25px] font-bold">
                        Save
                    </BreezeButton>
                </form>
            </div>
            <MasterFooter
                :footerLists="footerLists"
            />
        </div>
    </BreezeAuthenticatedLayout>
</template>
