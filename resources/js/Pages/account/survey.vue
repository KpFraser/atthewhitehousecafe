<script setup>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import BreezeLabel from '@/Components/Label.vue';
    import BreezeInput from '@/Components/Input.vue';
    import MasterFooter from '@/Components/MasterFooter.vue';
    import MasterHeader from '@/Components/MasterHeader.vue';
    import BreezeButton from '@/Components/Button.vue';
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import { ref, reactive } from 'vue';
    import axios from 'axios';
    import useFooterList from "../../../use/useFooterList";

    const { footerLists , avb } = useFooterList()
 
</script>

<template>
    <BreezeAuthenticatedLayout>
        <div class="flex justify-center bg-white items-center max-w-lg mx-auto font-serif">
            <div class="w-full justify-center">
                <MasterHeader/>
                 <div class="border-8 border-[#556553] border-opacity-75 mb-32 mt-5 mx-auto ">
                    <h1 class="bg-[#639f1e] bg-opacity-75 p-3">How might you engage with these projects-</h1>
                    <h1 class="text-center p-2">Never Participant Assistant Leader</h1>
                    <form class="p-4 space-y-4">
                        <div class="flex items-center">
                            <input type="checkbox" class="text-[#639f1e] focus:ring-[#639f1e] transition ease-in-out mr-2 p-2">
                            <BreezeLabel value="Canoeing"/>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" class="text-[#639f1e] focus:ring-[#639f1e] transition ease-in-out mr-2 p-2">
                            <BreezeLabel value="Morning Run"/> 
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" class="text-[#639f1e] focus:ring-[#639f1e] transition ease-in-out mr-2 p-2">
                            <BreezeLabel value="Track Runs"/> 
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" class="text-[#639f1e] focus:ring-[#639f1e] transition ease-in-out mr-2 p-2">
                            <BreezeLabel value="Frisbee"/>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" class="text-[#639f1e] focus:ring-[#639f1e] transition ease-in-out mr-2 p-2">
                            <BreezeLabel value="Lead Cycling"/> 
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" class="text-[#639f1e] focus:ring-[#639f1e] transition ease-in-out mr-2 p-2">
                            <BreezeLabel value="Lead Walks"/> 
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" class="text-[#639f1e] focus:ring-[#639f1e] transition ease-in-out mr-2 p-2">
                            <BreezeLabel value="Cooking"/>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" class="text-[#639f1e] focus:ring-[#639f1e] transition ease-in-out mr-2 p-2">
                            <BreezeLabel value="Gardening"/>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" class="text-[#639f1e] focus:ring-[#639f1e] transition ease-in-out mr-2 p-2">
                            <BreezeLabel value="Pickelball"/>
                        </div>
                    </form>
                    <h1 class="bg-[#639f1e] bg-opacity-75 py-3">If you would like us to contact you, please complete-</h1>
                    <form class="w-full p-2">
                        <div class="mb-6">
                            <BreezeLabel value="Name"/>
                            <BreezeInput/>
                        </div>
                        <div class="mb-6">
                            <BreezeLabel value="Phone Number"/>
                            <BreezeInput/>
                        </div>
                        <div class="mb-6">
                            <BreezeLabel value="Email"/>
                            <BreezeInput/>
                        </div>
                        <BreezeButton class="bg-opacity-75 mt-4 bg-[#639f1e] text-white w-full font-sans submit mx-auto py-3 justify-center text-[25px] font-bold">
                            Save
                        </BreezeButton>
                    </form>
                </div>
            </div>
            <MasterFooter
                :footerLists="footerLists"
            />
        </div>
    </BreezeAuthenticatedLayout>
</template>
