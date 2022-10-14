<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import MasterFooter from '@/Components/MasterFooter.vue';
import MasterHeader from '@/Components/MasterHeader.vue';
import useFooterList from "../../../use/useFooterList";
import {ref, onMounted } from "vue";
import { Link } from '@inertiajs/inertia-vue3';
import commonFunctions from "@/use/common";

const { Toast } = commonFunctions(),
    { footerLists } = useFooterList()

const names = ref([])

const unArchieved = (id) =>{
    axios
        .post('/un-archieve', {id: id})
        .then((response)=>{
            Toast.fire({icon: "success", title: "Added to Archieved!"})
            archieved ()
        })
}

const archieved = () =>{
    axios
        .get('/archieve-project')
        .then((response)=>{
            names.value = response.data
        })
}

onMounted( ()=> {
    archieved ()
})
</script>

<template>
    <!-- <Head title="Dashboard" /> -->
    <BreezeAuthenticatedLayout>
        <div class="flex justify-center bg-white items-center max-w-lg mx-auto font-serif">
            <div class="w-full">
                <MasterHeader/>
                <div class="flex justify-end my-6 mr-4">
                    <Link :href="route('projectshome')" class="text-[25px] bg-[#639f1e] p-1 text-center font-bold bg-opacity-75">
                        <i class="fas fa-home"></i>
                    </Link>
                </div>
                <div class="text-black border-4 border-[#20351d] mx-10 border-opacity-75 mt-10 mb-28 space-y-4 bg-white text-lg">
                    <div class="w-full p-2 text-white bg-[#20351d] bg-opacity-75 text-center">
                        Archieved
                    </div>
                    <div class="bg-white items-center max-w-lg mx-auto">
                        <div class="flex p-1 my-3 mx-2 justify-between bg-[#639f1e] items-center" v-for="name in names">
                            <div class="ml-5 text-white font-extrabold">{{name.name}}</div>
                            <i class="fas mr-2 text-[30px] fa-save cursor-pointer" @click="unArchieved(name.id)"></i>
                        </div>
                        <div v-if="names.length === 0" class="bg-white pb-3 text-center">Empty!</div>
                    </div>
                </div>
            </div>
            <MasterFooter
                :footerLists="footerLists"
            />
        </div>
    </BreezeAuthenticatedLayout>
</template>
