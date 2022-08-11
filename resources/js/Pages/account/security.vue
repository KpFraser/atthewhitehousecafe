<script setup>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import BreezeInput from '@/Components/Input.vue';
    import BreezeLabel from '@/Components/Label.vue';
    import MasterFooter from '@/Components/MasterFooter.vue';
    import MasterHeader from '@/Components/MasterHeader.vue';
    import BreezeButton from '@/Components/Button.vue';
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import { ref, reactive } from 'vue';
    import axios from 'axios';
    import useFooterList from "../../../use/useFooterList";

    const { footerLists , avb } = useFooterList(),
        userData = reactive({}),
        validationErrors = ref({}),
        passwordVisible = ref({
            old_pass: false, 
            new_pass: false, 
            confirm_pass: false
        })

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
                        userData.oldPassword = ''
                        userData.password = ''
                        userData.password_confirmation = ''
                    }
                })
                .catch((error)=>{
                    validationErrors.value = !!error.response.data.errors ? error.response.data.errors: ''
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
                <form method="POST" @submit.prevent="PasswordUpdate(userData)" class="mx-8 mb-28 mt-4 max-w-lg text-[22px] bg-opacity-75 bg-white">
                    <div class="flex justify-end mr-4">
                        <Link :href="route('dashboard')" class="text-[25px] bg-[#639f1e] px-1 text-center font-bold bg-opacity-75">X</Link>
                    </div>
                    <BreezeLabel value="Email" />
                    <BreezeInput class="text-sm !mt-4" :value=" $page.props.auth.user.email" disabled/>
                    <div class="flex mt-4 justify-between">
                        <div>
                            <BreezeLabel value="Old Password"/>
                        <div class="ml-2 text-red-700 font-bold text-sm" v-for="message in validationErrors.oldPassword">{{ message }}</div>
                        </div>
                        <i @click="passwordVisible.old_pass = !passwordVisible.old_pass" class="fa fa-lg mt-5 mr-4 bg-opacity-75 text-[#639f1e]" :class=" !passwordVisible.old_pass ? 'fa-eye' :'fa-eye-slash'"></i>
                    </div>
                    <BreezeInput :type="!passwordVisible.old_pass ? 'password' : 'text'" @focusout="delete validationErrors['oldPassword']" v-model="userData.oldPassword" />
                    <div class="flex mt-4 justify-between">
                        <div>
                            <BreezeLabel value="New Password"/>
                            <div class="ml-2 text-red-700 font-bold text-sm" v-for="message in validationErrors.password">{{ message }}</div>
                        </div>
                        <i @click="passwordVisible.new_pass = !passwordVisible.new_pass" class="fa fa-lg mt-5 mr-4 bg-opacity-75 text-[#639f1e]" :class=" !passwordVisible.new_pass ? 'fa-eye' :'fa-eye-slash'"></i>
                    </div>
                    <BreezeInput :type="!passwordVisible.new_pass ? 'password' : 'text'"  @focusout="delete validationErrors['password']" v-model="userData.password"/>
                    <div class="flex mt-4 justify-between">
                        <div>
                            <BreezeLabel value="Verify New Password"/>
                            <div class="ml-2 text-red-700 font-bold text-sm" v-for="message in validationErrors.password_confirmation">{{ message }}</div>
                        </div>
                        <i @click="passwordVisible.confirm_pass = !passwordVisible.confirm_pass" class="fa fa-lg mt-5 mr-4 bg-opacity-75 text-[#639f1e]" :class=" !passwordVisible.confirm_pass ? 'fa-eye' :'fa-eye-slash'"></i>
                    </div>
                    <BreezeInput :type="!passwordVisible.confirm_pass ? 'password' : 'text'"  @focusout="delete validationErrors['password_confirmation']" v-model="userData.password_confirmation"/>
                    <BreezeButton class="bg-opacity-75 mt-4 bg-[#639f1e] text-white w-full font-sans submit mx-auto py-3 justify-center text-[25px] font-bold">
                        Update
                    </BreezeButton>
                    <Link :href="route('dashboard')" class="inline-flex items-center font-bold transition ease-in-out duration-150 bg-opacity-75 mt-4 bg-[#800000] text-white w-full font-sans submit mx-auto py-3 justify-center text-[25px]">
                        Cancel
                    </Link>
                </form>
            </div>
            <MasterFooter
                :footerLists="footerLists"
            />
        </div>
    </BreezeAuthenticatedLayout>
</template>
