<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import MasterFooter from '@/Components/MasterFooter.vue';
import useFooterList from "../../../use/useFooterList";
import { Link } from '@inertiajs/inertia-vue3';
import {ref, onMounted } from "vue";
import LoginLogo from '@/Components/LoginLogo.vue';
import commonFunctions from "@/use/common";
import axios from "axios";

const { Toast } = commonFunctions(),
    { footerLists } = useFooterList()

const information = ref ({}),
    role = ref ({}),
    project = ref ({}),
    validationErrors = ref ({})

const validation = (info) =>{
    validationErrors.value = {}
    if(info.project_id === 0 || info.role_id === 0)
        validationErrors.value.selectOption = ['* Select Project and Role !']
    if(!info.name)
        validationErrors.value.name = ['* Required field!']
    if(!info.first_txt)
        validationErrors.value.first_txt = ['* Required field!']
    if(!info.second_txt)
        validationErrors.value.second_txt = ['* Required field!']
    if(!info.third_txt)
        validationErrors.value.third_txt = ['* Required field!']
    if(!info.email)
        validationErrors.value.email = ['* Required field!']
    if(!info.ref_one)
        validationErrors.value.ref_one = ['* Required field!']

    return Object.values(validationErrors.value).length === 0;
}

const submitInfo = (info) => {

    let validation_detail = validation (info)
    if(validation_detail === true) {
        if (information.value.approve) return
        information.value.approve = true
        axios
            .post('/application-info', information.value)
            .then((response) => {
                if (response.data.success === true) {
                    Toast.fire({icon: "success", title: "Information Submitted successfully!"})
                }
            })
            .finally(() => {
                information.value = { name: '', first_txt: '', second_txt: '', third_txt: '', email: '', ref_one: '', ref_two: '', approve: false }
            })
    } else {
        information.value.approve = false
    }
}

const showInformation = () =>{
    axios
        .get('/project-roles').then((response)=>{
            if(response.data.success){
                project.value = response.data.data[0]
                role.value = response.data.data[1]
            }
    })
}

onMounted( ()=> {
    information.value.project_id = 0
    information.value.role_id = 0
    showInformation ()
})

</script>

<template>
    <!-- <Head title="Dashboard" /> -->
    <BreezeAuthenticatedLayout>
        <div class="flex justify-center bg-white items-center max-w-lg mx-auto font-serif">
            <div class="w-full justify-center">
                <div class="mx-auto max-w-lg rounded-br-[6.5rem] bg-[#20351d] font-serif py-20 bg-opacity-75 max-h-28 flex items-center ">
                    <LoginLogo class="max-h-24 mx-2 w-1/3"/>
                    <div>
                        <div class="flex items-center">
                            <div class="block space-y-2">
                                <div class="text-[20px] text-white inline-block">Application For:</div>
                                <div class="text-[20px] text-white inline-block">Select Role:</div>
                            </div>
                            <div class="block space-y-2">
                                <select v-model="information.project_id" class="bg-transparent w-32 text-white border-white py-1 focus:border-0 ml-4 focus:ring-0 text-[16px]">
                                    <option class="text-[20px] text-black" value="0" disabled hidden>Project</option>
                                    <option class="text-[18px] text-black" v-for="name in project" v-if="!!project" :value="name.id">{{ name.name }}</option>
                                </select>
                                <select v-model="information.role_id" class="bg-transparent w-32 text-white border-white py-1 focus:border-0 ml-4 focus:ring-0 text-[16px]">
                                    <option class="text-[20px] text-black" value="0" disabled hidden>Role</option>
                                    <option class="text-[18px] text-black" v-for="name in role" v-if="!!role" :value="name.id">{{ name.name }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="!information.project_id || !information.role_id" class="mt-2 text-center text-red-700 font-bold text-sm" v-for="message in  validationErrors.selectOption">{{ message }}</div>
                <form class="text-black mt-10 mb-28 space-y-4 bg-white text-lg mx-10">
                    <div class="flex justify-end mr-4">
                        <Link :href="route('plan')" class="text-[25px] bg-[#639f1e] py-1 px-3 text-center font-bold bg-opacity-75">
                            <i class="text-[40px] hover:text-red-700 fal fa-times"></i>
                        </Link>
                    </div>
                    <div class=" ">
                        <div class="flex items-center">
                            <BreezeLabel value="1. What is your name ?" />
                            <div v-if="!information.name" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.name">{{ message }}</div>
                        </div>
                        <BreezeInput v-model="information.name" type="text"/>
                    </div>
                    <div>
                        <div class="flex items-center">
                            <BreezeLabel value="2. What do you do for fun ?" />
                            <div v-if="!information.first_txt" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.first_txt">{{ message }}</div>
                        </div>
                        <textarea v-model="information.first_txt" class="focus:ring-[#639f1e] border-none focus:border-[#639f1e] w-full h-28 bg-[#639f1e] bg-opacity-75"></textarea>
                    </div>
                    <div>
                        <div class="flex items-center">
                            <BreezeLabel value="3. Why do you want this role ?" />
                            <div v-if="!information.second_txt" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.second_txt">{{ message }}</div>
                        </div>
                        <textarea v-model="information.second_txt" class="focus:ring-[#639f1e] border-none focus:border-[#639f1e] w-full h-28 bg-[#639f1e] bg-opacity-75"></textarea>
                    </div>
                    <div>
                        <div class="flex items-center">
                            <BreezeLabel value="4. What experience do you have ?" />
                            <div v-if="!information.third_txt" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.third_txt">{{ message }}</div>
                        </div>
                        <textarea v-model="information.third_txt" class="focus:ring-[#639f1e] border-none focus:border-[#639f1e] w-full h-28 bg-[#639f1e] bg-opacity-75"></textarea>
                    </div>
                    <div>
                        <div class="flex items-center">
                            <BreezeLabel value="Your Email" />
                            <div v-if="!information.email" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.email">{{ message }}</div>
                        </div>
                        <BreezeInput v-model="information.email" type="email"/>
                    </div>
                    <div>
                        <div class="flex items-center">
                            <BreezeLabel value="Reference 1 Email" />
                            <div v-if="!information.ref_one" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.ref_one">{{ message }}</div>
                        </div>
                        <BreezeInput v-model="information.ref_one" type="email"/>
                    </div>
                    <div>
                        <BreezeLabel value="Reference 2 Email" />
                        <BreezeInput v-model="information.ref_two" type="email"/>
                    </div>
                    <button type="button" @click="submitInfo(information)" class="inline-flex items-center font-bold transition ease-in-out duration-150 bg-opacity-75 mt-4 bg-[#639f1e] text-white w-full font-sans submit mx-auto py-3 justify-center text-[25px]" :class="{ 'opacity-25': information.approve }" :disabled="information.approve">
                        Submit
                    </button>
                </form>
            </div>
            <MasterFooter
                :footerLists="footerLists"
            />
        </div>
    </BreezeAuthenticatedLayout>
</template>
