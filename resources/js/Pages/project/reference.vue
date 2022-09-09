<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeLabel from '@/Components/Label.vue';
import MasterFooter from '@/Components/MasterFooter.vue';
import MasterHeader from '@/Components/MasterHeader.vue';
import useFooterList from "../../../use/useFooterList";
import { Link } from '@inertiajs/inertia-vue3';
import {ref, onMounted } from "vue";
import commonFunctions from "@/use/common";
import {Inertia} from "@inertiajs/inertia";

const { Toast } = commonFunctions(),
    { footerLists } = useFooterList()

const info = ref({}),
    reference = ref({ one: 'Please Select', two: 'Please Select', three: 'Please Select', four: 'Please Select', five: 'Please Select', six: 'Please Select'}),
    validationErrors = ref({})

const validation = (post) =>{
    validationErrors.value = {}

    if( post.one === 'Please Select')
        validationErrors.value.one = ['* Required field!']
    if( post.two === 'Please Select')
        validationErrors.value.two = ['* Required field!']
    if( post.three === 'Please Select')
        validationErrors.value.three = ['* Required field!']
    if( post.four === 'Please Select')
        validationErrors.value.four = ['* Required field!']
    if( post.five === 'Please Select')
        validationErrors.value.five = ['* Required field!']
    if( post.six === 'Please Select')
        validationErrors.value.six = ['* Required field!']
    if(!post.comment)
        validationErrors.value.comment = ['* Required field!']

    return Object.values(validationErrors.value).length === 0;
}

const referenceSubmit = (post) =>{
    const queryString = window.location.href;
    let data = queryString.split('/');

    info.value.email = data[5]
    info.value.project_id = data[6]
    info.value.role_id = data[7]
    info.value.app_id = data[8]
    info.value.user_id = data[9]

    let validation_detail = validation (post)
    if(validation_detail === true) {
        if ( reference.value.approve ) return
        reference.value.approve = true
        axios
            .post('/reference-form',{info:info.value, form:reference.value})
            .then((response)=>{
                if (response.data.success === true) {
                    Toast.fire({icon: "success", title: "Information Submitted successfully!"})
                }
            })
            .finally(() => {
                reference.value = { approve: false, one: 'Please Select', two: 'Please Select', three: 'Please Select', four: 'Please Select', five: 'Please Select', six: 'Please Select'}
                Inertia.visit('/footer-project')

            })
    }else {
        reference.value.approve = false
    }
}

onMounted( ()=> {

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
                        <Link :href="route('projectshome')" class="text-[25px] bg-[#639f1e] p-1 text-center font-bold bg-opacity-75">
                            <i class="fas fa-home"></i>
                        </Link>
                    </div>
                    <BreezeLabel value="1. How long have you known the applicant ?"/>
                    <div class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.one">{{ message }}</div>
                    <div class="w-full">
                        <select v-model="reference.one" class="text-[20px] flex justify-between w-full dropdown-toggle px-6 py-2.5 bg-[#639f1e] text-white bg-opacity-75 rounded shadow-md hover:bg-[#639f1e] hover:shadow-lg focus:bg-[#639f1e] focus:shadow-lg focus:outline-none focus:ring-0 active:bg-[#639f1e] transition duration-500 ease-in-out flex items-center">
                            <option disabled hidden>
                                 Please Select
                            </option>
                            <option class="py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100">
                                 Less than 6 months
                            </option>
                            <option class="py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100">
                                 6 months to a year
                            </option>
                            <option class="py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100">
                                 A year to 18 months
                            </option>
                            <option class="py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100">
                                 More than 18 months
                            </option>
                        </select>
                    </div>
                    <BreezeLabel value="2. You know the applicant as a ?"/>
                    <div  class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.two">{{ message }}</div>
                    <div class="w-full">
                        <select v-model="reference.two" class="text-[20px] flex justify-between w-full dropdown-toggle px-6 py-2.5 bg-[#639f1e] text-white bg-opacity-75 rounded shadow-md hover:bg-[#639f1e] hover:shadow-lg focus:bg-[#639f1e] focus:shadow-lg focus:outline-none focus:ring-0 active:bg-[#639f1e] transition duration-500 ease-in-out flex items-center">
                            <option disabled hidden>
                                Please Select
                            </option>
                            <option class="py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100">
                                 Friend
                            </option>
                            <option class="py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100">
                                 Family
                            </option>
                            <option class="py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100">
                                 Professionally
                            </option>
                        </select>
                    </div>
                    <BreezeLabel value="3. Please tick your views on the following statements-"/>
                    <BreezeLabel value="a. I want to work with the applicant"/>
                    <div class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.three">{{ message }}</div>
                    <div class="w-full">
                        <select v-model="reference.three" class="text-[20px] flex justify-between w-full dropdown-toggle px-6 py-2.5 bg-[#639f1e] text-white bg-opacity-75 rounded shadow-md hover:bg-[#639f1e] hover:shadow-lg focus:bg-[#639f1e] focus:shadow-lg focus:outline-none focus:ring-0 active:bg-[#639f1e] transition duration-500 ease-in-out flex items-center">
                            <option disabled hidden>
                                Please Select
                            </option>
                            <option class="py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100">
                                 Strongly Agree
                            </option>
                            <option class="py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100">
                                 Agree
                            </option>
                            <option class="py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100">
                                 Disagree
                            </option>
                            <option class="py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100">
                                 Strongly Disagree
                            </option>
                        </select>
                    </div>
                    <BreezeLabel value="b. The applicant can do this role"/>
                    <div class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.four">{{ message }}</div>
                    <div class="w-full">
                        <select v-model="reference.four" class="text-[20px] flex justify-between w-full dropdown-toggle px-6 py-2.5 bg-[#639f1e] text-white bg-opacity-75 rounded shadow-md hover:bg-[#639f1e] hover:shadow-lg focus:bg-[#639f1e] focus:shadow-lg focus:outline-none focus:ring-0 active:bg-[#639f1e] transition duration-500 ease-in-out flex items-center">
                            <option disabled hidden>
                                Please Select
                            </option>
                            <option class="py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100">
                                Strongly Agree
                            </option>
                            <option class="py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100">
                                Agree
                            </option>
                            <option class="py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100">
                                Disagree
                            </option>
                            <option class="py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100">
                                Strongly Disagree
                            </option>
                        </select>
                    </div>
                    <BreezeLabel value="c. The applicant has outstanding leadership skills"/>
                    <div class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.five">{{ message }}</div>
                    <div class="w-full">
                        <select  v-model="reference.five" class="text-[20px] flex justify-between w-full dropdown-toggle px-6 py-2.5 bg-[#639f1e] text-white bg-opacity-75 rounded shadow-md hover:bg-[#639f1e] hover:shadow-lg focus:bg-[#639f1e] focus:shadow-lg focus:outline-none focus:ring-0 active:bg-[#639f1e] transition duration-500 ease-in-out flex items-center">
                            <option disabled hidden>
                                Please Select
                            </option>
                            <option class="py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100">
                                Strongly Agree
                            </option>
                            <option class="py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100">
                                Agree
                            </option>
                            <option class="py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100">
                                Disagree
                            </option>
                            <option class="py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100">
                                Strongly Disagree
                            </option>
                        </select>
                    </div>
                    <BreezeLabel value="d. The applicant has outstanding communication skills"/>
                    <div class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.six">{{ message }}</div>
                    <div class="w-full">
                        <select v-model="reference.six" class="text-[20px] flex justify-between w-full dropdown-toggle px-6 py-2.5 bg-[#639f1e] text-white bg-opacity-75 rounded shadow-md hover:bg-[#639f1e] hover:shadow-lg focus:bg-[#639f1e] focus:shadow-lg focus:outline-none focus:ring-0 active:bg-[#639f1e] transition duration-500 ease-in-out flex items-center">
                            <option disabled hidden>
                                Please Select
                            </option>
                            <option class="py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100">
                                Strongly Agree
                            </option>
                            <option class="py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100">
                                Agree
                            </option>
                            <option class="py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100">
                                Disagree
                            </option>
                            <option class="py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100">
                                Strongly Disagree
                            </option>
                        </select>
                    </div>
                    <div>
                        <BreezeLabel value="4. Add an additional comment here"/>
                        <div v-if="!reference.comment" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.comment">{{ message }}</div>
                        <textarea v-model="reference.comment" class="focus:ring-[#639f1e] border-none focus:border-[#639f1e] w-full h-28 bg-[#639f1e] bg-opacity-75"></textarea>
                    </div>

                    <button type="button" @click="referenceSubmit(reference)" class="inline-flex items-center font-bold transition ease-in-out duration-150 bg-opacity-75 mt-4 bg-[#639f1e] text-white w-full font-sans submit mx-auto py-3 justify-center text-[25px]" :class="{ 'opacity-25': reference.approve }" :disabled="reference.approve">
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
