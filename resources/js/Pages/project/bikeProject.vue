<script setup>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import MasterFooter from '@/Components/MasterFooter.vue';
    import MasterHeader from '@/Components/MasterHeader.vue';
    import useFooterList from "../../../use/useFooterList";
    import BreezeInput from '@/Components/input.vue';
    import BreezeCheckbox from '@/Components/Checkbox.vue';
    import BreezeLabel from '@/Components/Label.vue';
    import { Link } from '@inertiajs/inertia-vue3';
    import {onMounted, ref} from "vue";
    import BreezeButton from '@/Components/Button.vue';

    const { footerLists } = useFooterList();

    const goals = ref({}),
        bikeInformation = ref({id: ''}),
        bikeItem = ref({}),
        checkGoals = ref({}),
        btnProcessing = ref({ processing: false }),
        isActive = ref(1),
        url =  ref()

    const onFileChange = (e) =>{
        const file = e.target.files[0];
        bikeInformation.value.image = file.name
        url.value = URL.createObjectURL(file);
    }

    const bikeInfo = () =>{
        axios
            .get('/bike-show')
            .then((response)=>{
                goals.value = response.data
            })
    }

    const bikeAllInfo = () =>{
        // btnProcessing.value.processing = true
        const queryString = window.location.href.split('/')[4]
        bikeInformation.value.project_slug = queryString
        axios
            .post('/bike-all-information', {bike: bikeInformation.value, check: checkGoals.value})
            .then((response)=>{
                console.log(response)
                btnProcessing.value.processing = false
            })
    }



    onMounted(()=>{
        bikeInfo ()
    })
</script>
<template>
    <BreezeAuthenticatedLayout>
        <div class="flex justify-center bg-white items-center max-w-lg mx-auto font-serif">
            <div class="w-full">
                <MasterHeader/>
                <div class="h-auto mx-auto mb-28">
                    <form>
                        <div class="flex justify-between p-5">
                            <div class="relative flex cursor-pointer overflow-hidden ">
                                <label class="cursor-pointer bg-[#639f1e] bg-opacity-75" for="bikeinput">
                                    <input class="hidden"  @change="onFileChange" id="bikeinput" type="file">
                                    <div>
                                        <div class="absolute ml-[48px] mt-[57px]">
                                            <i class="fas text-[24px] fa-bicycle"></i>
                                        </div>
                                        <div class="absolute w-10 h-10 bg-[#8ab756] rounded-tl-lg ml-[84px] mt-[74px]">
                                            <i class="far fa-plus p-1 text-[28px]"></i>
                                        </div>
                                        <i class="fal fa-camera fa-6x mx-4 my-4"></i>
                                    </div>
                                </label>
                                <div id="preview" class="ml-4">
                                    <img  class="w-32 h-32" v-if="url" :src="url" />
                                </div>
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
                            <BreezeInput v-model="bikeInformation.name" type="text" placeholder="Name" class="w-full p-2 bg-[#639f1e] bg-opacity-75"/>
                            <BreezeInput v-model="bikeInformation.phone" type="text" placeholder="Phone Number" class="w-full p-2  bg-[#639f1e] bg-opacity-75 mt-4"/>
                            <BreezeInput type="text" placeholder="Events" class="w-full p-2  bg-[#639f1e] bg-opacity-75 mt-4"/>
                            <div class="bg-[#639f1e] bg-opacity-75 w-full h-auto mt-5">
                                <h3 class="font-semibold p-2">stages</h3>
                                <ul class="w-full uppercase flex">
                                    <li class="cursor-pointer w-1/4">
                                        <a @click="(isActive=1)" :class="{'bg-[#20351d] !text-white': isActive === 1 }" class="text-[15px] text-center border-opacity-75 border-[#20351d] bg-opacity-75 block text-[#20351d] border-b-2 px-6 py-3 active">
                                            One
                                        </a>
                                    </li>
                                    <li class="cursor-pointer w-1/4">
                                        <a @click="(isActive=2)" :class="{'bg-[#20351d] !text-white': isActive === 2 }" class="text-[15px] text-center border-opacity-75 border-[#20351d] bg-opacity-75 block text-[#20351d] border-b-2 px-6 py-3">
                                            Two
                                        </a>
                                    </li>
                                    <li class="cursor-pointer w-1/4">
                                        <a @click="(isActive=3)" :class="{'bg-[#20351d] !text-white': isActive === 3 }" class="text-[15px] text-center border-opacity-75 border-[#20351d] bg-opacity-75 block text-[#20351d] border-b-2 px-6 py-3">
                                            Three
                                        </a>
                                    </li>
                                    <li class="cursor-pointer w-1/4">
                                        <a @click="(isActive=4)" :class="{'bg-[#20351d] !text-white': isActive === 4 }" class="text-[15px] text-center border-opacity-75 border-[#20351d] bg-opacity-75 block text-[#20351d] border-b-2 px-6 py-3">
                                            Four
                                        </a>
                                    </li>
                                </ul>
                                <div class="h-80 bg-white border-8 border-[#639f1e] border-opacity-75">
                                    <div class="max-w-lg mx-auto">
                                        <div :class="{'hidden': isActive === 2 || isActive === 3 || isActive === 4 }">
                                            <div class="grid grid-cols-2 gap-4 p-10">
                                                <div class="">
                                                    <BreezeLabel value="ITEM" />
                                                    <BreezeInput placeholder="name" v-model="bikeItem.name" type="text" class="!placeholder-gray-400 p-2 bg-[#639f1e] bg-opacity-75"/>
                                                </div>
                                                <div class="">
                                                    <BreezeLabel value="Cost(£)" />
                                                    <BreezeInput placeholder="" type="number" v-model="bikeItem.cost" class="!placeholder-gray-400 p-2 bg-[#639f1e] bg-opacity-75"/>
                                                </div>
                                            </div>
                                            <div class="px-10 flex space-x-6 items-center">
                                                <BreezeLabel value="Total(£):" />
                                                <BreezeInput disabled v-model="bikeItem.cost" type="number" class="!placeholder-gray-400 p-2 bg-[#639f1e] bg-opacity-75"/>
                                            </div>
                                        </div>
                                        <div :class="{'hidden': isActive === 1 || isActive === 3 || isActive === 4 }">
                                            <div class="grid grid-cols-2 gap-4 p-10">
                                                <div class="">
                                                    <BreezeLabel value="ITEM" />
                                                    <BreezeInput disabled type="text" v-model="bikeItem.name" class="!placeholder-gray-400 p-2 bg-[#639f1e] bg-opacity-75"/>
                                                </div>
                                                <div class="">
                                                    <BreezeLabel value="Cost(£)" />
                                                    <BreezeInput type="number" disabled v-model="bikeItem.cost" class="!placeholder-gray-400 p-2 bg-[#639f1e] bg-opacity-75"/>
                                                </div>
                                            </div>
                                            <div class="px-10 flex space-x-6 items-center">
                                                <BreezeLabel value="Total(£):" />
                                                <BreezeInput type="number" disabled v-model="bikeItem.cost" class="!placeholder-gray-400 p-2 bg-[#639f1e] bg-opacity-75"/>
                                            </div>
                                        </div>
                                        <div :class="{'hidden': isActive === 1 || isActive === 2 || isActive === 4 }">
                                            <div class="p-10 space-y-6">
                                                <BreezeLabel value="Time" />
                                                <BreezeInput class="!placeholder-gray-400 p-2 bg-[#639f1e] bg-opacity-75"/>
                                                <BreezeLabel value="Material" />
                                                <BreezeInput class="!placeholder-gray-400 p-2 bg-[#639f1e] bg-opacity-75"/>
                                            </div>
                                        </div>
                                        <div :class="{'hidden': isActive === 1 || isActive === 2 || isActive === 3 }">
                                            <div class="p-10">
                                                <BreezeLabel value="Customer Comment:" />
                                                <BreezeInput placeholder="comment..." v-model="bikeItem.comment" type="text" class="!placeholder-gray-400 p-2 bg-[#639f1e] bg-opacity-75"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-[#639f1e] bg-opacity-75 w-full h-auto mt-5 pb-2">
                                <h3 class="font-semibold p-2">Roles</h3>
                                <div class="flex justify-center">
                                    <div CLASS="grid grid-cols-2 mx-5 gap-4">
                                        <div class="flex items-center">
                                            <BreezeLabel value="Leader:" />
                                            <BreezeInput v-model="bikeInformation.leader" type="text" class="w-32 ml-2 h-10 p-2 bg-[#639f1e] bg-opacity-75"/>
                                        </div>
                                        <div class="flex items-center">
                                            <BreezeLabel value="Assistant" />
                                            <BreezeInput v-model="bikeInformation.assistant" type="text" class="w-32 ml-2 h-10 p-2 bg-[#639f1e] bg-opacity-75"/>
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
                                                <div class="flex mx-2 items-center space-y-2" v-for="goal in goals">
                                                    <BreezeCheckbox v-model="checkGoals[goal.id]" id="{{goal.id}}" class="accent-[#639f1e] mr-2 w-4 h-4 border-[#639f1e] text-[16px] hover:text-[#639f1e]"/>
                                                    <label class="block font-medium text-gray-700 text-[14px]">{{goal.name}}</label>
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
                                <h3 class="font-semibold p-2">Cost</h3>
                                <div class="grid grid-cols-2 gap-4 mx-4">
                                    <div>
                                        <BreezeLabel value="Estimated" />
                                        <BreezeInput type="number" v-model="bikeInformation.estimated_cost" class="!placeholder-gray-400 p-2 bg-[#639f1e] bg-opacity-75"/>
                                    </div>
                                    <div>
                                        <BreezeLabel value="Actual" />
                                        <BreezeInput type="number" v-model="bikeInformation.actual_cost" class="!placeholder-gray-400 p-2 bg-[#639f1e] bg-opacity-75"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="px-5">
                        <BreezeButton @click="bikeAllInfo()" class="bg-[#639f1e] bg-opacity-75 text-white w-full font-sans submit mx-auto py-3 justify-center text-[25px] font-bold" :class="{ 'opacity-25': btnProcessing.processing }" :disabled="btnProcessing.processing">
                            Save
                        </BreezeButton>
                    </div>
                </div>
            </div>
             <MasterFooter
                 :footerLists="footerLists"
             />
        </div>
    </BreezeAuthenticatedLayout>
</template>
<style>
#preview {
    display: flex;
    justify-content: center;
    align-items: center;
}

#preview img {
    max-width: 100%;
    max-height: 500px;
}
</style>
