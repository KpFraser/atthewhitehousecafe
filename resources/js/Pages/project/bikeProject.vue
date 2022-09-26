<script setup>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import MasterFooter from '@/Components/MasterFooter.vue';
    import MasterHeader from '@/Components/MasterHeader.vue';
    import useFooterList from "../../../use/useFooterList";
    import BreezeInput from '@/Components/input.vue';
    import BreezeCheckbox from '@/Components/Checkbox.vue';
    import BreezeLabel from '@/Components/Label.vue';

    import commonFunctions from "@/use/common";
    import { Link } from '@inertiajs/inertia-vue3';

    const { footerLists } = useFooterList();
</script>
<template>
    <BreezeAuthenticatedLayout>
        <div class="flex justify-center bg-white items-center max-w-lg mx-auto font-serif">
            <div class="w-full">
                <MasterHeader/>
                <div class="h-auto mx-auto mb-28">
                    <form> 
                        <div class="flex justify-between p-5">
                            <div class="relative bg-[#639f1e] bg-opacity-75">
                                <div class="absolute ml-[48px] mt-[57px]">
                                    <i class="fas text-[24px] fa-bicycle"></i>
                                </div>
                                <div class="absolute w-10 h-10 bg-[#8ab756] rounded-tl-lg ml-[84px] mt-[74px]">
                                    <i class="far fa-plus p-1 text-[28px]"></i>
                                </div> 
                                <i class="fal fa-camera fa-6x mx-4 my-4"></i>
                            </div>
                            <div class="flex flex-col my-3 justify-between">
                                <div class="bg-[#639f1e] bg-opacity-75">
                                    <Link :href="route('projectshome')" class="text-[28px] flex justify-center p-1 text-center font-bold">
                                        <i class="fas fa-home"></i>
                                    </Link>
                                </div>
                                <div class="bg-[#639f1e] bg-opacity-75">
                                    <Link  class="text-[28px] flex justify-center p-1 text-center font-bold">
                                        <i class="fal fa-save"></i>
                                    </Link>
                                </div>
                            </div>
                        </div>
                        <div class="w-full p-5 mx-auto">
                            <BreezeInput type="text" placeholder="Name" class="w-full p-2  bg-[#639f1e] bg-opacity-75 placeholder:text-black"/>
                            <BreezeInput type="text" placeholder="Phone Number" class="w-full p-2  bg-[#639f1e] bg-opacity-75 placeholder:text-black mt-4"/>
                            <BreezeInput type="text" placeholder="Events" class="w-full p-2  bg-[#639f1e] bg-opacity-75 placeholder:text-black mt-4"/>
                            <div class="bg-[#639f1e] bg-opacity-75 w-full h-auto mt-5 pb-2">
                                <h3 class="font-semibold p-2">Roles</h3>
                                <div class="flex justify-center">
                                    <div>
                                        <div class="flex items-center">
                                            <BreezeCheckbox class="accent-[#639f1e] mr-2 w-4 h-4 border-[#639f1e] text-[16px] hover:text-[#639f1e]"/>
                                            <BreezeLabel value="Leader" />
                                        </div>
                                        <div class="flex items-center">
                                            <BreezeCheckbox class="accent-[#639f1e] mr-2 w-4 h-4 border-[#639f1e] text-[16px] hover:text-[#639f1e]"/>
                                            <BreezeLabel value="Assistant" />
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="bg-[#639f1e] bg-opacity-75 w-full h-auto mt-5 pb-2">
                                <h3 class="font-semibold p-2">Goals</h3>
                                <div class="flex">
                                    <div class="flex mx-auto">
                                        <div class="flex justify-center">
                                            <form class="grid grid-cols-2">
                                                <div class="flex mx-2 items-center">
                                                    <BreezeCheckbox class="accent-[#639f1e] mr-2 w-4 h-4 border-[#639f1e] text-[16px] hover:text-[#639f1e]"/>
                                                    <BreezeLabel class="text-[14px]" value="Bottom Bracket" />
                                                </div>
                                                <div class="flex mx-2 items-center">
                                                    <BreezeCheckbox class="accent-[#639f1e] mr-2 w-4 h-4 border-[#639f1e] text-[16px] hover:text-[#639f1e]"/>
                                                    <BreezeLabel class="text-[14px]" value="New Pedals" />
                                                </div>
                                                <div class="flex mx-2 items-center">
                                                    <BreezeCheckbox class="accent-[#639f1e] mr-2 w-4 h-4 border-[#639f1e] text-[16px] hover:text-[#639f1e]"/>
                                                    <BreezeLabel class="text-[14px]" value="New Saddle" />
                                                </div> 
                                                <div class="flex mx-2 items-center">
                                                    <BreezeCheckbox class="accent-[#639f1e] mr-2 w-4 h-4 border-[#639f1e] text-[16px] hover:text-[#639f1e]"/>
                                                    <BreezeLabel class="text-[14px]" value="Wheel re-build" />
                                                </div>
                                                <div class="flex mx-2 items-center">
                                                    <BreezeCheckbox class="accent-[#639f1e] mr-2 w-4 h-4 border-[#639f1e] text-[16px] hover:text-[#639f1e]"/>
                                                    <BreezeLabel class="text-[14px]" value="Bike assemble" />
                                                </div>  
                                                <div class="flex mx-2 items-center">
                                                    <BreezeCheckbox class="accent-[#639f1e] mr-2 w-4 h-4 border-[#639f1e] text-[16px] hover:text-[#639f1e]"/>
                                                    <BreezeLabel class="text-[14px]" value="Puncture" />
                                                </div> 
                                                <div class="flex mx-2 items-center">
                                                    <BreezeCheckbox class="accent-[#639f1e] mr-2 w-4 h-4 border-[#639f1e] text-[16px] hover:text-[#639f1e]"/>
                                                    <BreezeLabel class="text-[14px]" value="Gears" />
                                                </div> 
                                                <div class="flex mx-2 items-center">
                                                    <BreezeCheckbox class="accent-[#639f1e] mr-2 w-4 h-4 border-[#639f1e] text-[16px] hover:text-[#639f1e]"/>
                                                    <BreezeLabel class="text-[14px]" value="Brakes" />
                                                </div> 
                                                <div class="flex mx-2 items-center">
                                                    <BreezeCheckbox class="accent-[#639f1e] mr-2 w-4 h-4 border-[#639f1e] text-[16px] hover:text-[#639f1e]"/>
                                                    <BreezeLabel class="text-[14px]" value="Truing" />
                                                </div> 
                                                <div class="flex mx-2 items-center">
                                                    <BreezeCheckbox class="accent-[#639f1e] mr-2 w-4 h-4 border-[#639f1e] text-[16px] hover:text-[#639f1e]"/>
                                                    <BreezeLabel class="text-[14px]" value="Broken Spoke" />
                                                </div>  
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="font-semibold p-2">Other</h3>
                                <div class="w-72 mx-auto">
                                    <input type="text" class="border-2 border-black outline-0 focus:border-white focus:ring focus:ring-[#639f1e] focus:ring-opacity-50 bg-[#20351d] bg-opacity-75 w-full focus:ring-0 rounded-md text-white p-1">
                                </div>
                            </div>
                            <div class="bg-[#639f1e] bg-opacity-75 w-full h-auto mt-5 pb-2">
                                <h3 class="font-semibold p-2">Goals</h3>
                                <div class="flex">
                                    <h3 class="ml-2">Estimated</h3>
                                    <h3 class="ml-12">Actual</h3>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
             <MasterFooter
                 :footerLists="footerLists"
             />
        </div>
    </BreezeAuthenticatedLayout>
</template>