<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import MasterFooter from '@/Components/MasterFooter.vue';
import MasterHeader from '@/Components/MasterHeader.vue';
import BreezeButton from '@/Components/Button.vue';
// import { Head, Link } from '@inertiajs/inertia-vue3';
import { ref, reactive } from 'vue';
import axios from 'axios';
import useFooterList from "../../../use/useFooterList";

const { footerLists } = useFooterList()
const userData = reactive({})
const validationErrors = ref({})

const validation = (post) =>{

    if(!post.oldPassword)
        validationErrors.value.oldPassword = ['* Required feild!']
    if(!post.password)
        validationErrors.value.password = ['* Required feild!']
    if(!post.password_confirmation)
        validationErrors.value.password_confirmation = ['* Required feild!']
    if(post.password != post.password_confirmation)
        validationErrors.value.password_confirmation = ['* Password Confirmation failed!']
  
    return Object.values(validationErrors.value).length == 0;
}

const PasswordUpdate = (post) =>{
        let validation_detail = validation (post)
        if(validation_detail === true){
            axios
                .post('password-update', userData).then((response)=>{
                    if(response.data.success === true)
                    {
                        alert('Password changed successfully!');
                    }
                })
                .catch((error)=>{
                    validationErrors.value = error.response.data.errors
                })
        }
    }

</script>

<template>
    <!-- <Head title="Dashboard" /> -->
    <BreezeAuthenticatedLayout>
        <div class="flex justify-center bg-white items-center max-w-lg mx-auto font-serif">
            <div class="w-full justify-center">
                <MasterHeader/>
                <form method="POST" @submit.prevent="PasswordUpdate(userData)" class="mx-8 mb-28 max-w-lg text-[22px] bg-opacity-75 bg-white">
                    <div class="flex justify-end mr-4">
                        <div class="text-[25px] bg-[#639f1e] w-10 h-10 text-center font-bold bg-opacity-75 ">X</div>
                    </div>
                    <BreezeLabel value="Email" />
                    <BreezeInput :value=" $page.props.auth.user.email" disabled/>
                    <div class="flex mt-4 justify-between">
                        <div>
                            <BreezeLabel value="Old Password" />
                        <div class="ml-2 text-red-700 font-bold text-sm" v-for="message in validationErrors.oldPassword">{{ message }}</div>
                        </div>
                        <i id="old" class="fa fa-eye fa-lg mt-5 mr-4 bg-opacity-75 text-[#639f1e] old_password"></i>
                    </div>
                    <BreezeInput type="password"  @focusout="delete validationErrors['oldPassword']" v-model="userData.oldPassword" />
                    <div class="flex mt-4 justify-between">
                        <div>
                            <BreezeLabel value="New Password" />
                            <div class="ml-2 text-red-700 font-bold text-sm" v-for="message in validationErrors.password">{{ message }}</div>
                        </div>
                        <i id="new" class="fa fa-eye fa-lg mt-5 mr-4 bg-opacity-75 text-[#639f1e]"></i>
                    </div>
                    <BreezeInput type="password"  @focusout="delete validationErrors['password']" v-model="userData.password"/>
                    <div class="flex mt-4 justify-between">
                        <div>
                            <BreezeLabel value="Verify New Password" />
                            <div class="ml-2 text-red-700 font-bold text-sm" v-for="message in validationErrors.password_confirmation">{{ message }}</div>
                        </div>
                        <i id="verify" class="fa fa-eye fa-lg mt-5 mr-4 bg-opacity-75 text-[#639f1e]"></i>
                    </div>
                    <BreezeInput type="password"  @focusout="delete validationErrors['password_confirmation']" v-model="userData.password_confirmation"/>
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
