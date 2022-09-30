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
                <div class="max-w-lg mt-2 mx-auto border-2 border-[#556553] border-opacity-75 p-2">
                    <div>
                        <h3 class="font-bold">Dear Managers,</h3>
                        <p>Please take a few minutes to complete this questionnaire.</p>
                    </div>
                    <div class="w-full bg-[#639f1e] bg-opacity-75 flex justify-between items-center text-white p-2">
                        <h1 class="text-lg">1. About Yourself?</h1>
                        <p class="text-sm">(Circle the most appropriate)</p>
                    </div>
                    <div class="flex justify-between items-center border-2 border-[#556553] border-opacity-75 p-2 mt-2">
                        <h3 class="font-bold">Are You:</h3>
                        <div class="flex text-xs sm:text-sm items-center">
                            <input class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] cursor-pointer" type="radio" name="areYou">
                            <label class="mx-1.5 inline-block text-gray-800">
                                Interested party
                            </label>
                        </div>
                        <div class="flex text-xs sm:text-sm items-center">
                            <input class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] cursor-pointer" type="radio" name="areYou">
                            <label class="mx-1.5 inline-block text-gray-800">
                                Manager
                            </label>
                        </div>
                        <div class="flex text-xs sm:text-sm items-center">
                            <input class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] cursor-pointer" type="radio" name="areYou">
                            <label class="mx-1.5 inline-block text-gray-800">
                                Senior Manager
                            </label>
                        </div>
                    </div>

                    <div class="w-full inline-block bg-[#639f1e] bg-opacity-75 text-white p-2 mt-2">
                        <h1>2. How would you rate the professionalism of tde programme?</h1>
                        <p class="float-right">(Circle the most appropriate)</p>
                    </div>

                    <table class="w-full mt-2">
                        <tr class="text-xs sm:text-sm text-center tracking-tight">
                            <td></td>
                            <td class="text-center">Very Low<br>(-1)</td>
                            <td>Low<br>(0)</td>
                            <td>Medium<br>(1)</td>
                            <td>High<br>(2)</td>
                        </tr>
                        <tr>
                            <td class="text-sm">a. Timeliness of tde sessions;</td>
                            <td class="text-center">
                                <input class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] cursor-pointer" type="radio" name="secondQuestion1">
                            </td>
                            <td class="text-center">
                                <input class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] cursor-pointer" type="radio" name="secondQuestion1">
                            </td>
                            <td class="text-center">
                                <input class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] cursor-pointer" type="radio" name="secondQuestion1">
                            </td>
                            <td class="text-center">
                                <input class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] cursor-pointer" type="radio" name="secondQuestion1">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-xs sm:text-sm">b. Commitment of tde coaches;</td>
                            <td class="text-center">
                                <input class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] cursor-pointer" type="radio" name="secondQuestion12">
                            </td>
                            <td class="text-center">
                                <input class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] cursor-pointer" type="radio" name="secondQuestion2">
                            </td>
                            <td class="text-center">
                                <input class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] cursor-pointer" type="radio" name="secondQuestion2">
                            </td>
                            <td class="text-center">
                                <input class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] cursor-pointer" type="radio" name="secondQuestion2">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-xs sm:text-sm">c. Conduct of tde coaches;</td>
                            <td class="text-center">
                                <input class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] cursor-pointer" type="radio" name="secondQuestion3">
                            </td>
                            <td class="text-center">
                                <input class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] cursor-pointer" type="radio" name="secondQuestion3">
                            </td>
                            <td class="text-center">
                                <input class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] cursor-pointer" type="radio" name="secondQuestion3">
                            </td>
                            <td class="text-center">
                                <input class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] cursor-pointer" type="radio" name="secondQuestion3">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-xs sm:text-sm">d. Overall quality.</td>
                            <td class="text-center">
                                <input class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] cursor-pointer" type="radio" name="secondQuestion4">
                            </td>
                            <td class="text-center">
                                <input class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] cursor-pointer" type="radio" name="secondQuestion4">
                            </td>
                            <td class="text-center">
                                <input class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] cursor-pointer" type="radio" name="secondQuestion4">
                            </td>
                            <td class="text-center">
                                <input class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] cursor-pointer" type="radio" name="secondQuestion4">
                            </td>
                        </tr>
                    </table>
                    <div class="w-full inline-block bg-[#639f1e] bg-opacity-75 text-white p-2 mt-2">
                        <h1 class="text-sm">3. Please indicate tdese issues of trust between your organisation and ASAP?</h1>
                        <p class="float-right">(Circle tde most appropriate)</p>
                    </div>

                    <table class="w-full mt-2">
                        <tr class="text-xs sm:text-sm text-center tracking-tight">
                            <td></td>
                            <td>Never<br>(-1)</td>
                            <td>Reluctantly<br>(0)</td>
                            <td>Some Reservations<br>(1)</td>
                            <td>High<br>(2)</td>
                        </tr>
                        <tr>
                            <td class="text-xs sm:text-sm">a. ASAP using your resources;</td>
                            <td class="text-center">
                                <input class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] cursor-pointer" type="radio" name="secondQuestion5">
                            </td>
                            <td class="text-center">
                                <input class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] cursor-pointer" type="radio" name="secondQuestion5">
                            </td>
                            <td class="text-center">
                                <input class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] cursor-pointer" type="radio" name="secondQuestion5">
                            </td>
                            <td class="text-center">
                                <input class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] cursor-pointer" type="radio" name="secondQuestion5">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-xs sm:text-sm">b. Recommend ASAP to otders;</td>
                            <td class="text-center">
                                <input class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] cursor-pointer" type="radio" name="secondQuestion6">
                            </td>
                            <td class="text-center">
                                <input class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] cursor-pointer" type="radio" name="secondQuestion6">
                            </td>
                            <td class="text-center">
                                <input class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] cursor-pointer" type="radio" name="secondQuestion6">
                            </td>
                            <td class="text-center">
                                <input class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] cursor-pointer" type="radio" name="secondQuestion6">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-xs sm:text-sm">c. Having children participate.</td>
                            <td class="text-center">
                                <input class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] cursor-pointer" type="radio" name="secondQuestion7">
                            </td>
                            <td class="text-center">
                                <input class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] cursor-pointer" type="radio" name="secondQuestion7">
                            </td>
                            <td class="text-center">
                                <input class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] cursor-pointer" type="radio" name="secondQuestion7">
                            </td>
                            <td class="text-center">
                                <input class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] cursor-pointer" type="radio" name="secondQuestion7">
                            </td>
                        </tr>
                    </table>
                    <div class="w-full inline-block bg-[#639f1e] bg-opacity-75 text-white p-2 mt-2">
                        <h1 class="text-sm">4. Please indicate tde relationship between you organisation and ASAP?</h1>
                        <p class="float-right">(Circle tde most appropriate)</p>
                    </div>
                    <table class="w-full mt-2">
                        <tr class="text-xs sm:text-sm text-center tracking-tight">
                            <td></td>
                            <td>Never<br>(-1)</td>
                            <td>Reluctantly<br>(0)</td>
                            <td>Some Reservations<br>(1)</td>
                            <td>High<br>(2)</td>
                        </tr>
                        <tr>
                            <td class="text-[10.5px]">a. Would you work witd ASAP again</td>
                            <td class="text-center">
                                <input class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] cursor-pointer" type="radio" name="secondQuestion8">
                            </td>
                            <td class="text-center">
                                <input class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] cursor-pointer" type="radio" name="secondQuestion8">
                            </td>
                            <td class="text-center">
                                <input class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] cursor-pointer" type="radio" name="secondQuestion8">
                            </td>
                            <td class="text-center">
                                <input class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] cursor-pointer" type="radio" name="secondQuestion8">
                            </td>
                        </tr>



                    </table>

                    <div class="w-full inline-block bg-[#639f1e] bg-opacity-75 text-white p-2 mt-2">
                        <h1 class="text-sm">5. Please feel free to add additional comments below:</h1>
                        <textarea name="" class="w-full text-black" id="" cols="30" rows="10"></textarea>
                        <p class="text-center text-[10px]">Be assured tdat all information in tdis questionnaire remain anonymous and confidential.
                        </p>
                    </div>

                </div>
            </div>
            <MasterFooter
                :footerLists="footerLists"
            />
        </div>
    </BreezeAuthenticatedLayout>
</template>
