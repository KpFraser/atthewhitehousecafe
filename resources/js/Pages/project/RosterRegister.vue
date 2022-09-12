<script setup>
import BreezeButton from '@/Components/Button.vue';
import MasterFooter from '@/Components/MasterFooter.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import LoginRegisterHeader from '@/Components/LoginRegisterHeader.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import useFooterList from "../../../use/useFooterList";
import { ref } from "vue";
import {Inertia} from "@inertiajs/inertia";


const { footerLists } = useFooterList()
const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: true,
});
const errors = ref({})

const submit = () => {
    const queryString = window.location.href
    let event_id = queryString.split('/')[4].split('-')[0]
    let project_id = queryString.split('/')[4].split('-')[1]
    // console.log(event_id, project_id)
    axios
        .post('/roster-new/'+project_id, form)
        .then(()=>{
            Inertia.visit('/roster/' +event_id+'-'+project_id)

        }).catch((response)=>{
         errors.value = response.response.data.errors
    });
}
const eye_one = (e) => {
    const password = document.querySelector("#password")

    const type = password.getAttribute("type") === "password" ? "text" : "password"
    password.setAttribute("type", type)
    e.target.classList.toggle('fa-eye-slash')
}
const eye_two = (e) => {
    const password = document.querySelector("#password_confirmation")

    const type = password.getAttribute("type") === "password" ? "text" : "password"
    password.setAttribute("type", type)
    e.target.classList.toggle('fa-eye-slash')
}
</script>

<template>
    <BreezeGuestLayout>
<!--        <Head title="Register" />-->
        <BreezeValidationErrors class="mb-4" />
        <div class="min-h-screen flex justify-center items-center max-w-lg mx-auto font-serif">
            <div class="w-full mb-28 justify-center">
                <LoginRegisterHeader/>
                <form @submit.prevent="submit" class="text-[22px] mx-10">
                    <div>
                        <BreezeLabel for="name" class="text-black" value="Name" />
                        <BreezeInput id="name" type="text" class="mt-1 border-b-8 border-[#639f1e] bg-transparent outline-0 block w-full" v-model="form.name" required autofocus autocomplete="name" />
                    </div>

                    <div class="mt-4">
                        <BreezeLabel for="email" value="Email" />
                        <div v-if="!!errors" class="ml-2 text-red-700 font-bold text-sm" v-for="message in errors.email">{{ message }}</div>
                        <BreezeInput id="email" type="email" class="mt-1 block w-full border-b-8 border-[#639f1e] outline-0 bg-transparent" v-model="form.email" required autocomplete="username" />
                    </div>

                    <div class="mt-4">
                        <div class="flex mt-2 justify-between">
                            <BreezeLabel for="password" value="Password" />
                            <i @click="eye_one" class="fa fa-eye fa-lg mt-2 mr-4 text-[#639f1e]"></i>
                        </div>
                        <div v-if="!!errors" class="ml-2 text-red-700 font-bold text-sm" v-for="message in errors.password">{{ message }}</div>
                        <BreezeInput id="password" type="password" class="mt-1 block w-full border-b-8 border-[#639f1e] outline-0 bg-transparent" v-model="form.password" required autocomplete="new-password" />
                    </div>

                    <div class="mt-4">
                        <div class="flex mt-2 justify-between">
                            <BreezeLabel for="password_confirmation" value="Confirm Password" />
                            <i @click="eye_two" class="fa fa-eye fa-lg mt-2 mr-4 text-[#639f1e]"></i>
                        </div>
                        <BreezeInput id="password_confirmation" type="password" class="mt-1 block w-full border-b-8 border-[#639f1e] outline-0 bg-transparent" v-model="form.password_confirmation" required autocomplete="new-password" />
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <BreezeButton class="bg-[#639f1e] text-white w-full font-sans submit mx-auto py-3 justify-center text-[25px] font-bold" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Add a Participant
                        </BreezeButton>
                    </div>
                </form>
            </div>
            <MasterFooter
                :footerLists="footerLists"
            />
        </div>
    </BreezeGuestLayout>
</template>
