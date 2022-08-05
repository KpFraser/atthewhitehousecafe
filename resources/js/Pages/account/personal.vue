<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import MasterFooter from '@/Components/MasterFooter.vue';
import MasterHeader from '@/Components/MasterHeader.vue';
import BreezeButton from '@/Components/Button.vue';
import useFooterList from "../../../use/useFooterList";

const { footerLists } = useFooterList()
</script>

<template>
    <!-- <Head title="Dashboard" /> -->
    <BreezeAuthenticatedLayout>
        <div class="flex justify-center bg-white items-center max-w-lg mx-auto font-serif">
            <div class="w-full justify-center">
                <MasterHeader/>
                <form class="text-black mt-10 mb-28 space-y-4 bg-white text-[22px] mx-10">
                    <div class="flex justify-end mr-4">
                        <div class="text-[25px] bg-[#639f1e] w-10 h-10 text-center font-bold bg-opacity-75 ">X</div>
                    </div>
                    <BreezeLabel value="Name" />
                    <BreezeInput />
                    <BreezeLabel value="Phone Number" />
                    <BreezeInput />
                    <BreezeLabel value="Address" />
                    <BreezeInput />
                    <BreezeLabel value="Post Code" />
                    <BreezeInput />
                    <div class="flex items-center justify-end mt-4">
                        <BreezeButton class="bg-[#639f1e] text-white w-full font-sans submit mx-auto py-3 justify-center text-[25px] font-bold">
                            Save
                        </BreezeButton>
                    </div>
                </form>
            </div>
            <MasterFooter
                :footerLists="footerLists"
            />
        </div>
    </BreezeAuthenticatedLayout>
</template>
