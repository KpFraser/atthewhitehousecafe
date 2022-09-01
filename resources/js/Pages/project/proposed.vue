<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import MasterFooter from '@/Components/MasterFooter.vue';
import MasterHeader from '@/Components/MasterHeader.vue';
import useFooterList from "../../../use/useFooterList";
import { Head, Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import {ref, onMounted, reactive } from "vue";
import axios from "axios";
import commonFunctions from "@/use/common";

const { Toast } = commonFunctions()
const { footerLists } = useFooterList()
const information = ref({})

const projectInfo = () => {
    const queryString = window.location.href;
    let id = queryString.split('/')[4];
    axios
        .get('/new-projects/'+id)
        .then((response)=>{
            information.value= response.data.data
        })
}

const updateInfo = () =>{
    if(information.value.updating) return
    information.value.updating = true
    axios
        .post ('/update-project', information.value)
        .then((response)=>{
            if(response.data.success === true)
                Toast.fire({icon: "success",title: "Project updated successfully!"})
        })
        .finally(()=> information.value.updating = false)
}

const approveInfo = () =>{
    if(information.value.approving) return
    information.value.approving = true
    information.value.approve = 1
    axios
        .post ('/approve-project' , information.value)
        .then((response)=>{
            if(response.data.success === true) {
                Toast.fire({icon: "success", title: "Project approved successfully!"})
                Inertia.visit('/allproject')
            }
        })
        .finally(()=> information.value.approving = false)
}

onMounted( ()=> {
    projectInfo ()
})
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
                    <BreezeInput v-model="information.name"/>
                    <div class="flex items-center">
                        <BreezeLabel value="Possible Location" />
                        <!-- <div v-if="!personal.phone_number" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.phone_number">{{ message }}</div> -->
                    </div>
                    <BreezeInput v-model="information.location"/>
                    <div class="flex items-center">
                        <BreezeLabel value="Frequency" />
                        <!-- <div v-if="!personal.address" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.address">{{ message }}</div> -->
                    </div>
                    <BreezeInput v-model="information.frequency"/>
                    <div class="flex items-center">
                        <BreezeLabel value="Requirements" />
                        <!-- <div v-if="!personal.postcode" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.postcode">{{ message }}</div> -->
                    </div>
                    <BreezeInput v-model="information.requirements"/>
                    <div class="flex items-center">
                        <BreezeLabel value="Leadership" />
                        <!-- <div v-if="!personal.postcode" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.postcode">{{ message }}</div> -->
                    </div>
                    <BreezeInput v-model="information.leadership"/>
                    <button type="button" @click="updateInfo" class="inline-flex items-center font-bold transition ease-in-out duration-150 bg-opacity-75 mt-4 bg-[#639f1e] text-white w-full font-sans submit mx-auto py-3 justify-center text-[25px]" :class="{ 'opacity-25': information.updating }" :disabled="information.updating">
                        Update
                    </button>
                    <button type="button" @click="approveInfo" class="inline-flex items-center font-bold transition ease-in-out duration-150 bg-opacity-75 mt-4 bg-[#639f1e] text-white w-full font-sans submit mx-auto py-3 justify-center text-[25px]" :class="{ 'opacity-25': information.approving }" :disabled="information.approving">
                        Approved
                    </button>
                </form>
            </div>
            <MasterFooter
                :footerLists="footerLists"
            />
        </div>
    </BreezeAuthenticatedLayout>
</template>
