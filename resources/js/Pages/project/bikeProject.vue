<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import MasterFooter from '@/Components/MasterFooter.vue';
import MasterHeader from '@/Components/MasterHeader.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeCheckbox from '@/Components/Checkbox.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeButton from '@/Components/Button.vue';
import useFooterList from "../../../use/useFooterList";
import {onMounted, reactive, ref} from "vue";
import commonFunctions from "@/use/common";
import {Inertia} from "@inertiajs/inertia";

const { Toast } = commonFunctions(),
        { footerLists } = useFooterList();

    const bike = ref({id: '', image: '', system_name: '', name: '', project_slug: '', phone: '', estimated_total: '', middle_total: '', actual_total: '', rating: '', leader: '', assistant: '', checkGoals: {}, estimated_costs: [{item_name: '', cost: '', id: ''}], middle_costs: [{item_name: '', cost: '', id: ''}], actual_costs: [{item_name: '', cost: '', id: ''}]}),
        processing = reactive ({process: false}),
        goals = ref({}),
        isActive = ref(1),
        errors = reactive({}),
        url =  ref(),
        baseUrl = window.location.origin

    const onFileChange = (e) => {

        const file = e.target.files[0];
        bike.value.image = file
        url.value = URL.createObjectURL(file);
        bike.value.show = false
        errors.image = ''
        if(bike.value.system_name === ''){

        }
    }

    const bikeInfo = () =>{
        let queryString = window.location.href.split('/')[5]
        if (queryString !== ''){
        axios
            .get('/bike-show/'+queryString)
            .then((response)=>{
                if (response?.data?.bike_items?.length >0){
                    bike.value.estimated_costs = response.data.bike_items.filter(x => x.stage_id === 1)
                    bike.value.middle_costs = response.data.bike_items.filter(x => x.stage_id === 2)
                    bike.value.actual_costs = response.data.bike_items.filter(x => x.stage_id === 3)
                    totalEstimate ()
                    totalMiddle ()
                    totalActual ()
                }

                if(response.data.bike !== ''){

                    bike.value.id = !!response.data?.bike?.id ? response.data?.bike?.id:''
                    bike.value.phone = !!response.data?.bike?.mobile ? response.data?.bike?.mobile:''
                    bike.value.name = !!response.data?.bike?.name ? response.data?.bike?.name:''
                    bike.value.leader = !!response.data?.bike?.leader ? response.data?.bike?.leader:''
                    bike.value.assistant = !!response.data?.bike?.assistant ? response.data?.bike?.assistant:''
                    bike.value.rating = !!response.data?.bike?.rating ? response.data?.bike?.rating:''
                    bike.value.system_name = !!response?.bike?.bike.system_name ? response.data?.bike?.system_name:''
                    bike.value.image = !!response.data?.bike?.image_name ? response.data?.bike?.image_name:''
                    bike.value.estimated_total = !!response.data?.bike?.estimated_cost ? response.data?.bike?.estimated_cost:''
                    bike.value.actual_total = !!response.data?.bike?.actual_cost ? response.data?.bike?.actual_cost:''
                    bike.value.show = bike.value.image !== '';
                }

                if (response?.data?.bike_option?.length > 0) {
                    _.forEach(response.data.bike_option, function (value, key) {
                        if (value.status === 1) {
                            bike.value.checkGoals[value.goal_id] = true
                        } else if (value.status === 2) {
                            bike.value.checkGoals[value.goal_id] = false
                        }
                    });
                }

                if(response?.data?.goal?.length > 0){
                    goals.value = response.data.goal
                }
            })
        }

    }

    const validation = (post) => {

            errors.name = '', errors.image = '', errors.phone = '', errors.cost = '', errors.roles = '', errors.estimatedCost = '', errors.actualCost = ''
        if(!post.name)
            errors.name = '* Name is required field!'
        // if(!post.image)
        //     errors.image = '* Image is required field!'
        if(!post.phone)
            errors.phone = '* Image is required field!'
        if(!post.estimated_total || !post.actual_total)
            errors.cost = '* Write Estimated and Actual Cost!'
        // if(!post.assistant && !post.leader)
        //     errors.roles = '* Write Assistant and Leader!'
        // if(post.estimated_costs[0].item_name === '' || post.estimated_costs[0].cost ===  '')
        //     errors.estimatedCost = '* Fillup item name and cost'
        // if(post.actual_costs[0].item_name === '' || post.actual_costs[0].cost ===  '')
        //     errors.actualCost = '* Fillup item name and cost'
        return errors.name === '' && errors.phone === '' && errors.cost === ''

    }

    const bikeAllInfo = (post) => {

        processing.process = true
        bike.value.project_slug = window.location.href.split('/')[4]

        let valid = validation(post)

        const formData = new FormData();

        for (let item in post) {
            if(post.hasOwnProperty(item)) {
                if(item === "checkGoals" || item === "estimated_costs" || item === "actual_costs" || item === "middle_costs") {
                    formData.append(item,  JSON.stringify(post[item]));
                } else {
                    formData.append(item, post[item]);
                }
            }
        }

        if (valid) {
            axios
                .post('/bike-all-information', formData , {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then((response) => {
                    if( response.data.success === true){
                        processing.process = false
                        errors.name = '', errors.image = '', errors.phone = '', errors.cost = '', errors.roles = '', errors.estimatedCost = '', errors.actualCost = ''
                        Toast.fire({icon: "success",title: "Information saved successfully!"})
                        bikeAllRedirect ()
                    }
                })
        }else {
            window.scrollTo({ top: 0, behavior: "smooth" })
            processing.process = false
        }
    }

    const bikeAllRedirect = () =>{

        const queryString = window.location.href.split('/')[4]
        bike.value.project_slug = queryString
        Inertia.visit('/bike-all-projects/'+queryString)
    }

    const estimatedPlusBtn = () => {
        errors.estimatedCost = ''

        let last_item = bike.value.estimated_costs[bike.value.estimated_costs.length-1].item_name;
        let last_cost = bike.value.estimated_costs[bike.value.estimated_costs.length-1].cost;

        if(last_item !== '' && last_cost !== ''){
            bike.value.estimated_costs.push({item_name: '', cost:'', id: ''});
        }else {
            errors.estimatedCost = '* Fillup item name and cost'
        }
    }

    const middlePlusBtn = () => {
        errors.middleCost = ''

        let last_item = bike.value.middle_costs[bike.value.middle_costs.length-1].item_name;
        var last_cost = bike.value.middle_costs[bike.value.middle_costs.length-1].cost;

        if(last_item !== '' && last_cost !== ''){
            bike.value.middle_costs.push({item_name: '', cost:'', id: ''});
        }else {
            errors.middleCost = '* Fillup item name and cost'
        }
    }

    const actualPlusBtn = () => {
        errors.actualCost = ''

        let last_item = bike.value.actual_costs[bike.value.actual_costs.length-1].item_name;
        var last_cost = bike.value.actual_costs[bike.value.actual_costs.length-1].cost;

        if(last_item !== '' && last_cost !== ''){
            bike.value.actual_costs.push({item_name: '', cost:'', id: ''});
        }else {
            errors.actualCost = '* Fillup item name and cost'
        }
    }

    const totalEstimate = () => {
        let total = 0
        bike.value.estimated_costs.map(myFunction);

        function myFunction(value, index, array) {
             total+= parseInt(value.cost)
        }
        bike.value.estimated_total = total
    }

    const totalMiddle = () => {
        let total = 0
        bike.value.middle_costs.map(myFunction);

        function myFunction(value, index, array) {
            total+= parseInt(value.cost)
        }
        bike.value.middle_total = total
    }

    const totalActual = () => {
        let total = 0
        bike.value.actual_costs.map(myFunction);

        function myFunction(value, index, array) {
            total+= parseInt(value.cost)
        }
        bike.value.actual_total = total
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
                                    <input class="hidden" @change="onFileChange" id="bikeinput" type="file">
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
                                <a v-if="url || bike.show"  target="_blank" :href="baseUrl+'/storage/images/'+bike.image" id="preview" class="ml-4">
                                    <img alt="one" class="w-32 h-32" v-if="url" :src="url" />
                                    <img alt="two" class="w-32 h-32" v-if="bike.show" :src="baseUrl+'/storage/images/'+bike.image" />
                                </a>
                                <div v-show="errors.image !== ''" class="flex items-center">
                                    <div  class="text-red-600 font-bold text-[14px]">{{ errors.image }}</div>
                                </div>
                            </div>
                            <div class="flex flex-col my-3 justify-between">
                                <div class="bg-[#639f1e] bg-opacity-75">
                                    <div @click="bikeAllRedirect()" class="text-[28px] cursor-pointer flex justify-center p-1 text-center font-bold">
                                        <i class="hover:text-red-700 fal fa-times"></i>
                                    </div>
                                </div>
                                <div class="bg-[#639f1e] bg-opacity-75">
                                    <div class="cursor-pointer text-[28px] flex justify-center p-1 text-center font-bold">
                                        <i class="fal fa-save"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full p-5 mx-auto">
                            <BreezeInput v-model="bike.name" type="text" placeholder="Name*" :class="{ 'placeholder-red-600' : !!errors.name && errors.name!=='' }" class="w-full p-2 bg-[#639f1e] bg-opacity-75"/>
                            <BreezeInput v-model="bike.phone" type="number" placeholder="Phone Number*" :class="{'placeholder-red-600': !!errors.phone && errors.phone !== '' }" class="w-full p-2 bg-[#639f1e] bg-opacity-75 mt-4"/>
                            <div class="bg-[#639f1e] bg-opacity-75 w-full h-auto mt-5">
                                <h3 class="font-semibold p-2">Stages</h3>
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
                                        <div class="h-72 overflow-y-auto" :class="{'hidden': isActive !== 1 }">
                                            <div class="flex px-5 items-end">
                                                <div class="px-5">
                                                    <div class="grid grid-cols-2 py-5" v-for="items in bike.estimated_costs">
                                                        <div class="">
                                                            <BreezeLabel value="ITEM" />
                                                            <BreezeInput v-model="items.item_name" type="text" class="!placeholder-gray-400 p-2 bg-[#639f1e] bg-opacity-75"/>
                                                        </div>
                                                        <div class="ml-2">
                                                            <BreezeLabel value="Cost(£)" />
                                                            <BreezeInput @change="totalEstimate()" placeholder="" type="number" v-model="items.cost" class="!placeholder-gray-400 p-2 bg-[#639f1e] bg-opacity-75"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <i @click="estimatedPlusBtn()" class="fas cursor-pointer mb-5 fa-plus p-2 bg-[#639f1e] opacity-75 hover:opacity-100 text-white"></i>
                                            </div>
                                            <div v-show="errors.estimatedCost !== ''" class="flex col-span-2 pl-10 pb-4 items-center">
                                                <div class="text-red-600 font-bold text-[14px]">{{ errors.estimatedCost }}</div>
                                            </div>
                                            <div class="flex mx-10 items-center">
                                                <BreezeLabel class="mr-2 font-bold rounded" value="Total(£):" />
                                                <BreezeInput disabled v-model="bike.estimated_total" type="number" class="w-40 text-center !placeholder-gray-400 bg-[#639f1e] bg-opacity-75"/>
                                            </div>
                                        </div>
                                        <div class="h-72 overflow-y-auto" :class="{'hidden': isActive !== 2 }">
                                            <div class="flex px-5 items-end">
                                                <div class="px-5">
                                                    <div class="grid grid-cols-2 py-5" v-for="items in bike.middle_costs">
                                                        <div class="">
                                                            <BreezeLabel value="ITEM" />
                                                            <BreezeInput type="text" v-model="items.item_name" class="!placeholder-gray-400 p-2 bg-[#639f1e] bg-opacity-75"/>
                                                        </div>
                                                        <div class="ml-2">
                                                            <BreezeLabel value="Cost(£)" />
                                                            <BreezeInput @change="totalMiddle()" type="number" v-model="items.cost" class="!placeholder-gray-400 p-2 bg-[#639f1e] bg-opacity-75"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <i @click="middlePlusBtn()" class="fas cursor-pointer mb-5 fa-plus p-2 bg-[#639f1e] opacity-75 hover:opacity-100 text-white"></i>
                                            </div>
                                            <div v-show="errors.middleCost !== ''" class="flex col-span-2 pl-10 pb-4 items-center">
                                                <div class="text-red-600 font-bold text-[14px]">{{ errors.middleCost }}</div>
                                            </div>
                                            <div class="flex mx-10 items-center">
                                                <BreezeLabel class="mr-2 font-bold rounded" value="Total(£):" />
                                                <BreezeInput disabled v-model="bike.middle_total" type="number" class="w-40 text-center !placeholder-gray-400 bg-[#639f1e] bg-opacity-75"/>
                                            </div>
                                        </div>
                                        <div class="h-72 overflow-y-auto" :class="{'hidden': isActive !== 3 }">
                                            <div class="flex px-5 items-end">
                                                <div class="px-5">
                                                    <div class="grid grid-cols-2 py-5" v-for="items in bike.actual_costs">
                                                        <div class="">
                                                            <BreezeLabel value="ITEM" />
                                                            <BreezeInput type="text" v-model="items.item_name" class="!placeholder-gray-400 p-2 bg-[#639f1e] bg-opacity-75"/>
                                                        </div>
                                                        <div class="ml-2">
                                                            <BreezeLabel value="Cost(£)" />
                                                            <BreezeInput @change="totalActual()" type="number" v-model="items.cost" class="!placeholder-gray-400 p-2 bg-[#639f1e] bg-opacity-75"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <i @click="actualPlusBtn()" class="fas cursor-pointer mb-5 fa-plus p-2 bg-[#639f1e] opacity-75 hover:opacity-100 text-white"></i>
                                            </div>
                                            <div v-show="errors.actualCost !== ''" class="flex col-span-2 pl-10 pb-4 items-center">
                                                <div  class="text-red-600 font-bold text-[14px]">{{ errors.actualCost }}</div>
                                            </div>
                                            <div class="flex mx-10 items-center">
                                                <BreezeLabel class="mr-2 font-bold rounded" value="Total(£):" />
                                                <BreezeInput disabled v-model="bike.actual_total" type="number" class="w-40 text-center !placeholder-gray-400 bg-[#639f1e] bg-opacity-75"/>
                                            </div>
                                        </div>
                                        <div :class="{'hidden': isActive !== 4 }">
                                            <div class="p-10">
                                                <BreezeLabel value="Customer Comment:" />
                                                <div class="flex text-[45px] p-10 items-center justify-between space-x-2">
                                                    <i :class="{'fas' : bike.rating >= 1 }" class="far fa-star cursor-pointer text-[#FFD700]" @click="(bike.rating=1)"></i>
                                                    <i :class="{'fas' : bike.rating >= 2 }" class="far fa-star cursor-pointer text-[#FFD700]" @click="(bike.rating=2)"></i>
                                                    <i :class="{'fas' : bike.rating >= 3 }" class="far fa-star cursor-pointer text-[#FFD700]" @click="(bike.rating=3)"></i>
                                                    <i :class="{'fas' : bike.rating >= 4 }" class="far fa-star cursor-pointer text-[#FFD700]" @click="(bike.rating=4)"></i>
                                                    <i :class="{'fas' : bike.rating >= 5 }" class="far fa-star cursor-pointer text-[#FFD700]" @click="(bike.rating=5)"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-[#639f1e] bg-opacity-75 w-full h-auto mt-5 pb-2">
                                <div class="flex items-center">
                                    <h3 class="font-semibold  p-2">Roles</h3>
                                    <div v-show="errors.roles !== ''" class="ml-2">
                                        <div  class="text-red-600 font-bold text-[14px]">{{ errors.roles }}</div>
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <div CLASS="grid grid-cols-2 mx-5 gap-4">
                                        <div class="flex items-center">
                                            <BreezeLabel value="Leader:" />
                                            <BreezeInput v-model="bike.leader" type="text" class="w-32 ml-2 h-10 p-2 bg-[#639f1e] bg-opacity-75"/>
                                        </div>
                                        <div class="flex items-center">
                                            <BreezeLabel value="Assistant" />
                                            <BreezeInput v-model="bike.assistant" type="text" class="w-32 ml-2 h-10 p-2 bg-[#639f1e] bg-opacity-75"/>
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
                                                <div class="flex mx-2 items-center py-2" v-for="goal in goals">
                                                    <BreezeCheckbox v-model="bike.checkGoals[goal.id]" :checked="bike.checkGoals[goal.id] === true ? true: false" class="accent-[#639f1e] mr-2 w-4 h-4 border-[#639f1e] text-[16px] hover:text-[#639f1e]"/>
                                                    <label class="font-medium text-gray-700 text-[14px]">{{goal.name}}</label>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-[#639f1e] bg-opacity-75 w-full h-auto mt-5 pb-2">
                                <div class="flex items-center">
                                    <h3 class="font-semibold p-2">Cost</h3>
                                    <div v-show="errors.cost !== ''" class="ml-2">
                                        <div  class="text-red-600 font-bold text-[14px]">{{ errors.cost }}</div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-4 mx-4">
                                    <div>
                                        <BreezeLabel value="Estimated" />
                                        <BreezeInput type="number" v-model="bike.estimated_total" class="!placeholder-gray-400 p-2 bg-[#639f1e] bg-opacity-75"/>
                                    </div>
                                    <div>
                                        <BreezeLabel value="Actual" />
                                        <BreezeInput type="number" v-model="bike.actual_total" class="!placeholder-gray-400 p-2 bg-[#639f1e] bg-opacity-75"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="px-5">
                        <BreezeButton @click="bikeAllInfo(bike)" class="bg-[#639f1e] bg-opacity-75 text-white w-full font-sans submit mx-auto py-3 justify-center text-[25px] font-bold" :class="{ 'opacity-25': processing.process === true }" :disabled="processing.process === true">
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
