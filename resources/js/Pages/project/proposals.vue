<script setup>
import MasterFooter from '@/Components/MasterFooter.vue';
import MasterHeader from '@/Components/MasterHeader.vue';
import useFooterList from "../../../use/useFooterList";
import {ref, onMounted } from "vue";
import { Link } from '@inertiajs/inertia-vue3';
import commonFunctions from "@/use/common";
import {Inertia} from "@inertiajs/inertia";

const { Toast } = commonFunctions(),
    { footerLists } = useFooterList()

const isActive = ref(0)
const subTabActive = ref(0)
const day = ref(0)

const activeTab = (tab) =>{
    isActive.value = tab
}

const subTab = (tab) =>{
    subTabActive.value = tab
}

const selectDay = (tab) =>{
    console.log(tab)
    day.value = tab
}

onMounted(()=>{
})

</script>


<template>
    <div class="flex justify-center bg-white items-center max-w-lg mx-auto font-serif">
        <div class="w-full">
            <MasterHeader/>
<!--            <div class="flex justify-between px-10">-->
<!--                <div class="flex justify-end my-6">-->
<!--                    <Link class="text-[25px] bg-[#639f1e] p-1 text-center font-bold bg-opacity-75">-->
<!--                        <i class="fas fa-home px-1"></i>-->
<!--                    </Link>-->
<!--                </div>-->
<!--                <div class="flex justify-end my-6">-->
<!--                    <div @click="newBike()" class="text-[25px] bg-[#639f1e] cursor-pointer p-1 text-center font-bold bg-opacity-75">-->
<!--                        <i class="fas fa-plus px-1.5"></i>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
            <div class="text-black mt-4 border-4 border-b-4 border-[#20351d] border-opacity-75 mb-28 space-y-4 bg-white text-lg">
                <ul class="w-full flex justify-between">
                    <li @click="activeTab(1)" :class="{'bg-opacity-100': isActive === 1 }" class="w-[20%] m-1 cursor-pointer bg-[#639f1e] bg-opacity-75 rounded p-2 text-center">
                        <i class="text-[46px] fas fa-cog"></i>
                    </li>
                    <li @click="activeTab(2)" :class="{'bg-opacity-100': isActive === 2 }" class="w-[20%] m-1 cursor-pointer bg-[#639f1e] bg-opacity-75 rounded p-2 text-center">
                        <i class="text-[46px] fas fa-hand-holding-usd"></i>
                    </li>
                    <li @click="activeTab(3)" :class="{'bg-opacity-100': isActive === 3 }" class="w-[20%] m-1 cursor-pointer bg-[#639f1e] bg-opacity-75 rounded p-2 text-center">
                        <i class="text-[46px] fas fa-volume-up"></i>
                    </li>
                    <li @click="activeTab(4)" :class="{'bg-opacity-100': isActive === 4 }" class="w-[20%] m-1 cursor-pointer bg-[#639f1e] bg-opacity-75 rounded p-2 text-center">
                        <div class="text-[46px] relative">
                            <i class="fas fa-search"></i>
<!--                            <i class="fas fa-user absolute text-[16px] top-[10px] left-[19px]"></i>-->
                        </div>
                    </li>
                    <li class="w-[20%] m-1 cursor-pointer bg-[#639f1e] bg-opacity-75 rounded p-2 text-center">
                        <i class="text-[46px] fas fa-home"></i>
                    </li>
                </ul>
                <div class="bg-white h-[700px] max-w-lg mx-auto">
                    <div class="h-[700px]" :class="{'hidden': isActive !== 1 }" >
                        <div class="">
                            <ul class="w-full grid grid-cols-5">
                                <li @click="subTab(1)" :class="{'bg-opacity-100': subTabActive === 1 }" class=" m-1 cursor-pointer bg-[#639f1e] bg-opacity-75 rounded p-2 text-center">
                                    <i class="text-[46px] fas fa-map-marker-alt"></i>
                                </li>
                                <li @click="subTab(2)" :class="{'bg-opacity-100': subTabActive === 2 }" class=" m-1 cursor-pointer bg-[#639f1e] bg-opacity-75 rounded p-2 text-center">
                                    <i class="text-[46px] fas fa-asterisk"></i>
                                </li>
                                <li @click="subTab(3)" :class="{'bg-opacity-100': subTabActive === 3 }" class=" m-1 cursor-pointer bg-[#639f1e] bg-opacity-75 rounded p-2 text-center">
                                    <i class="text-[46px] fas fa-hard-hat"></i>
                                </li>
                            </ul>
                            <div class="" :class="{'hidden': subTabActive !== 1 }">
                                <div class="overflow-y-auto p-4 h-[625px] border-4">
                                    <div class="bg-white">
                                        <input type="text" class="bg-gray-200 p-2 mt-2 w-full rounded-md" placeholder="Address1">
                                        <input type="text" class="bg-gray-200 p-2 mt-2 w-full rounded-md" placeholder="Address2">
                                        <input type="text" class="bg-gray-200 p-2 mt-2 w-full rounded-md" placeholder="City">
                                        <input type="text" class="bg-gray-200 p-2 mt-2 w-full rounded-md" placeholder="Post code">
                                        <input type="text" class="bg-gray-200 p-2 mt-2 w-full rounded-md" placeholder="Country">
                                        <div class="flex items-center justify-between mt-3">
                                            <h3>Repeat Every: </h3>
                                            <input type="text" class="outline-none border-b-2">
                                            <select class="form-select appearance-none w-24 block px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example">
                                                <option selected>Week</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                        <h3 class="font-semibold">Repeat on: </h3>
                                        <div class="flex items-center my-2">
                                            <span @click="selectDay(1)" :class="{'!bg-[#639f1e]': day === 1}" class="w-8 h-8 rounded-full bg-gray-200 text-center py-1 cursor-pointer">M</span>
                                            <span @click="selectDay(2)" :class="{'!bg-[#639f1e]': day === 2}" class="w-8 h-8 rounded-full bg-gray-200 text-center py-1 ml-2 cursor-pointer">T</span>
                                            <span @click="selectDay(3)" :class="{'!bg-[#639f1e]': day === 3}" class="w-8 h-8 rounded-full bg-gray-200 text-center py-1 ml-2 cursor-pointer">W</span>
                                            <span @click="selectDay(4)" :class="{'!bg-[#639f1e]': day === 4}" class="w-8 h-8 rounded-full bg-gray-200 text-center py-1 ml-2 cursor-pointer">T</span>
                                            <span @click="selectDay(5)" :class="{'!bg-[#639f1e]': day === 5}" class="w-8 h-8 rounded-full bg-gray-200 text-center py-1 ml-2 cursor-pointer">F</span>
                                            <span @click="selectDay(6)" :class="{'!bg-[#639f1e]': day === 6}" class="w-8 h-8 rounded-full bg-gray-200 text-center py-1 ml-2 cursor-pointer">S</span>
                                            <span @click="selectDay(7)" :class="{'!bg-[#639f1e]': day === 7}" class="w-8 h-8 rounded-full bg-gray-200 text-center py-1 ml-2 cursor-pointer">S</span>
                                        </div>
                                        <h3 class="font-semibold">Ends: </h3>
                                       <div class="space-y-4">
                                           <div class="flex items-center">
                                               <input class="rounded-full border border-gray-300 bg-white cursor-pointer" type="radio" id="never" name="date" >
                                               <label class="inline-block text-gray-800" for="never">
                                                   Never
                                               </label>
                                           </div>
                                           <div class="flex justify-between items-center">
                                               <div class="flex items-center">
                                                   <input class="border border-gray-300 bg-white cursor-pointer" type="radio" id="ondate" name="date">
                                                   <label class="inline-block text-gray-800" for="ondate">on</label>
                                               </div>
                                               <input type="date" class="w-40 h-12 bg-gray-200 rounded-md px-3 -my-5">
                                           </div>
                                           <div class="flex items-center justify-between">
                                               <div class="flex items-center">
                                                   <input class="border border-gray-300 bg-white cursor-pointer" type="radio" name="tilldate" id="date">
                                                   <label class="inline-block text-gray-800" for="tilldate">After</label>
                                               </div>
                                               <input type="date" class="w-40 h-12 bg-gray-200 rounded-md px-3 mt-2">
                                           </div>
                                           <div class="flex float-right">
                                               <div class="cursor-pointer">Cancel</div>
                                               <div class="ml-5 cursor-pointer text-[#639f1e] font-semibold">Done</div>
                                           </div>
                                       </div>
                                    </div>
                                </div>
                            </div>
                            <div class="" :class="{'hidden': subTabActive !== 2 }">
                                <div class="overflow-y-auto p-4 h-[625px] border-4">
                                    <p class="text-sm">
                                        Risk assessment is about deciding what could go wrong and determining what you need to do to prevent that happening. It is not possible to completely eliminate all risks. But we endeavour to remove risk to its lowest level compatible with the enjoyment of the activity.
                                    </p>
                                    <table class="my-5 w-full">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="border-gray-800 text-center border-4 text-sm font-medium bg-[#639f1e] bg-opacity-75 p-4">
                                                    <i class="text-[20px] fas fa-exclamation-triangle "></i>
                                                    <div class="text-[18px]">Hazards</div>
                                                </th>
                                                <th scope="col" class="border-gray-800 text-center border-4 text-sm font-medium bg-[#639f1e] bg-opacity-75 p-4">
                                                    <i class="text-[20px] fas fa-tachometer"></i>
                                                    <div class="text-[18px]">Risks</div>
                                                </th>
                                                <th scope="col" class="border-gray-800 text-center border-4 bg-[#639f1e] bg-opacity-75  text-sm font-medium p-4">
                                                    <i class="text-[20px] fas fa-cog"></i>
                                                    <div class="text-[18px]">Control</div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="rounded-md">
                                            <tr>
                                                <td class="text-[14px] text-red-800 font-semibold pl-2 py-4 border-gray-800 border-4">
                                                    Traveling
                                                </td>
                                                <td class="text-[14px] text-red-800 font-semibold pl-2 py-4 border-gray-800 border-4">
                                                    Car Accident
                                                </td>
                                                <td class="text-[14px] text-red-800 font-semibold pl-2 py-4 border-gray-800 border-4">
                                                    <ol>
                                                        <li>a. Cars are MOTed</li>
                                                        <li>b. Drivers are insured</li>
                                                        <li>c. etc..</li>
                                                    </ol>
                                                </td>
                                            </tr>
                                            <tr class="bg-white border-b">
                                                <td class="text-sm font-light px-6 py-4 border-gray-800 border-4">
                                                </td>
                                                <td class="text-sm font-light px-6 py-4 border-gray-800 border-4">
                                                </td>
                                                <td class="text-sm font-light px-6 py-4 border-gray-800 border-4">
                                                </td>
                                            </tr>
                                            <tr class="bg-white border-b">
                                                <td class="text-sm font-light px-6 py-4 border-gray-800 border-4">
                                                </td>
                                                <td class="text-sm font-light px-6 py-4 border-gray-800 border-4">
                                                </td>
                                                <td class="text-sm font-light px-6 py-4 border-gray-800 border-4">
                                                </td>
                                            </tr>
                                            <tr class="bg-white border-b">
                                                <td class="text-sm font-light px-6 py-4 border-gray-800 border-4">
                                                </td>
                                                <td class="text-sm font-light px-6 py-4 border-gray-800 border-4">
                                                </td>
                                                <td class="text-sm font-light px-6 py-4 border-gray-800 border-4">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="" :class="{'hidden': subTabActive !== 3 }">
                                <div class="overflow-y-auto p-4 h-[625px] border-4">
                                    <div class="bg-white space-y-2 rounded-xl p-5">
                                        <div class="flex space-x-4 mr-1 justify-end">
                                            <label>Yes</label>
                                            <label>No</label>
                                        </div>
                                        <div class="grid grid-cols-5 items-center">
                                            <label type="text" class="col-span-4 bg-gray-200 border-2 focus:outline-none w-full p-2 rounded">Do you work with vulnerable?</label>
                                            <div class="flex ml-3 justify-around">
                                                <input class="border bg-gray-200 checked:bg-blue-600 cursor-pointer" type="radio" name="flexRadioDefault1" id="flexRadioDefault1">
                                                <input class="border bg-gray-200 checked:bg-blue-600 cursor-pointer" type="radio" name="flexRadioDefault1" id="flexRadioDefault2">
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-5 items-center">
                                            <label type="text" class="col-span-4 bg-gray-200 border-2 focus:outline-none w-full p-2 rounded">Do you have public liability?</label>
                                            <div class="flex ml-3 justify-around">
                                                <input class="border bg-gray-200 checked:bg-blue-600 cursor-pointer" type="radio" name="flexRadioDefault1" id="flexRadioDefault1">
                                                <input class="border bg-gray-200 checked:bg-blue-600 cursor-pointer" type="radio" name="flexRadioDefault1" id="flexRadioDefault2">
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-5 items-center">
                                            <label type="text" class="col-span-4 bg-gray-200 border-2 focus:outline-none w-full p-2 rounded">Do you have employers liability?</label>
                                            <div class="flex ml-3 justify-around">
                                                <input class="border bg-gray-200 checked:bg-blue-600 cursor-pointer" type="radio" name="flexRadioDefault1" id="flexRadioDefault1">
                                                <input class="border bg-gray-200 checked:bg-blue-600 cursor-pointer" type="radio" name="flexRadioDefault1" id="flexRadioDefault2">
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-5 items-center">
                                            <label type="text" class="col-span-4 bg-gray-200 border-2 focus:outline-none w-full p-2 rounded">Do you work with vulnerable?</label>
                                            <div class="flex ml-3 justify-around">
                                                <input class="border bg-gray-200 checked:bg-blue-600 cursor-pointer" type="radio" name="flexRadioDefault1" id="flexRadioDefault1">
                                                <input class="border bg-gray-200 checked:bg-blue-600 cursor-pointer" type="radio" name="flexRadioDefault1" id="flexRadioDefault2">
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-5 items-center">
                                            <label type="text" class="col-span-3 bg-gray-200 border-2 focus:outline-none w-full p-2 rounded">If yes when does it expire?</label>
                                            <div class="flex h-11 col-span-2 justify-around">
                                                <input type="date" class="p-3 bg-gray-200 rounded ml-3">
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-5 items-center">
                                            <label type="text" for="insurance" class="col-span-3 bg-gray-200 border-2 focus:outline-none w-full p-2 rounded">Upload insurance documents</label>
                                            <input type="file" class="hidden" id="insurance">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="h-[700px] overflow-y-auto" :class="{'hidden': isActive !== 2 }">
                        <div class="w-full h-auto pb-2 mb-4 mt-2">
                            <div class="bg-white rounded-xl p-5">
                                <div class="flex justify-between">
                                    <input type="text" class="bg-gray-200 border-2 focus:outline-none w-full p-2 rounded" placeholder="Do you accept lottery funding?">
                                    <div class="flex justify-between ml-2">
                                        <div class="">
                                            <label class="inline-block" for="yes">Yes</label>
                                            <input id="yes" class="rounded-none h-4 w-4 border bg-gray-200 checked:bg-blue-600 cursor-pointer" type="radio" name="flexRadioDefault">
                                        </div>
                                        <div class="">
                                            <label class="inline-block" for="no">No</label>
                                            <input id="no" class="rounded-none h-4 w-4 border bg-gray-200 checked:bg-blue-600 cursor-pointer" type="radio" name="flexRadioDefault">
                                        </div>
                                    </div>
                                </div>
                                <input type="text" class=" bg-gray-200 border-2 focus:outline-none w-full p-2 rounded mt-3" placeholder="What are your funding streams?">
                                <textarea name="" id="" class="w-full border-2 mt-3 bg-gray-200 rounded-md" cols="30" rows="6"></textarea>
                                <input type="text" class=" bg-gray-200 border-2 focus:outline-none w-full p-2 rounded mt-3" placeholder="What are your funding streams?">
                                <textarea name="" id="" class="w-full border-2 mt-3 bg-gray-200 rounded-md" cols="30" rows="6"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="h-[700px] overflow-y-auto" :class="{'hidden': isActive !== 3 }">
                        <div class="w-full h-auto pb-2 mb-4 mt-2">
                            <div class="bg-white rounded-xl p-5">
                                <p class="text-sm text-center">Please provide your scial media channels</p>
                                <div class="flex mt-2 items-center">
                                    <i class="fas fa-globe w-16 fa-2x text-[#639f1e]"></i>
                                    <input type="text" class="w-full ml-3 border-2 bg-gray-200">
                                </div>
                                <div class="flex mt-2 items-center">
                                    <i class="fab fa-facebook w-16 fa-2x text-[#639f1e]"></i>
                                    <input type="text" class="w-full ml-3 border-2 bg-gray-200">
                                </div>
                                <div class="flex mt-2 items-center">
                                    <i class="fab fa-twitter w-16 fa-2x text-[#639f1e]"></i>
                                    <input type="text" class="w-full ml-3 border-2 bg-gray-200">
                                </div>
                                <div class="flex mt-2 items-center">
                                    <i class="fab fa-instagram w-16 fa-2x text-[#639f1e]"></i>
                                    <input type="text" class="w-full ml-3 border-2 bg-gray-200">
                                </div>
                                <div class="flex mt-2 items-center">
                                    <i class="fab fa-meetup w-16 fa-2x text-[#639f1e]"></i>
                                    <input type="text" class="w-full ml-3 border-2 bg-gray-200">
                                </div>
                                <div class="flex mt-2 items-center">
                                    <i class="fab fa-youtube w-16 fa-2x text-[#639f1e]"></i>
                                    <input type="text" class="w-full ml-3 border-2 bg-gray-200">
                                </div>
                                <div>
                                    <h3 class="text-center">Anyothers</h3>
                                    <textarea name="" id="" class="w-full border-2 bg-gray-200" cols="30"
                                        rows="6"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="h-[700px] overflow-y-auto" :class="{'hidden': isActive !== 4 }">
                        <div class="w-full h-auto pb-2 mb-4 mt-2">
                            <div class="bg-white rounded-xl p-5">
                                <p class="text-lg text-gray-400">Who are your leadership team</p>
                                <textarea class="w-full border-2 bg-gray-200 mt-5 rounded-xl placeholder:text-center" cols="30"
                                    rows="6" placeholder="organisers"></textarea>
                                <textarea class="w-full border-2 bg-gray-200 mt-5 rounded-xl placeholder:text-center" cols="30"
                                    rows="6" placeholder="Leaders"></textarea>
                                <textarea class="w-full border-2 bg-gray-200 mt-5 rounded-xl placeholder:text-center" cols="30"
                                    rows="6" placeholder="Assistances"></textarea>
                                <textarea class="w-full border-2 bg-gray-200 mt-5 rounded-xl placeholder:text-center" cols="30"
                                    rows="6" placeholder="Mentors"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <MasterFooter
            :footerLists="footerLists"
        />
    </div>
</template>
