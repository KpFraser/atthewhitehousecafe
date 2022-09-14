<script setup>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import BreezeLabel from '@/Components/Label.vue';
    import BreezeInput from '@/Components/Input.vue';
    import MasterFooter from '@/Components/MasterFooter.vue';
    import MasterHeader from '@/Components/MasterHeader.vue';
    import BreezeButton from '@/Components/Button.vue';
    import commonFunctions from "@/use/common";
    import { ref, reactive , onMounted} from 'vue';
    import axios from 'axios';
    import useFooterList from "../../../use/useFooterList";

    const { Toast } = commonFunctions()
    const { footerLists , avb } = useFooterList()
    const survey = reactive({}),
        names = ref({}),
        validationErrors = ref({}),
        selected = reactive({})

    const validation = (post) =>{
        if(!post.name)
            validationErrors.value.name = ['* Required feild!']
        if(!post.email)
            validationErrors.value.email = ['* Required feild!']
        if(!post.phone_number)
            validationErrors.value.phone_number = ['* Required feild!']
        return Object.values(validationErrors.value).length === 0;
    }

    const surveyData = (post) =>{

        let valid = validation (post)
        if (valid===true){
            if(survey.processing) return
            survey.processing = true
            axios
                .post('/surveyProjects', {survey, selected})
                .then((response)=>{
                    if(response.data.success === true)
                        Toast.fire({icon: "success",title: "Personal Information updated successfully!"})
                })
                .finally(()=> survey.processing = false)
        }
    }


    const surveyProjects = () =>{
        axios
            .get('/surveyOptions')
            .then((response)=>{
                names.value = response.data
            })
    }
    onMounted( ()=> {
        surveyProjects ()
    })
</script>

<template>
    <BreezeAuthenticatedLayout>
        <div class="flex justify-center bg-white items-center max-w-lg mx-auto font-serif">
            <div class="w-full justify-center">
                <MasterHeader/>
                <div class="border-8 border-[#556553] border-opacity-75 mb-32 mt-5 mx-auto">
                    <h1 class="bg-[#639f1e] bg-opacity-75 p-3">What role would you wish to play in these activites?</h1>
                    <div class="p-4 space-y-4">
                        <div class="flex">
                            <div class="w-1/2"></div>
                            <div class="flex text-[11px] w-full justify-between">
                                <div>None</div>
                                <div>Participant</div>
                                <div>Assistant</div>
                                <div>Leader</div>
                            </div>
                        </div>

                        <div class="flex items-center" v-for="options in names">
                            <BreezeLabel class="w-1/2 text-[14px]" :value="options.name"/>
                            <form class="flex w-full justify-between">
                                <input type="radio" :checked="options.survey_submission?.options === 0" v-model="selected[options.id]" value="0" :name="options.id" class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] transition ease-in-out p-2.5">
                                <input type="radio" :checked="options.survey_submission?.options === 1" v-model="selected[options.id]" value="1" :name="options.id" class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] transition ease-in-out p-2.5">
                                <input type="radio" :checked="options.survey_submission?.options === 2" v-model="selected[options.id]" value="2" :name="options.id" class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] transition ease-in-out p-2.5">
                                <input type="radio" :checked="options.survey_submission?.options === 3" v-model="selected[options.id]" value="3" :name="options.id" class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] transition ease-in-out p-2.5">
                            </form>
                        </div>
                    </div>
                    <form class="mt-5 mx-auto" @submit.prevent="surveyData(survey)">
                        <h1 class="bg-[#639f1e] bg-opacity-75 py-3">If you would like us to contact you, please complete-</h1>
                        <div class="w-full p-2">
                            <div class="mb-6">
                                <div class="flex items-center">
                                    <BreezeLabel value="Name" />
                                    <div v-if="!survey.name" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.name">{{ message }}</div>
                                </div>
                                <BreezeInput type="text" v-model="survey.name" @focusout="delete validationErrors['name']"/>
                            </div>
                            <div class="mb-6">
                                <div class="flex items-center">
                                    <BreezeLabel value="Phone Number"/>
                                    <div v-if="!survey.phone_number" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.phone_number">{{ message }}</div>
                                </div>
                                <BreezeInput type="number" v-model="survey.phone_number" @focusout="delete validationErrors['phone_number']"/>
                            </div>
                            <div class="mb-6">
                                <div class="flex items-center">
                                    <BreezeLabel value="Email"/>
                                    <div v-if="!survey.email" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.email">{{ message }}</div>
                                </div>
                                <BreezeInput type="email" v-model="survey.email" @focusout="delete validationErrors['email']"/>
                            </div>
                            <BreezeButton class="bg-opacity-75 mt-4 bg-[#639f1e] text-white w-full font-sans submit mx-auto py-3 justify-center text-[25px] font-bold" :class="{ 'opacity-25': survey.processing }" :disabled="survey.processing">
                                Save
                            </BreezeButton>
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
