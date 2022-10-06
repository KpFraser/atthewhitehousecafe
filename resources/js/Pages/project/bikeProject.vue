<script setup>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import MasterFooter from '@/Components/MasterFooter.vue';
    import MasterHeader from '@/Components/MasterHeader.vue';
    import useFooterList from "../../../use/useFooterList";
    import BreezeInput from '@/Components/Input.vue';
    import BreezeCheckbox from '@/Components/Checkbox.vue';
    import BreezeLabel from '@/Components/Label.vue';
    import { Link } from '@inertiajs/inertia-vue3';
    import {onMounted, reactive, ref} from "vue";
    import BreezeButton from '@/Components/Button.vue';
    import commonFunctions from "@/use/common";
    import {Inertia} from "@inertiajs/inertia";

    const { Toast } = commonFunctions()
    const { footerLists } = useFooterList();

    const goals = ref({})
    const bike  = ref({id: '', image: '', name: '', project_slug: '', phone: '', estimated_total: '', actual_total: '', leader: '', assistant: '', checkGoals: {}, estimated_costs: [{item: '', cost: ''}], actual_costs: [{item: '', cost: ''}]}),

        // bikeInformation = ref({id: '', image: ''}),
        // bikeItem = ref({}),
        // checkGoals = ref({}),
        btnProcessing = ref({ processing: false }),
        isActive = ref(1),
        star = 0,
        errors = reactive({}),
        // estimated_costs = ref([{item: '', cost: ''}]),
        // actual_costs = ref([{item: '', cost: ''}]),
        url =  ref()

    const onFileChange = (e) => {
        const file = e.target.files[0];
        bike.value.image = file
        url.value = URL.createObjectURL(file);
        errors.image = ''
    }

    const bikeInfo = () =>{
        axios
            .get('/bike-show')
            .then((response)=>{
                goals.value = response.data
            })
    }

    const validation = (post) => {

        console.log(post)
            errors.name = '', errors.image = '', errors.phone = '', errors.cost = '', errors.roles = '', errors.estimatedCost = "", errors.actualCost = ''
        if(!post.name)
            errors.name = '* Name is required field!'
        if(!post.image)
            errors.image = '* Image is required field!'
        if(!post.phone)
            errors.phone = '* Image is required field!'
        if(!post.estimated_total && !post.actual_total)
            errors.cost = '* Write Estimated and Actual Cost!'
        if(!post.assistant && !post.leader)
            errors.roles = '* Write Assistant and Leader!'
        if(post.estimated_costs[0].item === '' || post.estimated_costs[0].cost ===  '')
            errors.estimatedCost = '* Fillup item name and cost'
        if(post.actual_costs[0].item === '' || post.actual_costs[0].cost ===  '')
            errors.actualCost = '* Fillup item name and cost'
        return errors.name === '' && errors.image === '' && errors.phone === '' && errors.cost === '' && errors.roles === '' && errors.estimatedCost === "" && errors.actualCost === ''

    }

    const bikeAllInfo = (post) => {

        const queryString = window.location.href.split('/')[4]
        bike.value.project_slug = queryString

        let valid = validation(post)

        const formData = new FormData();

        for (let item in post) {
            if(post.hasOwnProperty(item)) {
                if(item === "checkGoals" || item === "estimated_costs" || item === "actual_costs") {
                    formData.append(item,  JSON.stringify(post[item]));
                } else {
                    formData.append(item, post[item]);
                }
            }
        }

        if (valid) {
            btnProcessing.value.processing = true
            axios
                .post('/bike-all-information', formData , {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then((response) => {
                    if( response.data.success === true){
                        btnProcessing.value.processing = false
                        errors.name = '', errors.image = '', errors.phone = '', errors.cost = '', errors.roles = '', errors.estimatedCost = '', errors.actualCost = ''
                        Toast.fire({icon: "success",title: "Project created successfully!"})
                        Inertia.visit('/bike-all-projects/'+queryString)
                    }
                }).finally(btnProcessing.value.processing = false)
        }
    }

    const estimatedPlusBtn = () => {
        errors.estimatedCost = ''

        let last_item = bike.value.estimated_costs[bike.value.estimated_costs.length-1].item;
        let last_cost = bike.value.estimated_costs[bike.value.estimated_costs.length-1].cost;

        if(last_item !== '' && last_cost !== ''){
            bike.value.estimated_costs.push({item: '', cost:''});
        }else {
            errors.estimatedCost = '* Fillup item name and cost'
        }
    }

    const actualPlusBtn = () => {
        errors.actualCost = ''

        let last_item = bike.value.actual_costs[bike.value.actual_costs.length-1].item;
        var last_cost = bike.value.actual_costs[bike.value.actual_costs.length-1].cost;

        if(last_item !== '' && last_cost !== ''){
            bike.value.actual_costs.push({item: '', cost:''});
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
                                <div id="preview" class="ml-4">
                                    <img  class="w-32 h-32" v-if="url" :src="url" />
                                </div>
                                <div v-show="errors.image !== ''" class="flex items-center">
                                    <div  class="text-red-600 font-bold text-[14px]">{{ errors.image }}</div>
                                </div>
                            </div>
                            <div class="flex flex-col my-3 justify-between">
                                <div class="bg-[#639f1e] bg-opacity-75">
                                    <Link :href="route('projectshome')" class="text-[28px] flex justify-center p-1 text-center font-bold">
                                        <i class="fas fa-home"></i>
                                    </Link>
                                </div>
                                <div class="bg-[#639f1e] bg-opacity-75">
                                    <div  class="cursor-pointer text-[28px] flex justify-center p-1 text-center font-bold">
                                        <i class="fal fa-save"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full p-5 mx-auto">
                            <BreezeInput v-model="bike.name" type="text" placeholder="Name*" :class="{ 'placeholder-red-600' : !!errors.name && errors.name!=='' }" class="w-full p-2 bg-[#639f1e] bg-opacity-75"/>
                            <BreezeInput v-model="bike.phone" type="number" placeholder="Phone Number*" :class="{'placeholder-red-600': !!errors.phone && errors.phone !== '' }" class="w-full p-2 bg-[#639f1e] bg-opacity-75 mt-4"/>
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
                                        <div class="h-72 overflow-y-auto" :class="{'hidden': isActive === 2 || isActive === 3 || isActive === 4 }">
                                            <div class="flex px-5 items-end">
                                                <div class="px-5">
                                                    <div class="grid grid-cols-2 py-5" v-for="items in bike.estimated_costs">
                                                        <div class="">
                                                            <BreezeLabel value="ITEM" />
                                                            <BreezeInput placeholder="name" v-model="items.item" type="text" class="!placeholder-gray-400 p-2 bg-[#639f1e] bg-opacity-75"/>
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
                                                <div  class="text-red-600 font-bold text-[14px]">{{ errors.estimatedCost }}</div>
                                            </div>
                                            <div class="flex mx-10 items-center">
                                                <BreezeLabel class="mr-2 font-bold rounded" value="Total(£):" />
                                                <BreezeInput disabled v-model="bike.estimated_total" type="number" class="w-40 text-center !placeholder-gray-400 bg-[#639f1e] bg-opacity-75"/>
                                            </div>
                                        </div>
                                        <div class="h-72 overflow-y-auto" :class="{'hidden': isActive === 1 || isActive === 3 || isActive === 4 }">
                                            <div class="flex px-5 items-end">
                                                <div class="px-5">
                                                    <div class="grid grid-cols-2 py-5" v-for="items in bike.actual_costs">
                                                        <div class="">
                                                            <BreezeLabel value="ITEM" />
                                                            <BreezeInput type="text" v-model="items.item" class="!placeholder-gray-400 p-2 bg-[#639f1e] bg-opacity-75"/>
                                                        </div>
                                                        <div class="ml-2">
                                                            <BreezeLabel value="Cost(£)" />
                                                            <BreezeInput @change="totalActual()" type="number" v-model="items.cost" class="!placeholder-gray-400 p-2 bg-[#639f1e] bg-opacity-75"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <i @click="actualPlusBtn()" class="fas cursor-pointer fa-plus p-2 bg-[#639f1e] opacity-75 hover:opacity-100 text-white"></i>
                                            </div>
                                            <div v-show="errors.actualCost !== ''" class="flex col-span-2 pl-10 pb-4 items-center">
                                                <div  class="text-red-600 font-bold text-[14px]">{{ errors.actualCost }}</div>
                                            </div>
                                            <div class="flex mx-10 items-center">
                                                <BreezeLabel class="mr-2 font-bold rounded" value="Total(£):" />
                                                <BreezeInput disabled v-model="bike.actual_total" type="number" class="w-40 text-center !placeholder-gray-400 bg-[#639f1e] bg-opacity-75"/>
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
                                                <div class="flex text-[45px] p-10 items-center justify-between space-x-2">
                                                    <i :class="{'fas' : star >= 1 }" class="far fa-star cursor-pointer text-[#FFD700]" @click="(star=1)"></i>
                                                    <i :class="{'fas' : star >= 2 }" class="far fa-star cursor-pointer text-[#FFD700]" @click="(star=2)"></i>
                                                    <i :class="{'fas' : star >= 3 }" class="far fa-star cursor-pointer text-[#FFD700]" @click="(star=3)"></i>
                                                    <i :class="{'fas' : star >= 4 }" class="far fa-star cursor-pointer text-[#FFD700]" @click="(star=4)"></i>
                                                </div>
<!--                                                <BreezeInput placeholder="comment..." v-model="bikeItem.comment" type="text" class="!placeholder-gray-400 p-2 bg-[#639f1e] bg-opacity-75"/>-->
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
                                                <div class="flex mx-2 items-center space-y-2" v-for="goal in goals">
                                                    <BreezeCheckbox v-model="bike.checkGoals[goal.id]" id="{{goal.id}}" class="accent-[#639f1e] mr-2 w-4 h-4 border-[#639f1e] text-[16px] hover:text-[#639f1e]"/>
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
                                <div class="flex items-center">
                                    <h3 class="font-semibold p-2">Cost</h3>
                                    <div v-show="errors.cost !== ''" class="ml-2">
                                        <div  class="text-red-600 font-bold text-[14px]">{{ errors.cost }}</div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-4 mx-4">
                                    <div>
                                        <BreezeLabel value="Estimated" />
                                        <BreezeInput disabled type="number" v-model="bike.estimated_total" class="!placeholder-gray-400 p-2 bg-[#639f1e] bg-opacity-75"/>
                                    </div>
                                    <div>
                                        <BreezeLabel value="Actual" />
                                        <BreezeInput disabled type="number" v-model="bike.actual_total" class="!placeholder-gray-400 p-2 bg-[#639f1e] bg-opacity-75"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="px-5">
                        <BreezeButton @click="bikeAllInfo(bike)" class="bg-[#639f1e] bg-opacity-75 text-white w-full font-sans submit mx-auto py-3 justify-center text-[25px] font-bold" :class="{ 'opacity-25': btnProcessing.processing }" :disabled="btnProcessing.processing">
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
