<script setup>
    import MasterFooter from '@/Components/MasterFooter.vue';
    import MasterHeader from '@/Components/MasterHeader.vue';
    import useFooterList from "../../../use/useFooterList";
    import {ref, onMounted } from "vue";
    import { Link } from '@inertiajs/inertia-vue3';
    import commonFunctions from "@/use/common";

    const { Toast } = commonFunctions(),
        { footerLists } = useFooterList()

    const isActive = ref(1),
        subTabActive = ref(1),
        approved = ref(false),
        day = ref([{day: 'mon', value:0}, {day: 'tue', value:0}, {day: 'wed', value:0}, {day: 'thu', value:0}, {day: 'fri', value:0}, {day: 'sat', value:0}, {day: 'sun', value:0}]),
        location = ref({ id:'', name:'', address_1:'', address_2: '', city:'', postcode:'', country:'', repeat_time:'', repeat_every:'', never:'', on:'', after:''}),
        ends = ref ({}),
        leadership = ref({}),
        safety = ref ({date: '', document:'', document_name:'', text1:'', text2:'', text3:''}),
        errors = ref ({riskManagement:'', document:'', text1:'', text2:'', text3:'', funding:''}),
        riskManagement = ref([]),
        finance = ref({funding: '', text1: '', text2: ''}),
        socialInfo = ref({}),
        locationError = ref ({address_1:'', address_2:'', city:'', country:'', name:'', postcode:'', repeat_time:'', repeat_every:'', ends:'', days: ''})

    const activeTab = (tab) =>{
        isActive.value = tab
    }

    const subTab = (tab) =>{
        subTabActive.value = tab
    }

    const selectDay = (tab) =>{
        let index = _.findKey(day.value, function(o) { return o.day === tab; });
        if(day.value[index].value === 0)
            day.value[index].value = 1
        else
            day.value[index].value = 0
    }

    const endDate = (post) =>{
        ends.value = post
        if (post === 'never'){
            location.value.never = '1'
            location.value.on = ''
            location.value.after = ''
        } else if (post === 'on'){
            location.value.never = ''
            location.value.after = ''
        } else if (post === 'after'){
            location.value.on = ''
            location.value.never = ''
        }
    }

    const locationValidation = (post) =>{

        locationError.value = {address_1:'', address_2:'', city:'', country:'', name:'', postcode:'', repeat_time:'', repeat_every:'', ends:'', days: ''}
        if (!post.name)
            locationError.value.name = '* Required'
        if (!post.address_1)
            locationError.value.address_1 = '* Required'
        if (!post.country)
            locationError.value.country = '* Required'
        if (!post.city)
            locationError.value.city = '* Required'
        if (!post.postcode)
            locationError.value.postcode = '* Required'
        if (!post.repeat_time)
            locationError.value.repeat_time = '* Required'
        if (!post.repeat_every)
            locationError.value.repeat_every = '* Required'
        if (!post.after && !post.never && !post.on)
            locationError.value.ends = '* Select one option'
        if (day.value[0].value === 0 && day.value[1].value === 0 && day.value[2].value === 0 && day.value[3].value === 0 && day.value[4].value === 0 && day.value[5].value === 0 && day.value[6].value === 0)
            locationError.value.days = '* Required'

        return(!locationError.value.address_1 && !locationError.value.address_2 && !locationError.value.city && !locationError.value.country && !locationError.value.name && !locationError.value.postcode && !locationError.value.repeat_time && !locationError.value.repeat_every && !locationError.value.ends && !locationError.value.days)

    }

    const locationSubmit = (post) =>{
        console.log(post)
        let valid = locationValidation (post)
        if(valid){
            axios
                .post('/location-information', {location: location.value, day:day.value})
                .then((response)=>{
                    if(response.data.success) {
                        Toast.fire({icon: "success", title: "Data saved successfully!"})
                        proposalAllData()
                    }
                })
        }
    }

    const addRisk = () =>{
        errors.value.riskManagement = ''
        let lastObject = riskManagement.value[riskManagement.value.length -1]
        if(lastObject.name === '' || lastObject.risk === '' || lastObject.control === '')
            errors.value.riskManagement = '* All field are required !'
        else
        riskManagement.value.push({id:'', name:'', risk:'', control:''})
    }

    const saveRiskManagement = () =>{

        errors.value.riskManagement = ''
        let lastObject = riskManagement.value[riskManagement.value.length -1]
        if(lastObject?.name !== '' && lastObject?.risk !== '' && lastObject?.control !== '') {
            approved.value = true
            axios
                .post('/save-risk', riskManagement.value)
                .then((response)=>{
                    if(response.data.success){
                        Toast.fire({icon: "success", title: "Data saved successfully!"})
                        approved.value = false
                        proposalAllData ()
                    }
                }).finally(() => approved.value = false)
        } else
            errors.value.riskManagement = '* All field are required !'
    }

    const safetyValidation = (post) => {
        errors.value = { riskManagement: '', document: '', text1: '', text2: '', text3: '' }

        if (!post.document)
            errors.value.document = '* Required'
        if (!post.text1)
            errors.value.text1 = '* Required'
        if (!post.text2)
            errors.value.text2 = '* Required'
        if (!post.text3)
            errors.value.text3 = '* Required'

        return( !errors.value.document && !errors.value.text1 && !errors.value.text2 && !errors.value.text3 )

    }

    const saveSafetyMeasures = (post) => {
        let valid = safetyValidation (post)
        if (valid){
            approved.value = true
            const formData = new FormData();
            formData.append('document',  safety.value.document);
            formData.append('document_name',  safety.value.document_name);
            formData.append('date',  safety.value.date);
            formData.append('text1',  safety.value.text1);
            formData.append('text2',  safety.value.text2);
            formData.append('text3',  safety.value.text3);
            axios
                .post('/safety-info', formData , {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then((response)=>{
                    if(response.data.success){
                        Toast.fire({icon: "success", title: "Data saved successfully!"})
                        approved.value = false
                        proposalAllData ()
                    }
                })
                .finally(() => approved.value = false)
        }
    }

    const insuranceDocument = (e) =>{
        safety.value.document = e.target.files[0]
    }

    const saveFinancePlan = (post) =>{
        if (post.lottery !== ''){
            approved.value = true
            axios
                .post('/save-finance', finance.value)
                .then((response)=>{
                    if(response.data.success){
                        Toast.fire({icon: "success", title: "Data saved successfully!"})
                        approved.value = false
                        proposalAllData ()
                    }
                }).finally(() => approved.value = false)
        } else
            errors.value.funding = '* Select yes or no !'
    }

    const saveSocialInfo = () =>{

            approved.value = true
            axios
                .post('/save-social', socialInfo.value)
                .then((response)=>{
                    if(response.data.success){
                        Toast.fire({icon: "success", title: "Data saved successfully!"})
                        approved.value = false
                        proposalAllData ()
                    }
                }).finally(() => approved.value = false)
    }

    const saveLeadershipInfo = () =>{

        approved.value = true
        axios
            .post('/save-leadership', leadership.value)
            .then((response)=>{
                if(response.data.success){
                    Toast.fire({icon: "success", title: "Data saved successfully!"})
                    approved.value = false
                    proposalAllData ()
                }
            }).finally(() => approved.value = false)
    }

    const proposalAllData = () => {
        axios
            .get('/proposals-page-information')
            .then((response)=>{
                if(response.data !== ''){
                    if(response.data[0] !== null)
                        location.value = response.data[0]
                    if(response.data[1] !== null)
                        day.value = response.data[1]
                    if(response.data[2].length === 0)
                        riskManagement.value.push({id: '', name: '', risk: '', control: ''})
                    else
                        riskManagement.value = response.data[2]
                    safety.value = !!response.data[3] ? response.data[3]: ''
                    finance.value = !!response.data[4] ? response.data[4]: ''
                    socialInfo.value = !!response.data[5] ? response.data[5]: ''
                    leadership.value = !!response.data[6] ? response.data[6]: ''
                }
            })
    }

    onMounted(()=>{
        proposalAllData ()
    })

</script>

<template>
    <div class="flex justify-center bg-white items-center max-w-lg mx-auto font-serif">
        <div class="w-full">
            <MasterHeader/>
            <div class="text-black mt-4 border-4 border-b-4 border-[#20351d] border-opacity-75 mb-28 bg-white text-lg">
                <ul class="w-full flex !text-gray-800 justify-between">
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
                        <i class="text-[46px] fas fa-search"></i>
                    </li>
                    <Link :href="route('projectshome')" class="w-[20%] m-1 cursor-pointer bg-[#639f1e] bg-opacity-75 rounded p-2 text-center">
                        <i class="text-[46px] fas fa-home"></i>
                    </Link>
                </ul>
                <div class="bg-white h-[730px] max-w-lg mx-auto">
                    <div class="h-[730px]" :class="{'hidden': isActive !== 1 }" >
                        <div class="">
                            <ul class="w-full grid grid-cols-5 text-gray-800">
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
                                <div class="overflow-y-auto p-4 h-[655px] border-4">
                                    <div class="bg-white">
                                        <input v-model="location.name" type="text" :class="{'border-red-500 border-2': locationError.name !== '' }" class="bg-gray-200 p-2 mt-2 w-full rounded-md" placeholder="Name">
                                        <input v-model="location.address_1" type="text" :class="{'border-red-500 border-2': locationError.address_1 !== '' }" class="bg-gray-200 p-2 mt-2 w-full rounded-md" placeholder="Address1">
                                        <input v-model="location.address_2" type="text" class="bg-gray-200 p-2 mt-2 w-full rounded-md" placeholder="Address2">
                                        <input v-model="location.city" type="text" :class="{'border-red-500 border-2': locationError.city !== '' }" class="bg-gray-200 p-2 mt-2 w-full rounded-md" placeholder="City">
                                        <input v-model="location.postcode" type="text" :class="{'border-red-500 border-2': locationError.postcode !== '' }" class="bg-gray-200 p-2 mt-2 w-full rounded-md" placeholder="Post code">
                                        <input v-model="location.country" type="text" :class="{'border-red-500 border-2': locationError.country !== '' }" class="bg-gray-200 p-2 mt-2 w-full rounded-md" placeholder="Country">
                                        <div class="flex items-center justify-between mt-3">
                                            <div class="flex items-center">
                                                <h3>Repeat Every: </h3>
                                                <input v-model="location.repeat_time" type="number" :class="{'!border-red-500 !border-2': locationError.repeat_time !== '' }" class="ml-2 w-20 h-8 focus:border-b-4 border-b-[#639f1e] focus:border-b-[#639f1e] border-b-4 focus:ring-0 outline-none border-b-2">
                                            </div>
                                            <select v-model="location.repeat_every" :class="{'!border-red-500 !border-2': locationError.repeat_every !== '' }" class="h-8 focus:ring-0 focus:border border-[#639f1e] focus:border-[#639f1e] w-24 px-3 py-1.5 text-base font-normal bg-white rounded" aria-label="Default select example">
                                                <option selected class="hidden">Select</option>
                                                <option value="week">Week</option>
                                                <option value="month">Month</option>
                                                <option value="year">Year</option>
                                            </select>
                                        </div>
                                        <h3 class="font-semibold">Repeat on: </h3>
                                        <div class="flex items-center my-2">
                                            <span @click="selectDay('mon')" :class="{'!bg-[#639f1e]': day[0]?.value === 1, 'border border-red-500': locationError.days !== ''}" class="w-8 h-8 rounded-full bg-gray-200 text-center py-1 cursor-pointer">M</span>
                                            <span @click="selectDay('tue')" :class="{'!bg-[#639f1e]': day[1]?.value === 1, 'border border-red-500': locationError.days !== ''}" class="w-8 h-8 rounded-full bg-gray-200 text-center py-1 ml-2 cursor-pointer">T</span>
                                            <span @click="selectDay('wed')" :class="{'!bg-[#639f1e]': day[2]?.value === 1, 'border border-red-500': locationError.days !== ''}" class="w-8 h-8 rounded-full bg-gray-200 text-center py-1 ml-2 cursor-pointer">W</span>
                                            <span @click="selectDay('thu')" :class="{'!bg-[#639f1e]': day[3]?.value === 1, 'border border-red-500': locationError.days !== ''}" class="w-8 h-8 rounded-full bg-gray-200 text-center py-1 ml-2 cursor-pointer">T</span>
                                            <span @click="selectDay('fri')" :class="{'!bg-[#639f1e]': day[4]?.value === 1, 'border border-red-500': locationError.days !== ''}" class="w-8 h-8 rounded-full bg-gray-200 text-center py-1 ml-2 cursor-pointer">F</span>
                                            <span @click="selectDay('sat')" :class="{'!bg-[#639f1e]': day[5]?.value === 1, 'border border-red-500': locationError.days !== ''}" class="w-8 h-8 rounded-full bg-gray-200 text-center py-1 ml-2 cursor-pointer">S</span>
                                            <span @click="selectDay('sun')" :class="{'!bg-[#639f1e]': day[6]?.value === 1, 'border border-red-500': locationError.days !== ''}" class="w-8 h-8 rounded-full bg-gray-200 text-center py-1 ml-2 cursor-pointer">S</span>
                                        </div>
                                        <div class="flex items-center">
                                            <h3 class="font-semibold">Ends: </h3>
                                            <div v-if="locationError.ends !== ''" class="font-light text-[15px] text-red-700 ml-3">{{ locationError.ends }}</div>
                                        </div>
                                       <form class="space-y-4">
                                           <div class="flex items-center">
                                               <input @click="endDate('never')" :checked="location.never !== '' && location.never !== null" class="focus:ring-[#639f1e] bg-gray-200 mr-2 focus:border-[#639f1e] border-2 border-[#639f1e] text-[#639f1e] cursor-pointer" type="radio" id="never" name="endOn" >
                                               <label class="inline-block text-gray-800" for="never">Never</label>
                                           </div>
                                           <div class="flex justify-between items-center h-8">
                                               <div class="flex items-center">
                                                   <input @click="endDate('on')" :checked="location.on !== '' && location.on !== null" class="focus:ring-[#639f1e] bg-gray-200 mr-2 focus:border-[#639f1e] border-2 border-[#639f1e] text-[#639f1e] cursor-pointer" type="radio" id="on" name="endOn">
                                                   <label class="inline-block text-gray-800" for="on">On</label>
                                               </div>
                                               <input v-if="ends === 'on' || location.on !== '' && location.on !== null" v-model="location.on" type="date" class="w-40 h-8 bg-gray-200 rounded-md px-3 ">
                                           </div>
                                           <div class="flex items-center justify-between h-8">
                                               <div class="flex items-center">
                                                   <input @click="endDate('after')" :checked="location.after !== '' && location.after !== null" class="focus:ring-[#639f1e] bg-gray-200 mr-2 focus:border-[#639f1e] border-2 border-[#639f1e] text-[#639f1e] cursor-pointer" type="radio" id="date" name="endOn">
                                                   <label class="inline-block text-gray-800" for="tilldate">After</label>
                                               </div>
                                               <input v-if="ends === 'after' || location.after !== '' && location.after !== null" v-model="location.after" type="number" class="w-40 h-8 bg-gray-200 rounded-md px-3 ">
                                           </div>
                                           <div class="flex justify-end">
                                               <div class="pr-5 flex justify-end">
                                                   <button type="button" @click="locationSubmit(location)" class="bg-[#639f1e] cursor-pointer bg-opacity-75 hover:bg-opacity-100 text-white justify-center text-center px-4 py-1 flex items-center border-gray-800 border-opacity-75 border-2" :class="{ 'opacity-25': approved }" :disabled="approved">save</button>
                                               </div>
<!--                                               <div class="cursor-pointer">Cancel</div>-->
<!--                                               <div @click="locationSubmit(location)" class="ml-5 cursor-pointer text-[#639f1e] font-semibold">Done</div>-->
                                           </div>
                                       </form>
                                    </div>
                                </div>
                            </div>
                            <div class="" :class="{'hidden': subTabActive !== 2 }">
                                <div class="overflow-y-auto p-4 h-[655px] border-4">
                                    <p class="text-sm">
                                        Risk assessment is about deciding what could go wrong and determining what you need to do to prevent that happening. It is not possible to completely eliminate all risks. But we endeavour to remove risk to its lowest level compatible with the enjoyment of the activity.
                                    </p>
                                    <table class="my-5 w-full">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="border-gray-800 text-center border-4 border-opacity-75 text-sm font-medium bg-[#639f1e] bg-opacity-75 p-4">
                                                    <i class="text-[20px] fas fa-exclamation-triangle "></i>
                                                    <div class="text-[18px]">Hazards</div>
                                                </th>
                                                <th scope="col" class="border-gray-800 text-center border-4 border-opacity-75 text-sm font-medium bg-[#639f1e] bg-opacity-75 p-4">
                                                    <i class="text-[20px] fas fa-tachometer"></i>
                                                    <div class="text-[18px]">Risks</div>
                                                </th>
                                                <th scope="col" class="border-gray-800 text-center border-4 border-opacity-75 bg-[#639f1e] bg-opacity-75 text-sm font-medium p-4">
                                                    <i class="text-[20px] fas fa-cog"></i>
                                                    <div class="text-[18px]">Control</div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="rounded-md">
                                            <tr v-for="data in riskManagement">
                                                <td class="text-[12.5px] text-red-800 border-gray-800 border-4 border-opacity-75 w-28">
                                                    <input v-model="data.name" type="text" class="border-none focus:ring-0 focus:border-none py-8 w-full">
                                                </td>
                                                <td class="text-[12.5px] text-red-800 border-gray-800 border-4 border-opacity-75 w-28">
                                                    <input v-model="data.risk" type="text" class="border-none focus:ring-0 focus:border-none py-8 w-full">
                                                </td>
                                                <td class="text-[12.5px] text-red-800 border-gray-800 border-4 border-opacity-75">
                                                    <textarea v-model="data.control" rows="3" class="w-full h-auto min-h-full border-none focus:ring-0 focus:border-none">
                                                    </textarea>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="flex justify-between">
                                        <button @click="saveRiskManagement()" class="bg-[#639f1e] cursor-pointer bg-opacity-75 hover:bg-opacity-100 text-white justify-center text-center px-4 flex items-center border-gray-800 border-opacity-75 border-2" :class="{ 'opacity-25': approved }" :disabled="approved">save</button>
                                        <div v-if="errors.riskManagement !== '' " class="py-2 text-[14px] text-red-500 bold">{{errors.riskManagement}}</div>
                                        <i @click="addRisk()" class="bg-[#639f1e] cursor-pointer bg-opacity-75 hover:bg-opacity-100 text-white justify-center text-center w-10 h-10 flex items-center border-opacity-75 border-gray-800 border-2 fas fa-plus"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="" :class="{'hidden': subTabActive !== 3 }">
                                <div class="overflow-y-auto p-4 h-[655px] border-4">
                                    <div class="bg-white space-y-2 rounded-xl p-5">
                                        <div class="flex space-x-4 mr-1 justify-end">
                                            <label>Yes</label>
                                            <label>No</label>
                                        </div>
                                        <div class="grid grid-cols-5 items-center">
                                            <label type="text" :class="{'border-red-500': errors.text1 !== ''}" class="col-span-4 bg-gray-200 border-2 focus:outline-none w-full p-2 rounded">Do you work with vulnerable?</label>
                                            <div class="flex ml-3 justify-around">
                                                <input v-model="safety.text1" class="focus:ring-[#639f1e] bg-gray-200 mr-2 focus:border-[#639f1e] border-2 border-[#639f1e] text-[#639f1e] cursor-pointer" value="yes" type="radio" name="vulnerability"/>
                                                <input v-model="safety.text1" class="focus:ring-[#639f1e] bg-gray-200 mr-2 focus:border-[#639f1e] border-2 border-[#639f1e] text-[#639f1e] cursor-pointer" value="no" type="radio" name="vulnerability"/>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-5 items-center">
                                            <label type="text" :class="{'border-red-500': errors.text2 !== ''}" class="col-span-4 bg-gray-200 border-2 focus:outline-none w-full p-2 rounded">Do you have public liability?</label>
                                            <div class="flex ml-3 justify-around">
                                                <input v-model="safety.text2" class="focus:ring-[#639f1e] bg-gray-200 mr-2 focus:border-[#639f1e] border-2 border-[#639f1e] text-[#639f1e] cursor-pointer" value="yes" type="radio" name="liability"/>
                                                <input v-model="safety.text2" class="focus:ring-[#639f1e] bg-gray-200 mr-2 focus:border-[#639f1e] border-2 border-[#639f1e] text-[#639f1e] cursor-pointer" value="no" type="radio" name="liability"/>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-5 items-center">
                                            <label type="text" :class="{'border-red-500': errors.text3 !== ''}" class="col-span-4 bg-gray-200 border-2 focus:outline-none w-full p-2 rounded">Do you have employers liability?</label>
                                            <div class="flex ml-3 justify-around">
                                                <input v-model="safety.text3" class="focus:ring-[#639f1e] bg-gray-200 mr-2 focus:border-[#639f1e] border-2 border-[#639f1e] text-[#639f1e] cursor-pointer" value="yes" type="radio" name="employLiability"/>
                                                <input v-model="safety.text3" class="focus:ring-[#639f1e] bg-gray-200 mr-2 focus:border-[#639f1e] border-2 border-[#639f1e] text-[#639f1e] cursor-pointer" value="no" type="radio" name="employLiability"/>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-5 items-center">
                                            <label type="text" class="col-span-3 bg-gray-200 border-2 focus:outline-none w-full p-2 rounded">If yes when does it expire?</label>
                                            <div class="flex h-11 col-span-2 justify-around">
                                                <input v-model="safety.date" type="date" class="p-3 bg-gray-200 rounded ml-3">
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-5 items-center">
                                            <label type="text" for="insurance" :class="{'border-red-500': errors.document !== '', 'border-[#639f1e]': safety.document !== ''}" class="col-span-3 bg-gray-200 border-2 focus:outline-none w-full p-2 rounded">Upload insurance documents</label>
                                            <label v-if="safety.document !== ''" class="col-span-2 px-2 text-[#639f1e] truncate ...">Doc: {{safety.document.name}}</label>
                                            <input @change="insuranceDocument($event)" type="file" class="hidden" id="insurance">
                                        </div>
                                    </div>
                                    <div class="pl-5 text-[14px] text-red-500 bold" v-if="errors.document !== '' || errors.text1 !== '' || errors.text2 !== '' || errors.text3 !== ''">Red border fields are required !</div>
                                    <div class="pr-5 flex justify-end">
                                        <button @click="saveSafetyMeasures(safety)" class="bg-[#639f1e] cursor-pointer bg-opacity-75 hover:bg-opacity-100 text-white justify-center text-center px-4 py-1 flex items-center border-gray-800 border-opacity-75 border-2" :class="{ 'opacity-25': approved }" :disabled="approved">save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="h-[730px] overflow-y-auto" :class="{'hidden': isActive !== 2 }">
                        <div class="w-full h-auto pb-2 mb-4 mt-2">
                            <div class="bg-white rounded-xl p-5 w-full">
                                <div class="flex justify-between">
                                    <label class="bg-gray-200 border-2 focus:outline-none w-full p-2 rounded" :class="{'border-red-700': errors.funding !== ''}">Do you accept lottery funding?</label>
                                    <div class="flex justify-between ml-2">
                                        <div class="">
                                            <label class="inline-block" for="yes">Yes</label>
                                            <input type="radio" v-model="finance.funding" value="yes" class="focus:ring-[#639f1e] bg-gray-200 ml-2 focus:border-[#639f1e] border-2 border-[#639f1e] text-[#639f1e] cursor-pointer" name="funding">
                                        </div>
                                        <div class="">
                                            <label class="inline-block" for="no">No</label>
                                            <input type="radio" v-model="finance.funding" value="no" class="focus:ring-[#639f1e] bg-gray-200 ml-1 focus:border-[#639f1e] border-2 border-[#639f1e] text-[#639f1e] cursor-pointer" name="funding">
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-200 w-full border-2 p-2 rounded mt-3">What are your funding streams?</div>
                                <textarea v-model="finance.text1" class="w-full focus:ring-[#639f1e] bg-gray-200 focus:border-[#639f1e] border-2 mt-3 bg-gray-200 rounded-md" cols="30" rows="6"></textarea>
                                <div class="bg-gray-200 w-full border-2 p-2 rounded mt-3">What are your expenses?</div>
                                <textarea v-model="finance.text2" class="w-full focus:ring-[#639f1e] bg-gray-200 focus:border-[#639f1e] border-2 border-2 mt-3 bg-gray-200 rounded-md" cols="30" rows="6"></textarea>
                            </div>
                            <div class="pr-5 flex justify-end">
                                <button @click="saveFinancePlan(finance)" class="bg-[#639f1e] cursor-pointer bg-opacity-75 hover:bg-opacity-100 text-white justify-center text-center px-4 py-1 flex items-center border-gray-800 border-opacity-75 border-2" :class="{ 'opacity-25': approved }" :disabled="approved">save</button>
                            </div>
                        </div>
                    </div>
                    <div class="h-[730px] overflow-y-auto" :class="{'hidden': isActive !== 3 }">
                        <div class="w-full h-auto pb-2 mb-4 mt-2">
                            <div class="bg-white rounded-xl p-5">
                                <p class="text-sm text-center">Please provide your scial media channels</p>
                                <div class="flex mt-2 items-center">
                                    <i class="fas fa-globe w-16 fa-2x text-[#639f1e]"></i>
                                    <input type="text" v-model="socialInfo.website" placeholder="website" class="w-full ml-3 border-2 bg-gray-200">
                                </div>
                                <div class="flex mt-2 items-center">
                                    <i class="fab fa-facebook w-16 fa-2x text-[#639f1e]"></i>
                                    <input type="text" v-model="socialInfo.facebook" placeholder="facebook" class="w-full ml-3 border-2 bg-gray-200">
                                </div>
                                <div class="flex mt-2 items-center">
                                    <i class="fab fa-twitter w-16 fa-2x text-[#639f1e]"></i>
                                    <input type="text" v-model="socialInfo.twitter" placeholder="twitter" class="w-full ml-3 border-2 bg-gray-200">
                                </div>
                                <div class="flex mt-2 items-center">
                                    <i class="fab fa-instagram w-16 fa-2x text-[#639f1e]"></i>
                                    <input type="text" v-model="socialInfo.instagram" placeholder="instagram" class="w-full ml-3 border-2 bg-gray-200">
                                </div>
                                <div class="flex mt-2 items-center">
                                    <i class="fab fa-meetup w-16 fa-2x text-[#639f1e]"></i>
                                    <input type="text" v-model="socialInfo.meetup" placeholder="meetup" class="w-full ml-3 border-2 bg-gray-200">
                                </div>
                                <div class="flex mt-2 items-center">
                                    <i class="fab fa-youtube w-16 fa-2x text-[#639f1e]"></i>
                                    <input type="text" v-model="socialInfo.youtube" placeholder="youtube" class="w-full ml-3 border-2 bg-gray-200">
                                </div>
                                <div>
                                    <h3 class="text-center my-4">Anyothers</h3>
                                    <textarea v-model="socialInfo.others" class="w-full border-2 bg-gray-200" cols="30"
                                        rows="6"></textarea>
                                </div>
                            </div>
                            <div class="pr-5 flex justify-end">
                                <button @click="saveSocialInfo()" class="bg-[#639f1e] cursor-pointer bg-opacity-75 hover:bg-opacity-100 text-white justify-center text-center px-4 py-1 flex items-center border-gray-800 border-opacity-75 border-2" :class="{ 'opacity-25': approved }" :disabled="approved">save</button>
                            </div>
                        </div>
                    </div>
                    <div class="h-[730px] overflow-y-auto" :class="{'hidden': isActive !== 4 }">
                        <div class="w-full h-auto pb-2 mb-4 mt-2">
                            <div class="bg-white rounded-xl p-5">
                                <p class="text-lg text-gray-400">Who are your leadership team</p>
                                <textarea v-model="leadership.organisers" class="w-full border-2 bg-gray-200 mt-5 rounded-xl placeholder:text-center" cols="30"
                                    rows="6" placeholder="Organisers"></textarea>
                                <textarea v-model="leadership.leaders" class="w-full border-2 bg-gray-200 mt-5 rounded-xl placeholder:text-center" cols="30"
                                    rows="6" placeholder="Leaders"></textarea>
                                <textarea v-model="leadership.assistants" class="w-full border-2 bg-gray-200 mt-5 rounded-xl placeholder:text-center" cols="30"
                                    rows="6" placeholder="Assistances"></textarea>
                                <textarea v-model="leadership.mentors" class="w-full border-2 bg-gray-200 mt-5 rounded-xl placeholder:text-center" cols="30"
                                    rows="6" placeholder="Mentors"></textarea>
                            </div>
                            <div class="pr-5 flex justify-end">
                                <button @click="saveLeadershipInfo()" class="bg-[#639f1e] cursor-pointer bg-opacity-75 hover:bg-opacity-100 text-white justify-center text-center px-4 py-1 flex items-center border-gray-800 border-opacity-75 border-2" :class="{ 'opacity-25': approved }" :disabled="approved">save</button>
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
