<script setup>
import BreezeButton from '@/Components/Button.vue';
import MasterFooter from '@/Components/MasterFooter.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import LoginRegisterHeader from '@/Components/LoginRegisterHeader.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import BreezeCheckbox from '@/Components/Checkbox.vue';
import { Link, useForm } from '@inertiajs/inertia-vue3';
import useFooterList from "../../../use/useFooterList";
import { ref } from "vue";
import {Inertia} from "@inertiajs/inertia";
import commonFunctions from "@/use/common";
import debounce from "lodash/debounce";

const { Toast } = commonFunctions(),
    { footerLists } = useFooterList(),
    sendEmail = ref(true),
    formInfo = ref({}),
    slug = ref({}),
    validationErrors = ref({}),
    emailError = ref([]),
    search = ref('')


const errors = ref({}),
    alreadyRegister = ref (false)

const validation = (post) =>{
    if(!post.name)
        validationErrors.value.name = '*Name is required !'
    if(!post.email)
        validationErrors.value.email = '*Email is required !'

    return Object.values(validationErrors.value).length === 0;
}

const submit = (Info) => {
    const valid = validation (Info)
    console.log(valid)
    if (valid === true) {
        if (!!formInfo.value.name && !!formInfo.value.email) {
            formInfo.value.processing = true
            const queryString = window.location.href
            let event_slug = queryString.split('/')[4]
            let project_slug = queryString.split('/')[5]

            axios
                .post('/roster-new', {
                    event_slug: event_slug,
                    project_slug: project_slug,
                    email: formInfo.value.email,
                    name: formInfo.value.name
                })
                .then((response) => {
                    if (response.data.success) {
                        formInfo.value.processing = false
                        sendEmail.value = false
                        Toast.fire({icon: "success", title: "Email Sent Successfully!"})
                    }
                }).catch((response) => {
                errors.value = response.response.data.errors
                formInfo.value.processing = false
            });
        }
    }
}

const addParticipant = () =>{
    if (!!formInfo.value.email) {
        validationErrors.value = {}
        emailError.value = {}
        formInfo.value.processing = true
        const queryString = window.location.href
        let event_slug = queryString.split('/')[4]
        let project_slug = queryString.split('/')[5]
        axios
            .post('/add-participant', {event_slug:event_slug, project_slug:project_slug, email: formInfo.value.email})
            .then((response) => {
                if (response.data.success === true) {
                    Toast.fire({icon: "success", title: "Participant added Successfully!"})
                    formInfo.value.processing = false
                    Inertia.visit('/roster/' + event_slug + '.' + project_slug)
                }
            }).catch((response) => {
            emailError.value[0] = response.response.data.error
            formInfo.value.processing = false
        });
    } else {
        emailError.value[0] = '*Email Required !'
    }
}

const checkRegister = () => {
    emailError.value = []
    if (alreadyRegister.value === true)
        alreadyRegister.value = false
    else
    alreadyRegister.value = true
}

const redirect = () => {
    const queryString = window.location.href
    let event_slug = queryString.split('/')[4]
    let project_slug = queryString.split('/')[5]
    console.log(event_slug, project_slug)
    Inertia.visit('/roster/' + event_slug + '/' + project_slug)
}

const inputSearch = debounce(() => {
    if(formInfo.value.email !== ''){
        console.log(formInfo.value.email)
        axios
            .get('/searchEmail/'+formInfo.value.email)
            .then((response) => {
                console.log(search.value = response.data.data)
            })
    }
}, 1000)

const selectEmail = (email) => {
    formInfo.value.email = email
    search.value = []
}

</script>

<template>
        <div class="border-8 border-[#639f1e] border-opacity-75 h-screen items-center mx-auto max-w-lg">
            <div class="flex justify-end m-2">
                <div @click="redirect()" class="text-[25px] cursor-pointer font-serif bg-[#639f1e] bg-opacity-75 p-2 text-center font-extrabold">
                    X
                </div>
            </div>
            <BreezeValidationErrors class="mb-4" />
            <div class="flex justify-center items-center mx-auto font-serif">
                <div class="w-full mb-28 justify-center">
                    <form v-if="sendEmail === true" class="text-[22px] mx-10">
                        <div class="flex items-center my-5">
                            <BreezeCheckbox @change="checkRegister()" class="accent-[#639f1e] w-5 h-5 border-[#639f1e] text-[16px] hover:text-[#639f1e]"/>
                            <BreezeLabel class="ml-2 text-black" value="Already a Member?" />
                        </div>
                        <div v-show="alreadyRegister !== true">
                            <div class="flex items-center">
                                <BreezeLabel for="name" class="text-black" value="Name *" />
                                <div v-if="validationErrors !== ''" class="ml-2 text-red-700 font-bold text-sm">{{ validationErrors.name }}</div>
                            </div>
                            <BreezeInput id="name" type="text" class="mt-1 border-b-8 border-[#639f1e] bg-transparent outline-0 block w-full" v-model="formInfo.name" required autofocus autocomplete="name" />
                        </div>
                        <div class="mt-4">
                            <div class="flex items-center">
                                <div class="flex items-center">
                                    <BreezeLabel for="email" value="Email *" />
                                    <div v-if="validationErrors !== ''" class="ml-2 text-red-700 font-bold text-sm">{{ validationErrors.email }}</div>
                                </div>
                                <div v-if="emailError.length !== 0" class="ml-2 text-red-700 font-bold text-sm" >{{emailError[0]}}</div>
                            </div>
                            <div v-if="!!errors" class="ml-2 text-red-700 font-bold text-sm" v-for="message in errors.email">{{ message }}</div>
                            <div class="relative">
                                <BreezeInput @input="inputSearch" v-model="formInfo.email" id="email" type="email" class="mt-1 block w-full border-b-8 border-[#639f1e] outline-0 bg-transparent" required/>
                                <div v-if="search.length !== 0" v-for="mail in search" @click="selectEmail(mail.email)" class="hover:bg-gray-100 absolute bg-white w-full cursor-pointer border-2 border-[#639f1e]">{{ mail.email }}</div>
                            </div>
                        </div>
                        <div v-show="alreadyRegister !== true" class="flex items-center justify-end mt-4">
                            <BreezeButton @click="submit(formInfo)" class="bg-[#639f1e] hover:bg-opacity-75 text-white w-full font-sans submit mx-auto py-3 justify-center text-[25px] font-bold" :class="{ 'opacity-25': formInfo.processing }" :disabled="formInfo.processing">
                                Add a Participant
                            </BreezeButton>
                        </div>
                        <div v-show="alreadyRegister === true" class="flex items-center justify-end mt-4">
                            <BreezeButton @click="addParticipant()" class="bg-[#639f1e] hover:bg-opacity-75 text-white w-full font-sans submit mx-auto py-3 justify-center text-[25px] font-bold" :class="{ 'opacity-25': formInfo.processing }" :disabled="formInfo.processing">
                                Add a Participant
                            </BreezeButton>
                        </div>
                    </form>
                    <div v-if="sendEmail === false">
                        <BreezeLabel class="text-center text-white py-4 bg-opacity-75 bg-[#639f1e]">
                            Check your email to enter password.
                        </BreezeLabel>
                        <Link class="text-center justify-center flex py-4 bg-opacity-75 text-[#639f1e]">Resend Email</Link>
                    </div>
                </div>
                <MasterFooter
                    :footerLists="footerLists"
                />
            </div>
        </div>
</template>
