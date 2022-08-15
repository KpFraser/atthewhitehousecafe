<script setup>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import BreezeLabel from '@/Components/Label.vue';
    import BreezeInput from '@/Components/Input.vue';
    import MasterFooter from '@/Components/MasterFooter.vue';
    import MasterHeader from '@/Components/MasterHeader.vue';
    import BreezeButton from '@/Components/Button.vue';
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import { ref, reactive , onMounted} from 'vue';
    import axios from 'axios';
    import useFooterList from "../../../use/useFooterList";

    const { footerLists , avb } = useFooterList()
    const survey = reactive({answers: {}})
    const names = ref({})

    const surveyData = () =>{
        axios
            .post('/surveyProjects', survey)
            .then((response)=>{

        })
    }
    const surveyProjects = () =>{
        axios
            .get('/surveyProjects')
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
                <form class="border-8 border-[#556553] border-opacity-75 mb-32 mt-5 mx-auto" @submit.prevent="surveyData()">
                    <h1 class="bg-[#639f1e] bg-opacity-75 p-3">How might you engage with these projects-</h1>
                    <div class="p-4 space-y-4">
                        <div class="flex">
                            <div class="w-1/2"></div>
                            <div class="flex text-[11px] w-full justify-between">
                                <div>Never</div>
                                <div>Participant</div>
                                <div>Assistant</div>
                                <div>Leader</div>
                            </div>
                        </div>
                        <div class="flex items-center" v-for="options in names">
                            <BreezeLabel class="w-1/2 text-[14px]" :value="options.name"/>
                            <div class="flex w-full justify-between">
                                <input type="radio" v-model="survey.answers[options.id]" value="0" :id="options.id" class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] transition ease-in-out p-2.5">
                                <input type="radio" v-model="survey.answers[options.id]" value="1" :id="options.id" class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] transition ease-in-out p-2.5">
                                <input type="radio" v-model="survey.answers[options.id]" value="2" :id="options.id" class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] transition ease-in-out p-2.5">
                                <input type="radio" v-model="survey.answers[options.id]" value="3" :id="options.id" class="text-[#20351d] bg-[#cccccc] focus:ring-[#20351d] transition ease-in-out p-2.5">
                            </div>
                        </div>
                    </div>
                    <h1 class="bg-[#639f1e] bg-opacity-75 py-3">If you would like us to contact you, please complete-</h1>
                    <div class="w-full p-2">
                        <div class="mb-6">
                            <BreezeLabel value="Name"/>
                            <BreezeInput v-model="survey.name"/>
                        </div>
                        <div class="mb-6">
                            <BreezeLabel value="Phone Number"/>
                            <BreezeInput v-model="survey.phone_number"/>
                        </div>
                        <div class="mb-6">
                            <BreezeLabel value="Email"/>
                            <BreezeInput v-model="survey.email"/>
                        </div>
                        <BreezeButton class="bg-opacity-75 mt-4 bg-[#639f1e] text-white w-full font-sans submit mx-auto py-3 justify-center text-[25px] font-bold">
                            Save
                        </BreezeButton>
                    </div>
                </form>
            </div>
            <MasterFooter
                :footerLists="footerLists"
            />
        </div>
    </BreezeAuthenticatedLayout>
</template>
