<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import MasterFooter from '@/Components/MasterFooter.vue';
import MasterHeader from '@/Components/MasterHeader.vue';
import useFooterList from "../../../use/useFooterList";
import {ref, onMounted, reactive } from "vue";
import commonFunctions from "@/use/common";

const { Toast } = commonFunctions()
const { footerLists } = useFooterList()
const all_names = ref([])
const user_names = ref([])
const names = ref([])
const projects = () =>{
    axios
        .get('/projects')
        .then((response)=>{
            names.value = response.data
            all_names.value = names.value
                .filter(x => x.is_approved === 1 && x.is_archieved == 1)
                console.log(all_names.value)
        })
}

onMounted( ()=> {
    projects ()
})
</script>

<template>
    <!-- <Head title="Dashboard" /> -->
    <BreezeAuthenticatedLayout>
        <div class="flex justify-center bg-white items-center max-w-lg mx-auto font-serif">
            <div class="w-full">
                <MasterHeader/>
                <div class="text-black border-4 border-[#20351d] mx-10 border-opacity-75 mt-10 mb-28 space-y-4 bg-white text-lg">
                    <div class="w-full p-2 text-white bg-[#20351d] bg-opacity-75 text-center">
                        Archieved
                    </div>
                    <div class="bg-white items-center max-w-lg mx-auto">
                        <div class="flex p-1 my-3 mx-2 justify-between bg-[#639f1e] items-center" v-for="all in all_names">
                            <div class="ml-5 text-white font-extrabold">{{all.name}}</div>
                            <i class="fas mr-2 text-[30px] fa-save"></i>
                        </div>
                        <div v-if="all_names.length === 0" class="bg-white pb-3 text-center">Empty!</div>
                    </div>
                </div>
            </div>
            <MasterFooter
                :footerLists="footerLists"
            />
        </div>
    </BreezeAuthenticatedLayout>
</template>
