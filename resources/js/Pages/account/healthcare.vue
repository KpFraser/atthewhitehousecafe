<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import MasterFooter from '@/Components/MasterFooter.vue';
import MasterHeader from '@/Components/MasterHeader.vue';
import BreezeButton from '@/Components/Button.vue';
import useFooterList from "../../../use/useFooterList";
import {ref, onMounted, reactive } from "vue";
import commonFunctions from "@/use/common";
import axios from 'axios';
import { Link } from '@inertiajs/inertia-vue3';

const { Toast } = commonFunctions()

const { footerLists } = useFooterList()
const health = reactive ({})
const validationErrors = ref({})

const validation = (post) =>{

    if(!post.emergency_name)
        validationErrors.value.emergency_name = ['* Required feild!']
    if(!post.emergency_contact)
        validationErrors.value.emergency_contact = ['* Required feild!']
    if(!post.dr_name)
        validationErrors.value.dr_name = ['* Required feild!']
    if(!post.dr_contact)
        validationErrors.value.dr_contact = ['* Required feild!']

    return Object.values(validationErrors.value).length === 0;
}

const healthInfo = (post) => {
    if(health.processing) return;

    health.processing = true;
    let validation_detail = validation (post)
    if(validation_detail === true){
        axios
            .post('/healthcare', health)
            .then((response)=>{
                if (response.data.success)
                    Toast.fire({icon: "success", title: "Healthcare Information updated successfully!"});
            })
            .finally(()=>{
                health.processing = false;
            })
    }
}
const showHealthInfo = () => {
    axios
        .get('/healthcareInfo').then((response)=>{
            if(response.data.success){
                health.emergency_name= response.data.data.emergency_name ? response.data.data.emergency_name: ''
                health.emergency_contact = !!response.data.data.emergency_contact ? response.data.data.emergency_contact: ''
                health.dr_name = !!response.data.data.dr_name ? response.data.data.dr_name: ''
                health.dr_contact = !!response.data.data.dr_contact ? response.data.data.dr_contact: ''
            } else if (response.status !== 204){
                validationErrors.value.mainError = ['Something went wrong try again later!']
            }
        })
}
onMounted( ()=>{
    showHealthInfo()
})
</script>

<template>
    <!-- <Head title="Dashboard" /> -->
    <BreezeAuthenticatedLayout>
        <div class="flex justify-center bg-white items-center max-w-lg mx-auto font-serif">
            <div class="w-full justify-center">
                <MasterHeader/>
                <form class="text-black mt-10 mb-28 space-y-4 bg-white text-[22px] mx-10"  @submit.prevent="healthInfo(health)">
                    <div class="flex justify-end mr-4">
                        <Link :href="route('dashboard')" class="text-[25px] bg-[#639f1e] px-1 text-center font-bold bg-opacity-75">X</Link>
                    </div>
                    <div v-if="validationErrors.length !== 0" class="text-red-700 font-bold text-sm" v-for="message in  validationErrors.mainError">{{ message }}</div>
                    <div class="flex items-center">
                        <BreezeLabel value="Emergency Contact Name" />
                        <div v-if="!health.emergency_name" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.emergency_name">{{ message }}</div>
                    </div>
                    <BreezeInput @focusout="delete validationErrors['emergency_name']" v-model="health.emergency_name"/>
                    <div class="flex items-center">
                        <BreezeLabel value="Emergency Contact Number" />
                        <div v-if="!health.emergency_contact" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.emergency_contact">{{ message }}</div>
                    </div>
                    <BreezeInput @focusout="delete validationErrors['emergency_contact']" v-model="health.emergency_contact"/>
                    <div class="flex items-center">
                        <BreezeLabel value="Dr Name" />
                        <div v-if="!health.dr_name" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.dr_name">{{ message }}</div>
                    </div>
                    <BreezeInput @focusout="delete validationErrors['dr_name']" v-model="health.dr_name"/>
                    <div class="flex items-center">
                        <BreezeLabel value="Dr Number" />
                        <div v-if="!health.dr_contact" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.dr_contact">{{ message }}</div>
                    </div>
                    <BreezeInput @focusout="delete validationErrors['dr_contact']" v-model="health.dr_contact"/>
                    <div class="flex items-center justify-end mt-4">
                        <BreezeButton class="bg-[#639f1e] text-white w-full font-sans submit mx-auto py-3 justify-center text-[25px] font-bold" :class="{ 'opacity-25': health.processing }" :disabled="health.processing">
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
<!--:class="{ 'hidden' : textVal[name.id] }-->
<!--display.value[id] = false-->
