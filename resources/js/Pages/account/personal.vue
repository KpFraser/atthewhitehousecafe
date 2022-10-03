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
import commonFunctions from "@/use/common";

const { Toast } = commonFunctions()

const { footerLists } = useFooterList(),
    personal = ref({}),
    validationErrors = ref({})

const validation = (post) =>{

    if(!post.name)
        validationErrors.value.name = ['* Required field!']
    if(!post.address)
        validationErrors.value.address = ['* Required field!']
    if(!post.phone_number)
        validationErrors.value.phone_number = ['* Required field!']
    if(!post.postcode)
        validationErrors.value.postcode = ['* Required field!']

    return Object.values(validationErrors.value).length === 0;
}
const personalInfo = (post) =>{
    if(personal.value.approve) return
    personal.value.approve = true

    let validation_detail = validation (post)
    if(validation_detail === true){
        axios
            .post('/personal', personal.value)
            .then((response)=>{
            if(response.data.success === true)
                Toast.fire({icon: "success",title: "Personal Information updated successfully!"})
            })
            .finally(()=> personal.value.approve = false)
    }
}

const showInfo = () => {
    axios.get('/showInfo').then((response)=>{
            personal.value.name = response.data.data.name ? response.data.data.name: ''
            personal.value.address = !!response.data.data.address ? response.data.data.address: ''
            personal.value.phone_number = !!response.data.data.phone_number ? response.data.data.phone_number: ''
            personal.value.postcode = !!response.data.data.postcode ? response.data.data.postcode: ''
    })
}

onMounted( ()=> {
    showInfo ()
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
                        <Link :href="route('dashboard')" class="text-[25px] bg-[#639f1e] px-1 text-center font-bold bg-opacity-75">X</Link>
                    </div>
                    <div class="flex items-center">
                        <BreezeLabel value="Name" />
                        <div v-if="!personal.name" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.name">{{ message }}</div>
                    </div>
                    <BreezeInput @focusout="delete validationErrors['name']" v-model="personal.name" />
                    <div class="flex items-center">
                        <BreezeLabel value="Phone Number" />
                        <div v-if="!personal.phone_number" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.phone_number">{{ message }}</div>
                    </div>
                    <BreezeInput @focusout="delete validationErrors['phone_number']"  v-model="personal.phone_number" />
                    <div class="flex items-center">
                        <BreezeLabel value="Address" />
                        <div v-if="!personal.address" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.address">{{ message }}</div>
                    </div>
                    <BreezeInput @focusout="delete validationErrors['address']" v-model="personal.address" />
                    <div class="flex items-center">
                        <BreezeLabel value="Post Code" />
                        <div v-if="!personal.postcode" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.postcode">{{ message }}</div>
                    </div>
                    <BreezeInput @focusout="delete validationErrors['postcode']" v-model="personal.postcode" />
                    <div class="flex items-center justify-end mt-4">
                        <BreezeButton @click="personalInfo(personal)" type="button" class="bg-[#639f1e] text-white w-full font-sans submit mx-auto py-3 justify-center text-[25px] font-bold" :class="{ 'opacity-25': personal.approve }" :disabled="personal.approve">
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
