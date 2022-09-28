<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import MasterFooter from '@/Components/MasterFooter.vue';
import MasterHeader from '@/Components/MasterHeader.vue';
import useFooterList from "../../../use/useFooterList";

const { footerLists  } = useFooterList()

</script>

<template>
    <BreezeAuthenticatedLayout>
        <div class="flex justify-center bg-white items-center max-w-lg mx-auto font-serif">
            <div class="w-full mb-28 justify-center">
                <MasterHeader/>
                <div class="max-w-lg mx-auto border-2 border-[#556553] border-opacity-75 p-2">
                    <div>
                        <h3 class="font-bold">Dear Community Coach,</h3>
                        <p class="text-xs">tdis questionnaire will help us better understand volunteer coaches.
                            Be assured tdat all information will remain <a href="" class="underline font-semibold">anonymous and
                                confidential.</a></p>
                    </div>

                    <div class="w-full bg-[#639f1e] bg-opacity-75 text-white p-2">
                        <h1 class="text-lg">1. Background data</h1>
                    </div>

                    <div class=" border-2 border-[#556553] border-opacity-75 p-2 mt-2">
                        <p>Which of tde following would best describe you:</p>
                        <div class="flex justify-between">
                            <div class="form-check">
                                <input
                                    class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                    type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label inline-block text-gray-800" for="flexRadioDefault1">
                                    A member of tde local community
                                </label>
                            </div>
                            <div class="form-check">
                                <input
                                    class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                    type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                <label class="form-check-label inline-block text-gray-800" for="flexRadioDefault2">
                                    A local professional
                                </label>
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <div class="form-check">
                                <input
                                    class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                    type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label inline-block text-gray-800" for="flexRadioDefault1">
                                    A student
                                </label>
                            </div>
                            <div class="form-check">
                                <input
                                    class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                    type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                <label class="form-check-label inline-block text-gray-800" for="flexRadioDefault2">
                                    A teacher
                                </label>
                            </div>
                        </div>
                        <p>Please detail your demographical background:</p>
                        <div class="flex justify-around">
                            <div class="form-check">
                                <input
                                    class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                    type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label inline-block text-gray-800" for="flexRadioDefault1">
                                    Age
                                </label>
                            </div>
                            <div class="form-check">
                                <input
                                    class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                    type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                <label class="form-check-label inline-block text-gray-800" for="flexRadioDefault2">
                                    Gender
                                </label>
                            </div>
                            <div class="flex">
                                <h3 class="my-auto">Post Code</h3>
                                <textarea name="" id="" cols="20" rows="3" class="border-2 border-gray-600"></textarea>
                            </div>
                        </div>

                    </div>

                    <div class="w-full inline-block bg-[#639f1e] bg-opacity-75 text-white p-2 mt-2">
                        <h1>2. How has your involvement impacted you on your:</h1>
                        <p class="float-right">(Circle tde most appropriate)</p>
                    </div>

                    <table class="w-full mt-2">
                        <tr class="text-xs tracking-tight">
                            <td></td>
                            <td>Negatively[-1]</td>
                            <td>None[0]</td>
                            <td>Some[1]</td>
                            <td>Significantly[2]</td>
                        </tr>
                        <tr>
                            <td class="text-xs">a. Happiness;</td>
                            <td class="px-5">
                                <input
                                    class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                    type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            </td>
                            <td class="px-5">
                                <input
                                    class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                    type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            </td>
                            <td class="px-5">
                                <input
                                    class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                    type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            </td>
                            <td class="px-5">
                                <input
                                    class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                    type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-xs">b. Energy;</td>
                            <td class="px-5">
                                <input
                                    class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                    type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            </td>
                            <td class="px-5">
                                <input
                                    class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                    type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            </td>
                            <td class="px-5">
                                <input
                                    class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                    type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            </td>
                            <td class="px-5">
                                <input
                                    class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                    type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-xs">c. Most significant relationship;</td>
                            <td class="px-5">
                                <input
                                    class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                    type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            </td>
                            <td class="px-5">
                                <input
                                    class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                    type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            </td>
                            <td class="px-5">
                                <input
                                    class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                    type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            </td>
                            <td class="px-5">
                                <input
                                    class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                    type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-xs">d. Understanding of young people.</td>
                            <td class="px-5">
                                <input
                                    class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                    type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            </td>
                            <td class="px-5">
                                <input
                                    class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                    type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            </td>
                            <td class="px-5">
                                <input
                                    class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                    type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            </td>
                            <td class="px-5">
                                <input
                                    class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                    type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            </td>
                        </tr>

                    </table>

                    <div class="w-full bg-[#639f1e] bg-opacity-75 text-white p-2 mt-2">
                        <h1 class="text-xs">3. Please state your attitude, about tde programme, concerning tdese issues:</h1>
                    </div>

                    <div class="w-full mt-2">
                        <table>
                            <tr class="text-xs tracking-tight">
                                <td></td>
                                <td>Strongly Disagree[-1]</td>
                                <td>Disagree[0]</td>
                                <td>Agree[1]</td>
                                <td>Strongly Agree[2]</td>
                            </tr>
                            <tr>
                                <td class="text-xs">a. Met my expectations;</td>
                                <td class="px-5">
                                    <input
                                        class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                        type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                </td>
                                <td class="px-5">
                                    <input
                                        class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                        type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                </td>
                                <td class="px-5">
                                    <input
                                        class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                        type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                </td>
                                <td class="px-5">
                                    <input
                                        class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                        type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                </td>
                            </tr>
                            <tr class="text-xs">
                                <td>b. Enjoyable;</td>
                                <td class="px-5">
                                    <input
                                        class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                        type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                </td>
                                <td class="px-5">
                                    <input
                                        class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                        type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                </td>
                                <td class="px-5">
                                    <input
                                        class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                        type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                </td>
                                <td class="px-5">
                                    <input
                                        class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                        type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                </td>
                            </tr>
                            <tr>
                                <td class="text-xs">c. I would recommend to otders;</td>
                                <td class="px-5">
                                    <input
                                        class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                        type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                </td>
                                <td class="px-5">
                                    <input
                                        class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                        type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                </td>
                                <td class="px-5">
                                    <input
                                        class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                        type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                </td>
                                <td class="px-5">
                                    <input
                                        class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                        type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                </td>
                            </tr>

                            <tr>
                                <td colspan="5" class="text-xs font-semibold">d. tde items below are significant constraint for
                                    volunteering in after school activities:</td>
                            </tr>

                            <tr>
                                <td class="text-xs">i. Work constraints;</td>
                                <td class="px-5">
                                    <input
                                        class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                        type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                </td>
                                <td class="px-5">
                                    <input
                                        class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                        type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                </td>
                                <td class="px-5">
                                    <input
                                        class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                        type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                </td>
                                <td class="px-5">
                                    <input
                                        class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                        type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                </td>
                            </tr>
                            <tr>
                                <td class="text-xs">ii. Family commitments;</td>
                                <td class="px-5">
                                    <input
                                        class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                        type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                </td>
                                <td class="px-5">
                                    <input
                                        class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                        type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                </td>
                                <td class="px-5">
                                    <input
                                        class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                        type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                </td>
                                <td class="px-5">
                                    <input
                                        class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                        type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                </td>
                            </tr>
                            <tr>
                                <td class="text-xs">iii. Lack of leadership /managerial skills.</td>
                                <td class="px-5">
                                    <input
                                        class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                        type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                </td>
                                <td class="px-5">
                                    <input
                                        class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                        type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                </td>
                                <td class="px-5">
                                    <input
                                        class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                        type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                </td>
                                <td class="px-5">
                                    <input
                                        class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                        type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                </td>
                            </tr>


                        </table>
                    </div>


                    <div class="w-full inline-block bg-[#639f1e] bg-opacity-75 text-white p-2 mt-2">
                        <h1 class="text-xs">4. Your comments, particularly regarding re-volunteering, are valued.</h1>
                        <textarea name="" class="w-full text-black" id="" cols="30" rows="10"></textarea>
                        <p class="text-center text-xs">We tdank you for taking time for filling out tdis questionnaire!</p>
                    </div>

                </div>
            </div>
            <MasterFooter
                :footerLists="footerLists"
            />
        </div>
    </BreezeAuthenticatedLayout>
</template>
