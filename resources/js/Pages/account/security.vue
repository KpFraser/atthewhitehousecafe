<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import MasterFooter from '@/Components/MasterFooter.vue';
import MasterHeader from '@/Components/MasterHeader.vue';
import BreezeButton from '@/Components/Button.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { reactive, onMounted } from 'vue';
import axios from 'axios';
import useFooterList from "../../../use/useFooterList";

const { footerLists } = useFooterList()
const userData = reactive({})

const emailShow = () =>{

    axios.get('/api/emailShow').then((response)=>{
    userData.email = response.data.email
    })
}
const PasswordUpdate = () =>{

    axios.post('/api/PasswordUpdate').then((response)=>{
    
    })
}
 
    onMounted( ()=> {
        emailShow()
    })


</script>

<template>
    <!-- <Head title="Dashboard" /> -->
    <BreezeAuthenticatedLayout>
        <div class="flex justify-center bg-white items-center max-w-lg mx-auto font-serif">
            <div class="w-full justify-center">
                <MasterHeader/>
                <form method="POST" @submit.prevent="PasswordUpdate()" class="mx-8 mb-28 max-w-lg text-[22px] bg-opacity-75 bg-white">
                    <div class="flex justify-end mr-4">
                        <div class="text-[25px] bg-[#639f1e] w-10 h-10 text-center font-bold bg-opacity-75 ">X</div>
                    </div>
                    <BreezeLabel value="Email" />
                    <BreezeInput :value="userData.email" disabled/>
                    <div class="flex mt-4 justify-between">
                        <BreezeLabel value="Old Password" />
                        <i id="old" class="fa fa-eye fa-lg mt-5 mr-4 bg-opacity-75 text-[#639f1e] old_password"></i>
                    </div>
                    <BreezeInput type="password" v-model="userData.oldPassword"/>
                    <div class="flex mt-4 justify-between">
                        <BreezeLabel value="New Password" />
                        <i id="new" class="fa fa-eye fa-lg mt-5 mr-4 bg-opacity-75 text-[#639f1e]"></i>
                    </div>
                    <BreezeInput type="password" v-model="userData.newPassword"/>
                    <div class="flex mt-4 justify-between">
                        <BreezeLabel value="Verify New Password" />
                        <i id="verify" class="fa fa-eye fa-lg mt-5 mr-4 bg-opacity-75 text-[#639f1e]"></i>
                    </div>
                    <BreezeInput type="password" v-model="userData.verifyPassword"/>
                    <BreezeButton class="bg-opacity-75 mt-4 bg-[#639f1e] text-white w-full font-sans submit mx-auto py-3 justify-center text-[25px] font-bold">
                        Update
                    </BreezeButton>
                    <BreezeButton class="bg-opacity-75 mt-4 bg-[#800000] text-white w-full font-sans submit mx-auto py-3 justify-center text-[25px] font-bold">
                        Login
                    </BreezeButton>
                </form>
            </div>
            <MasterFooter
                :footerLists="footerLists"
            />
        </div>
    </BreezeAuthenticatedLayout>
</template>
