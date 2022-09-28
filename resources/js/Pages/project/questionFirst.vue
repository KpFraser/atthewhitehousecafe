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
                        <h3 class="font-bold">Dear Managers,</h3>
                        <p>Please take a few minutes to complete tdis questionnaire.</p>
                    </div>

                    <div class="w-full bg-[#639f1e] bg-opacity-75 flex justify-between items-center text-white p-2">
                        <h1 class="text-lg">1. About Yourself?</h1>
                        <p class="text-sm">(Circle tde most appropriate)</p>
                    </div>

                    <div class="flex justify-between items-center border-2 border-[#556553] border-opacity-75 p-2 mt-2">
                        <h3>Are You:</h3>
                        <div class="form-check">
                            <input
                                class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label inline-block text-gray-800" for="flexRadioDefault1">
                                Interested party
                            </label>
                        </div>
                        <div class="form-check">
                            <input
                                class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                            <label class="form-check-label inline-block text-gray-800" for="flexRadioDefault2">
                                Manager
                            </label>
                        </div>
                        <div class="form-check">
                            <input
                                class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-[#556553] bg-opacity-75 checked:border-[#556553] border-opacity-75 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                            <label class="form-check-label inline-block text-gray-800" for="flexRadioDefault2">
                                Senior Manager
                            </label>
                        </div>
                    </div>

                    <div class="w-full inline-block bg-[#639f1e] bg-opacity-75 text-white p-2 mt-2">
                        <h1>2. How would you rate tde professionalism of tde programme?</h1>
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
                            <td class="text-xs">a. Timeliness of tde sessions;</td>
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
                            <td class="text-xs">b. Commitment of tde coaches;</td>
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
                            <td class="text-xs">c. Conduct of tde coaches;</td>
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
                            <td class="text-xs">d. Overall quality.</td>
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
                        <h1 class="text-sm">3. Please indicate tdese issues of trust between your organisation and ASAP?</h1>
                        <p class="float-right">(Circle tde most appropriate)</p>
                    </div>

                    <table class="w-full mt-2">
                        <tr class="text-xs tracking-tight">
                            <td></td>
                            <td>Never[-1]</td>
                            <td>Reluctantly[0]</td>
                            <td>Some Reservations[1]</td>
                            <td>High[2]</td>
                        </tr>
                        <tr>
                            <td class="text-xs">a. ASAP using your resources;</td>
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
                            <td class="text-xs">b. Recommend ASAP to otders;</td>
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
                            <td class="text-xs">c. Having children participate.</td>
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
                        <h1 class="text-sm">4. Please indicate tde relationship between you organisation and ASAP?</h1>
                        <p class="float-right">(Circle tde most appropriate)</p>
                    </div>

                    <table class="w-full mt-2">
                        <tr class="text-xs tracking-tight">
                            <td></td>
                            <td>Never[-1]</td>
                            <td>Reluctantly[0]</td>
                            <td>Some Reservations[1]</td>
                            <td>High[2]</td>
                        </tr>
                        <tr>
                            <td class="text-[10.5px]">a. Would you work witd ASAP again</td>
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
                        <h1 class="text-sm">5. Please feel free to add additional comments below:</h1>
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
