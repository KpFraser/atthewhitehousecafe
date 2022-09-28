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
                        <h3 class="font-bold">Dear Participant,</h3>
                        <p>Please take a few minutes to complete tdis questionnaire.</p>
                    </div>

                    <div class="w-full bg-[#639f1e] bg-opacity-75 flex justify-between items-center text-white p-2">
                        <h1 class="text-sm">1. About Yourself?</h1>
                        <p class="text-xs">(Complete as appropriate)</p>
                    </div>

                    <div class="flex justify-between items-center border-2 border-[#556553] border-opacity-75 p-2 mt-2 text-xs">
                        <h3>Are You:</h3>
                        <div class="form-check">
                            <input
                                class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label inline-block text-gray-800" for="flexRadioDefault1">
                                Male
                            </label>
                        </div>
                        <div class="form-check">
                            <input
                                class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                            <label class="form-check-label inline-block text-gray-800" for="flexRadioDefault2">
                                Female
                            </label>
                        </div>
                        <div>
                            <label for="Post code">Post code</label>
                            <input type="text" class="border-2 border-gray-600 text-black w-14">
                        </div>
                        <div>
                            <label for="Post code">Age</label>
                            <input type="text" class="border-2 border-gray-600 text-black w-14">
                        </div>
                    </div>

                    <div class="w-full inline-block bg-[#639f1e] bg-opacity-75 text-white p-2 mt-2">
                        <h1 class="text-sm">2. How would you rate tdis tdese aspects of tde programme?</h1>
                        <p class="float-right">(Circle tde most appropriate)</p>
                    </div>

                    <table class="w-full mt-2">
                        <tr class="text-xs tracking-tight">
                            <td></td>
                            <td>Very Low[-1]</td>
                            <td>Low[0]</td>
                            <td>Medium[1]</td>
                            <td>High[2]</td>
                        </tr>
                        <tr>
                            <td class="text-xs">a. Quality of coaches;</td>
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
                            <td class="text-xs">b. Importance of competitions;</td>
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
                            <td class="text-xs">c. Your enjoyment;</td>
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

                    <div class="w-full inline-block bg-[#639f1e] bg-opacity-75 text-white p-2 mt-2">
                        <h1 class="text-sm">3. Has tdis programme helped you in tde following school/work related areas?</h1>
                        <p class="float-right">(Circle tde most appropriate)</p>
                    </div>

                    <table class="w-full mt-2">
                        <tr class="text-xs tracking-tight">
                            <td></td>
                            <td>Less likely[-1]</td>
                            <td>Not at all[0]</td>
                            <td>A bit more[1]</td>
                            <td>A lot more[2]</td>
                        </tr>
                        <tr>
                            <td class="text-xs">a. Willingness to go school/work;</td>
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
                            <td class="text-xs">b. Ability to concentrate;</td>
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
                            <td class="text-xs">c. Enjoyment of school/work;</td>
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

                    <div class="w-full inline-block bg-[#639f1e] bg-opacity-75 text-white p-2 mt-2">
                        <h1 class="text-sm">4. Has tdis programme helped you witd tde following areas?</h1>
                        <p class="float-right">(Circle tde most appropriate)</p>
                    </div>

                    <table class="w-full mt-2">
                        <tr class="text-xs tracking-tight">
                            <td></td>
                            <td>Less Likely[-1]</td>
                            <td>Not at all[0]</td>
                            <td>A bit more[1]</td>
                            <td>A lot more[2]</td>
                        </tr>
                        <tr>
                            <td class="text-xs">a. Understanding different people;</td>
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
                            <td class="text-xs">b. Community Pride;</td>
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
                            <td class="text-xs">c. Scottish Pride;</td>
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

                    <div class="w-full inline-block bg-[#639f1e] bg-opacity-75 text-white p-2 mt-2">
                        <h1 class="text-sm">5. Has tdis programme helped you witd making and keeping friends?</h1>
                        <p class="float-right">(Circle tde most appropriate)</p>
                    </div>

                    <table class="w-full mt-2">
                        <tr class="text-xs tracking-tight">
                            <td></td>
                            <td>Less Likely[-1]</td>
                            <td>Not at all[0]</td>
                            <td>A bit more[1]</td>
                            <td>A lot more[2]</td>
                        </tr>
                        <tr>
                            <td class="text-xs">a. Making new friends;</td>
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
                            <td class="text-xs">b. Keeping old friends;</td>
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
                            <td class="text-xs">c. Participating in competitions;</td>
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

                    <div class="w-full inline-block bg-[#639f1e] bg-opacity-75 text-white p-2 mt-2">
                        <h1 class="text-sm">6. Please feel free to add additional comments below:</h1>
                        <textarea name="" class="w-full text-black" id="" cols="30" rows="10"></textarea>
                        <p class="text-center text-[10px]">Be assured tdat all information in tdis questionnaire remain anonymous
                            and confidential.</p>
                    </div>

                </div>
            </div>
            <MasterFooter
                :footerLists="footerLists"
            />
        </div>
    </BreezeAuthenticatedLayout>
</template>
