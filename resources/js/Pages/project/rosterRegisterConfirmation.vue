<script setup>
import BreezeButton from '@/Components/Button.vue';
import MasterFooter from '@/Components/MasterFooter.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import LoginRegisterHeader from '@/Components/LoginRegisterHeader.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import useFooterList from "../../../use/useFooterList";
import { ref } from "vue";
import {Inertia} from "@inertiajs/inertia";
import commonFunctions from "@/use/common";

const { Toast } = commonFunctions(),
    { footerLists } = useFooterList(),
    registerInfo = ref({}),
    errors = ref({})

const submit = () => {
    if (registerInfo.value.length!==0){
        registerInfo.value.processing = true
        const queryString = window.location.href.replaceAll('%20', ' ')
        registerInfo.value.email = queryString.split('/')[4]
        registerInfo.value.project_slug = queryString.split('/')[5]
        registerInfo.value.name = queryString.split('/')[6]
        registerInfo.value.event_slug = queryString.split('/')[7]

        axios
            .post('/roster-register-confirm', registerInfo.value)
            .then((response) => {
                if (response.data.success === true) {
                    registerInfo.value.processing = false
                    Toast.fire({icon: "success", title: "Participant Added!"})
                    Inertia.visit('/roster/' +registerInfo.value.event_slug+'/'+registerInfo.value.project_slug)
                }
            }).catch((response) => {
            errors.value = response.response.data.errors
            registerInfo.value.processing = false
            registerInfo.value.password = ''
            registerInfo.value.password_confirmation = ''
        });
    }
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
        <div class="pt-8">
            <LoginRegisterHeader />
        </div>
        <BreezeValidationErrors class="mb-4" />
        <div class="flex justify-center items-center max-w-lg mx-auto font-serif">
            <div class="w-full mb-28 justify-center">
                <form @submit.prevent="submit" class="text-[22px] mx-10">
                    <div v-if="!!errors" class="text-red-700 font-bold text-sm" v-for="message in errors.email">{{ message }}</div>
                    <div class="mt-4">
                        <div class="flex mt-2 justify-between">
                            <BreezeLabel for="password" value="Password" />
                            <i @click="eye_one" class="fa fa-eye fa-lg mt-2 mr-4 text-[#639f1e]"></i>
                        </div>
                        <div v-if="!!errors" class="ml-2 text-red-700 font-bold text-sm" v-for="message in errors.password">{{ message }}</div>
                        <BreezeInput id="password" type="password" class="mt-1 block w-full border-b-8 border-[#639f1e] outline-0 bg-transparent" v-model="registerInfo.password" required autocomplete="new-password" />
                    </div>

                    <div class="mt-4">
                        <div class="flex mt-2 justify-between">
                            <BreezeLabel for="password_confirmation" value="Confirm Password" />
                            <i @click="eye_two" class="fa fa-eye fa-lg mt-2 mr-4 text-[#639f1e]"></i>
                        </div>
                        <BreezeInput id="password_confirmation" type="password" class="mt-1 block w-full border-b-8 border-[#639f1e] outline-0 bg-transparent" v-model="registerInfo.password_confirmation" required autocomplete="new-password" />
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <BreezeButton class="bg-[#639f1e] text-white w-full font-sans submit mx-auto py-3 justify-center text-[25px] font-bold" :class="{ 'opacity-25': registerInfo.processing }" :disabled="registerInfo.processing">
                            Confirm
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

