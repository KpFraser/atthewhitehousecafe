<script setup>
    import MasterFooter from '@/Components/MasterFooter.vue';
    import MasterHeader from '@/Components/MasterHeader.vue';
    import BreezeCheckbox from '@/Components/Checkbox.vue';
    import Location from '@/Components/Svg/Location.vue';
    import Finance from '@/Components/Svg/Finance.vue';
    import Search from '@/Components/Svg/Search.vue';
    import Setting from '@/Components/Svg/Setting.vue';
    import Save from '@/Components/Svg/Save.vue';
    import Insurance from '@/Components/Svg/Insurance.vue';
    import Thumb from '@/Components/Svg/Thumb.vue';
    import Risk from '@/Components/Svg/Risk.vue';
    import Marketing from '@/Components/Svg/Marketing.vue';
    import useFooterList from "../../../use/useFooterList";
    import {ref, onMounted } from "vue";
    import { Link } from '@inertiajs/inertia-vue3';
    import commonFunctions from "@/use/common";
    import {Inertia} from "@inertiajs/inertia";

    const { Toast } = commonFunctions(),
        { footerLists } = useFooterList()

    const isActive = ref(0),
        subTabActive = ref(1),
        project = ref({name:'', id:'', slug:''}),
        approved = ref(false),
        location = ref({project_id:'', address_1:'', address_2: '', city:'', postcode:'', country:'', repeat_time:'', repeat_every:'', never:'', on:'', after:'',
            repeat_on:[{day: 'mon', value:0}, {day: 'tue', value:0}, {day: 'wed', value:0}, {day: 'thu', value:0}, {day: 'fri', value:0}, {day: 'sat', value:0}, {day: 'sun', value:0}]}),
        ends = ref ({}),
        leadership = ref({}),
        safety = ref ({date: '', document:'', document_name:'', text1:'', text2:'', text3:''}),
        errors = ref ({riskManagement:'', document:'', text1:'', text2:'', text3:'', funding:''}),
        riskManagement = ref([]),
        finance = ref({funding: '', text1: '', text2: ''}),
        socialInfo = ref({}),
        nameError = ref(),
        locationError = ref ({address_1:'', city:'', country:'', postcode:'', repeat_time:'', repeat_every:'', ends:'', days: ''}),
        usersTeam = ref({}),
        users = ref({}),
        checkUser =ref({checkedOptions:{}})

    const selectDay = (tab) =>{
        let index = _.findKey(location.value.repeat_on, function(o) { return o.day === tab; });
        if(location.value.repeat_on[index].value === 0)
            location.value.repeat_on[index].value = 1
        else
            location.value.repeat_on[index].value = 0
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

        locationError.value = {address_1:'', city:'', country:'', postcode:'', repeat_time:'', repeat_every:'', ends:'', days: ''}

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
        if (location.value.repeat_on[0].value === 0 && location.value.repeat_on[1].value === 0 && location.value.repeat_on[2].value === 0 && location.value.repeat_on[3].value === 0 && location.value.repeat_on[4].value === 0 && location.value.repeat_on[5].value === 0 && location.value.repeat_on[6].value === 0)
            locationError.value.days = '* Required'

        return(!locationError.value.address_1 && !locationError.value.city && !locationError.value.country && !locationError.value.postcode && !locationError.value.repeat_time && !locationError.value.repeat_every && !locationError.value.ends && !locationError.value.days)

    }

    const locationSubmit = (post) =>{
        let valid = locationValidation (post)
        if(valid){
            approved.value = true
            axios
                .post('/location-information', location.value)
                .then((response)=>{
                    if(response.data.success) {
                        Toast.fire({icon: "success", title: "Saved"})
                    }
                }).finally(() => approved.value = false)
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
                .post('/save-risk', {project_id:project.value.id, riskManagement:riskManagement.value})
                .then((response)=>{
                    if(response.data.success){
                        Toast.fire({icon: "success", title: "Saved"})
                        approved.value = false
                        proposalAllData ()
                    }
                }).finally(() => approved.value = false)
        } else
            errors.value.riskManagement = '* All field are required !'
    }

    const safetyValidation = (post) => {
        errors.value = {riskManagement:'', document:'', text1:'', text2:'', text3:'', funding:''}

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
            formData.append('project_id',  project.value.id);
            axios
                .post('/safety-info', formData , {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then((response)=>{
                    if(response.data.success){
                        Toast.fire({icon: "success", title: "Saved"})
                        approved.value = false
                    }
                })
                .finally(() => approved.value = false)
        }
    }

    const insuranceDocument = (e) =>{
        safety.value.document = e.target.files[0]
    }

    const saveFinancePlan = (post) =>{
        if (post.funding !== ''){
            approved.value = true
            axios
                .post('/save-finance', {project_id:project.value.id, finance:finance.value})
                .then((response)=>{
                    if(response.data.success){
                        Toast.fire({icon: "success", title: "Saved"})
                        approved.value = false
                    }
                }).finally(() => approved.value = false)
        } else
            errors.value.funding = '* Select yes or no !'
    }

    const saveSocialInfo = () =>{

            approved.value = true
            axios
                .post('/save-social', {social: socialInfo.value, project_id:project.value.id})
                .then((response)=>{
                    if(response.data.success){
                        Toast.fire({icon: "success", title: "Saved"})
                        approved.value = false
                    }
                }).finally(() => approved.value = false)
    }

    const saveLeadershipInfo = () =>{

        // approved.value = true
        // axios
        //     .post('/save-leadership', leadership.value)
        //     .then((response)=>{
        //         if(response.data.success){
        //             Toast.fire({icon: "success", title: "Saved"})
        //             approved.value = false
        //         }
        //     }).finally(() => approved.value = false)
    }

    const proposalAllData = () => {

        let ProSlug = window.location.href.split('/')[4]
        if(!!ProSlug) {
            isActive.value = 1
            axios
                .get('/proposals-page-information/' + ProSlug)
                .then((response) => {

                    project.value.name = response.data?.data?.project_name
                    project.value.id = response.data?.data?.project_id
                    project.value.slug = response.data?.data?.project_slug
                    location.value.project_id = response.data?.data?.project_id

                    if(!!response.data?.data?.ProjectLocation)
                        location.value = response.data?.data?.ProjectLocation

                    if(response.data?.data?.ProjectRisk?.length !== 0)
                        riskManagement.value = response.data?.data?.ProjectRisk
                    else
                        riskManagement.value.push({id: '', name: '', risk: '', control: ''})

                    if(!!response.data?.data?.ProjectSafety)
                        safety.value = response.data?.data?.ProjectSafety

                    if(!!response.data?.data?.ProjectFunding)
                        finance.value = response.data?.data?.ProjectFunding

                    if(!!response.data?.data?.ProjectMedia)
                        socialInfo.value = response.data?.data?.ProjectMedia
                    if(!!response.data?.data1?.length>0)
                        users.value = response.data?.data1
                    if(!!response.data?.data2?.length>0)
                        usersTeam.value = response.data?.data2
                })
        }
    }

    const saveName = (post, id) =>{
        nameError.value = ''
        if(!!post) {
            approved.value = true
            axios
                .post('/project-names', {name: post, id: id})
                .then((response) => {
                    if (response.data.success){
                        Toast.fire({icon: "success", title: "Project Saved"})
                        Inertia.visit('/proposals/'+response.data?.data?.slug)
                    }
                }).catch((err)=>{
                    nameError.value = err.response?.data?.errors?.name[0]
            }).finally(()=>{
                approved.value = false
            });
        } else
            nameError.value = 'Project name is required !'
    }

    const appointModel = (role) =>{
        if (!!usersTeam.value){
            const test = usersTeam.value.filter(x=>x.role === role)

            _.forEach(test, function (value, key) {
                if (value.status === 1) {
                    checkUser.value.checkedOptions[value.user_id] = true
                } else if (value.status === 2) {
                    checkUser.value.checkedOptions[value.user_id] = false
                }
            });
        }
        checkUser.value.role = role
        $('#AppointTeamModal').modal('show');
    }

    const checkedNames = () =>{

        checkUser.value.project_id = project.value.id
        checkUser.value.apply_appoint = 2
        if (!!checkUser.value.project_id && !!checkUser.value.apply_appoint && !!checkUser.value.role){
            axios
                .post('/checked-names', checkUser.value)
                .then((response)=>{
                    if(response.data.success){
                        Toast.fire({icon: "success", title: "Saved"})
                        proposalAllData()
                        isActive.value = 4
                        $('#AppointTeamModal').modal('hide');
                    }
                })
        }
    }

    const approveName = (post, id) =>{
        nameError.value = ''
        if(!!post) {
            approved.value = true
            axios
                .post('/project-approve', {name: post, id: id})
                .then((response) => {
                    if (response.data.success){
                        Toast.fire({icon: "success", title: "Project Approved"})
                        Inertia.visit('/proposals/'+response.data?.data?.slug)
                    }
                }).catch((err)=>{
                nameError.value = err.response?.data?.errors?.name[0]
            }).finally(()=>{
                approved.value = false
            });
        } else
            nameError.value = 'Project name is required !'
    }

    onMounted(()=>{
        proposalAllData ()
    })

</script>

<template>
    <div class="flex justify-center bg-white items-center max-w-lg mx-auto font-serif">
        <div class="w-full">
            <MasterHeader/>
            <div class="relative text-black mt-4 border-4 border-b-4 border-[#20351d] border-opacity-75 mb-28 bg-white text-lg">
                <ul :class="{'pointer-events-none':isActive === 0}" class="w-full flex !text-gray-800 justify-between">
                    <li @click="isActive = 1" class="!w-[20%] hover:text-gray-200 m-1 cursor-pointer bg-[#639f1e] bg-opacity-75 rounded p-2 text-center">
                        <Setting :tab = isActive />
                    </li>
                    <li @click="isActive = 2" class="!w-[20%] hover:text-black m-1 cursor-pointer bg-[#639f1e] bg-opacity-75 rounded p-2 text-center">
                        <Finance :tab = isActive />
                    </li>
                    <li @click="isActive = 3" class="!w-[20%] hover:text-black m-1 cursor-pointer bg-[#639f1e] bg-opacity-75 rounded p-2 text-center">
                        <Marketing :tab = isActive />
                    </li>
                    <li @click="isActive = 4" class="!w-[20%] hover:text-black m-1 cursor-pointer bg-[#639f1e] bg-opacity-75 rounded p-2 text-center">
                        <Search :tab = isActive />
                    </li>
                    <Link :href="route('plan')" class="!w-[20%] !pointer-events-auto m-1 hover:text-red-700 cursor-pointer bg-[#639f1e] bg-opacity-75 rounded text-center">
                        <div class="flex mx-auto items-center justify-center w-full h-full">
                            <i class="text-[46px] text-gray-600 fal fa-times"></i>
                        </div>
                    </Link>
                </ul>
                <div :class="{'!h-[200px]': isActive === 0}" class="bg-white max-w-lg mx-auto">
                    <div class="h-[743px] overflow-y-auto" :class="{'hidden': isActive !== 1 }" >
                        <div class="">
                            <ul class="w-full grid grid-cols-5 text-gray-800">
                                <li @click="subTabActive = 1" :class="{'bg-opacity-100 text-black': subTabActive === 1 }" class="bg-[#3a542a] mx-1 rounded-xl cursor-pointer text-center">
                                    <div class="flex mx-auto">
                                        <Location :tab = subTabActive />
                                    </div>
                                </li>
                                <li @click="subTabActive = 2" :class="{'bg-opacity-100 text-black': subTabActive === 2 }" class="bg-[#3a542a] mx-1 rounded-xl cursor-pointer text-center">
                                    <div class="flex mt-1 mx-auto">
                                        <Risk :tab = subTabActive />
                                    </div>
                                </li>
                                <li @click="subTabActive = 3" :class="{'bg-opacity-100 text-black': subTabActive === 3 }" class="bg-[#3a542a] mx-1 rounded-xl cursor-pointer text-center">
                                    <div class="flex mx-auto">
                                        <Insurance :tab = subTabActive />
                                    </div>
                                </li>
                            </ul>
                            <div class="" :class="{'hidden': subTabActive !== 1 }">
                                <div class="p-4 border-4 h-[670px] overflow-y-auto">
                                    <div class="bg-white">
                                        <input v-model="project.name" type="text" class="bg-gray-200 p-2 mt-2 w-full rounded-md" disabled>
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
                                            <span @click="selectDay('mon')" :class="{'!bg-[#639f1e]': location.repeat_on[0]?.value === 1, 'border border-red-500': locationError.days !== ''}" class="w-8 h-8 rounded-full bg-gray-200 text-center py-1 cursor-pointer">M</span>
                                            <span @click="selectDay('tue')" :class="{'!bg-[#639f1e]': location.repeat_on[1]?.value === 1, 'border border-red-500': locationError.days !== ''}" class="w-8 h-8 rounded-full bg-gray-200 text-center py-1 ml-2 cursor-pointer">T</span>
                                            <span @click="selectDay('wed')" :class="{'!bg-[#639f1e]': location.repeat_on[2]?.value === 1, 'border border-red-500': locationError.days !== ''}" class="w-8 h-8 rounded-full bg-gray-200 text-center py-1 ml-2 cursor-pointer">W</span>
                                            <span @click="selectDay('thu')" :class="{'!bg-[#639f1e]': location.repeat_on[3]?.value === 1, 'border border-red-500': locationError.days !== ''}" class="w-8 h-8 rounded-full bg-gray-200 text-center py-1 ml-2 cursor-pointer">T</span>
                                            <span @click="selectDay('fri')" :class="{'!bg-[#639f1e]': location.repeat_on[4]?.value === 1, 'border border-red-500': locationError.days !== ''}" class="w-8 h-8 rounded-full bg-gray-200 text-center py-1 ml-2 cursor-pointer">F</span>
                                            <span @click="selectDay('sat')" :class="{'!bg-[#639f1e]': location.repeat_on[5]?.value === 1, 'border border-red-500': locationError.days !== ''}" class="w-8 h-8 rounded-full bg-gray-200 text-center py-1 ml-2 cursor-pointer">S</span>
                                            <span @click="selectDay('sun')" :class="{'!bg-[#639f1e]': location.repeat_on[6]?.value === 1, 'border border-red-500': locationError.days !== ''}" class="w-8 h-8 rounded-full bg-gray-200 text-center py-1 ml-2 cursor-pointer">S</span>
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
                                               <div class="flex items-center space-x-2">
                                                   <input v-if="ends === 'after' || location.after !== '' && location.after !== null" v-model="location.after" type="number" class="w-40 h-8 bg-gray-200 rounded-md px-3 ">
                                                   <label class="inline-block text-gray-800">Events</label>
                                               </div>
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
                                <div class="p-4 border-4 h-[670px] overflow-y-auto">
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
                                <div class="p-4 border-4 h-[670px] overflow-y-auto">
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
                                            <label v-if="safety.document !== ''" class="col-span-2 px-2 text-[#639f1e] truncate ...">Doc: {{safety.document?.name}}</label>
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
                    <div class="h-[760px] overflow-y-auto" :class="{'hidden': isActive !== 2 }">
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
                    <div class="h-[760px] overflow-y-auto" :class="{'hidden': isActive !== 3 }">
                        <div class="w-full h-auto pb-2 mb-4 mt-2">
                            <div class="bg-white rounded-xl p-5">
                                <p class="text-sm text-center">Please provide your social media channels</p>
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
                    <div :class="{'hidden': isActive !== 4 }">
                        <div class="w-full h-auto pb-2 mb-4 mt-2">
                            <div class="bg-white rounded-xl p-5 space-y-2 font-sans">
                                <p class="text-lg text-gray-400">Who are your leadership team</p>
                                <div class="h-40 p-2 rounded-xl text-gray-500 bg-[#e1e1e1ff]">
                                    <div class="flex justify-between">
                                        <div>Organisers</div>
                                        <div>
                                            <span class="hover:text-gray-700 cursor-pointer">Apply</span>
                                            <span> / </span>
                                            <span @click="appointModel(1)" class="hover:text-gray-700 cursor-pointer">Appoint</span>
                                        </div>
                                    </div>
                                    <div class="flex m-2">
                                        <div class="mr-4">Applicants:</div>
                                        <div class="text-gray-700">name1, name2</div>
                                    </div>
                                    <div class="flex m-2 w-[400px] truncate ...">
                                        <div class="mr-4">Appointments:</div>
                                        <div class="text-gray-700" v-for="data in usersTeam">
                                            <span v-if="data.status === 1 && data.role === 1">{{data.check_user_name?.name}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="h-40 p-2 rounded-xl text-gray-500 bg-[#e1e1e1ff]">
                                    <div class="flex justify-between">
                                        <div>Leaders</div>
                                        <div>
                                            <span class="hover:text-gray-700 cursor-pointer">Apply</span>
                                            <span> / </span>
                                            <span @click="appointModel(2)" class="hover:text-gray-700 cursor-pointer">Appoint</span>
                                        </div>
                                    </div>
                                    <div class="flex m-2">
                                        <div class="mr-4">Applicants:</div>
                                        <div class="text-gray-700">name1, name2</div>
                                    </div>
                                    <div class="flex m-2 w-[400px] truncate ...">
                                        <div class="mr-4">Appointments:</div>
                                        <div class="text-gray-700" v-for="data in usersTeam">
                                            <pre class="font-sans ov" v-if="data.status === 1 && data.role === 2">{{data.check_user_name?.name}}, </pre>
                                        </div>
                                    </div>
                                </div>
                                <div class="h-40 p-2 rounded-xl text-gray-500 bg-[#e1e1e1ff]">
                                    <div class="flex justify-between">
                                        <div>Assistants</div>
                                        <div>
                                            <span class="hover:text-gray-700 cursor-pointer">Apply</span>
                                            <span> / </span>
                                            <span @click="appointModel(3)" class="hover:text-gray-700 cursor-pointer">Appoint</span>
                                        </div>
                                    </div>
                                    <div class="flex m-2">
                                        <div class="mr-4">Applicants:</div>
                                        <div class="text-gray-700">name1, name2</div>
                                    </div>
                                    <div class="flex m-2 w-[400px] truncate ...">
                                        <div class="mr-4">Appointments:</div>
                                        <div class="text-gray-700" v-for="data in usersTeam">
                                            <pre class="font-sans ov" v-if="data.status === 1 && data.role === 3">{{data.check_user_name?.name}}, </pre>
                                        </div>
                                    </div>
                                </div>
                                <div class="h-40 p-2 rounded-xl text-gray-500 bg-[#e1e1e1ff]">
                                    <div class="flex justify-between">
                                        <div>Mentors</div>
                                        <div>
                                            <span class="hover:text-gray-700 cursor-pointer">Apply</span>
                                            <span> / </span>
                                            <span @click="appointModel(4)" class="hover:text-gray-700 cursor-pointer">Appoint</span>
                                        </div>
                                    </div>
                                    <div class="flex m-2">
                                        <div class="mr-4">Applicants:</div>
                                        <div class="text-gray-700">name1, name2</div>
                                    </div>
                                    <div class="flex m-2 w-[400px] truncate ...">
                                        <div class="mr-4">Appointments:</div>
                                        <div class="text-gray-700" v-for="data in usersTeam">
                                            <pre class="font-sans ov" v-if="data.status === 1 && data.role === 4">{{data.check_user_name?.name}}, </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pr-5 flex justify-end">
                                <button @click="saveLeadershipInfo()" class="bg-[#639f1e] cursor-pointer bg-opacity-75 hover:bg-opacity-100 text-white justify-center text-center px-4 py-1 flex items-center border-gray-800 border-opacity-75 border-2" :class="{ 'opacity-25': approved }" :disabled="approved">save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="isActive === 0 || isActive === 1" class="w-full flex justify-between text-[48px]">
                    <div :class="{'pointer-events-none opacity-50':approved}" @click="saveName(project.name, project.id)" class="m-1 cursor-pointer w-[20%] bg-opacity-75 rounded bg-[#639f1e]">
                        <Save />
                    </div>
                    <div class="m-1 w-[60%]">
                        <input v-model="project.name" type="text" class="flex items-center w-full rounded focus:border-[#639f1e] focus:ring-0 border-2 border-[#639f1e] border-opacity-75" placeholder="Write Project Name here.."/>
                        <div v-if="!!nameError" class="text-red-700 text-xs font-bold text-center py-2">{{nameError}}</div>
                    </div>
                    <div :class="{'pointer-events-none opacity-50':approved}" @click="approveName(project.name, project.id)" class="m-1 cursor-pointer w-[20%] bg-opacity-75 bg-[#639f1e] rounded">
                        <Thumb />
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="AppointTeamModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="userImagePeview" aria-hidden="true">
            <div class="modal-dialog relative w-auto pointer-events-none">
                <div class="modal-content border-none shadow-lg relative mx-auto flex justify-center flex-col w-auto pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                    <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 rounded-t-md">
<!--                        <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLabel">Images</h5>-->
                        <button @click="checkUser = {checkedOptions:{}}" type="button" class="btn-close box-content flex items-center hover:bg-[#7eca21] h-3 text-center font-extrabold bg-[#639f1e] uppercase font-sans text-white" data-bs-dismiss="modal" aria-label="Close">x</button>
                    </div>
                    <div class="modal-body overflow-y-auto relative p-4">
                        <div class=" ">
                            <div class="flex items-center m-2" v-for="data in users">
                                <BreezeCheckbox v-model="checkUser.checkedOptions[data.id]" :checked="checkUser.checkedOptions[data.id] === true" class="accent-[#639f1e] mr-2 w-4 h-4 border-[#639f1e] text-[16px] hover:text-[#639f1e]"/>
                                <label :for="data.id">{{data.name}}</label>
                            </div>
                        </div>
                        <div class="pr-5 flex justify-end">
                            <button @click="checkedNames()" class="bg-[#639f1e] cursor-pointer bg-opacity-75 hover:bg-opacity-100 text-white justify-center text-center px-4 py-1 flex items-center border-gray-800 border-opacity-75 border-2" :class="{ 'opacity-25': approved }" :disabled="approved">save</button>
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
