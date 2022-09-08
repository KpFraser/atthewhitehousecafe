<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeLabel from '@/Components/Label.vue';
import MasterFooter from '@/Components/MasterFooter.vue';
import MasterHeader from '@/Components/MasterHeader.vue';
import useFooterList from "../../../use/useFooterList";
import { Link } from '@inertiajs/inertia-vue3';
import {ref, onMounted } from "vue";
import commonFunctions from "@/use/common";

const { Toast } = commonFunctions(),
    { footerLists } = useFooterList()



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
                    <div class="w-full">
                        <select class="text-[20px] flex justify-between w-full dropdown-toggle px-6 py-2.5 bg-[#639f1e] text-white bg-opacity-75 rounded shadow-md hover:bg-[#639f1e] hover:shadow-lg focus:bg-[#639f1e] focus:shadow-lg focus:outline-none focus:ring-0 active:bg-[#639f1e] transition duration-500 ease-in-out flex items-center">
                            <option>
                                <div class="dropdown-item py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100" href="#">Please Select</div>
                            </option>
                            <option>
                                <div class="dropdown-item py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100" href="#">Less than 6 months</div>
                            </option>
                            <option>
                                <div class="dropdown-item py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100" href="#">6 months to a year</div>
                            </option>
                            <option>
                                <div class="dropdown-item py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100" href="#">A year to 18 months</div>
                            </option>
                            <option>
                                <div class="dropdown-item py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100" href="#">More than 18 months</div>
                            </option>
                        </select>
                    </div>
                    <BreezeLabel value="2. You know the applicant as a ?"/>
                    <div class="w-full">
                        <select class="text-[20px] flex justify-between w-full dropdown-toggle px-6 py-2.5 bg-[#639f1e] text-white bg-opacity-75 rounded shadow-md hover:bg-[#639f1e] hover:shadow-lg focus:bg-[#639f1e] focus:shadow-lg focus:outline-none focus:ring-0 active:bg-[#639f1e] transition duration-500 ease-in-out flex items-center">
                            <option>
                                <div class="dropdown-item py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100" href="#">Please Select</div>
                            </option>
                            <option>
                                <div class="dropdown-item py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100" href="#">Friend</div>
                            </option>
                            <option>
                                <div class="dropdown-item py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100" href="#">Family</div>
                            </option>
                            <option>
                                <div class="dropdown-item py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100" href="#">Professionally</div>
                            </option>
                        </select>
                    </div>
                    <BreezeLabel value="3. Please tick your views on the following statements-"/>
                    <BreezeLabel value="a. I want to work with the applicant"/>
                    <div class="w-full">
                        <select class="text-[20px] flex justify-between w-full dropdown-toggle px-6 py-2.5 bg-[#639f1e] text-white bg-opacity-75 rounded shadow-md hover:bg-[#639f1e] hover:shadow-lg focus:bg-[#639f1e] focus:shadow-lg focus:outline-none focus:ring-0 active:bg-[#639f1e] transition duration-500 ease-in-out flex items-center">
                            <option>
                                <div class="dropdown-item py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100" href="#">Please Select</div>
                            </option>
                            <option>
                                <div class="dropdown-item py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100" href="#">Strongly Agree</div>
                            </option>
                            <option>
                                <div class="dropdown-item py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100" href="#">Agree</div>
                            </option>
                            <option>
                                <div class="dropdown-item py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100" href="#">Disagree</div>
                            </option>
                            <option>
                                <div class="dropdown-item py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100" href="#">Strongly Disagree</div>
                            </option>
                        </select>
                    </div>
                    <BreezeLabel value="b. The applicant can do this role"/>
                    <div class="w-full">
                        <select class="text-[20px] flex justify-between w-full dropdown-toggle px-6 py-2.5 bg-[#639f1e] text-white bg-opacity-75 rounded shadow-md hover:bg-[#639f1e] hover:shadow-lg focus:bg-[#639f1e] focus:shadow-lg focus:outline-none focus:ring-0 active:bg-[#639f1e] transition duration-500 ease-in-out flex items-center">
                            <option>
                                <div class="dropdown-item py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100" href="#">Please Select</div>
                            </option>
                            <option>
                                <div class="dropdown-item py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100" href="#">Strongly Agree</div>
                            </option>
                            <option>
                                <div class="dropdown-item py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100" href="#">Agree</div>
                            </option>
                            <option>
                                <div class="dropdown-item py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100" href="#">Disagree</div>
                            </option>
                            <option>
                                <div class="dropdown-item py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100" href="#">Strongly Disagree</div>
                            </option>
                        </select>
                    </div>
                    <BreezeLabel value="c. The applicant has outstanding leadership skills"/>
                    <div class="w-full">
                        <select class="text-[20px] flex justify-between w-full dropdown-toggle px-6 py-2.5 bg-[#639f1e] text-white bg-opacity-75 rounded shadow-md hover:bg-[#639f1e] hover:shadow-lg focus:bg-[#639f1e] focus:shadow-lg focus:outline-none focus:ring-0 active:bg-[#639f1e] transition duration-500 ease-in-out flex items-center">
                            <option>
                                <div class="dropdown-item py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100" href="#">Please Select</div>
                            </option>
                            <option>
                                <div class="dropdown-item py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100" href="#">Strongly Agree</div>
                            </option>
                            <option>
                                <div class="dropdown-item py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100" href="#">Agree</div>
                            </option>
                            <option>
                                <div class="dropdown-item py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100" href="#">Disagree</div>
                            </option>
                            <option>
                                <div class="dropdown-item py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100" href="#">Strongly Disagree</div>
                            </option>
                        </select>
                    </div>
                    <BreezeLabel value="d. The applicant has outstanding communication skills"/>
                    <div class="w-full">
                        <select class="text-[20px] flex justify-between w-full dropdown-toggle px-6 py-2.5 bg-[#639f1e] text-white bg-opacity-75 rounded shadow-md hover:bg-[#639f1e] hover:shadow-lg focus:bg-[#639f1e] focus:shadow-lg focus:outline-none focus:ring-0 active:bg-[#639f1e] transition duration-500 ease-in-out flex items-center">
                            <option>
                                <div class="dropdown-item py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100" href="#">Please Select</div>
                            </option>
                            <option>
                                <div class="dropdown-item py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100" href="#">Strongly Agree</div>
                            </option>
                            <option>
                                <div class="dropdown-item py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100" href="#">Agree</div>
                            </option>
                            <option>
                                <div class="dropdown-item py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100" href="#">Disagree</div>
                            </option>
                            <option>
                                <div class="dropdown-item py-2 px-4 w-full bg-transparent text-gray-700 hover:bg-gray-100" href="#">Strongly Disagree</div>
                            </option>
                        </select>
                    </div>
                    <div>
                        <BreezeLabel value="4. Add an additional comment here"/>
                        <textarea class="focus:ring-[#639f1e] border-none focus:border-[#639f1e] w-full h-28 bg-[#639f1e] bg-opacity-75"></textarea>
                    </div>

                    <button type="button" @click=" " class="inline-flex items-center font-bold transition ease-in-out duration-150 bg-opacity-75 mt-4 bg-[#639f1e] text-white w-full font-sans submit mx-auto py-3 justify-center text-[25px]">
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
