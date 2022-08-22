<script setup>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import BreezeLabel from '@/Components/Label.vue';
    import BreezeInput from '@/Components/Input.vue';
    import MasterFooter from '@/Components/MasterFooter.vue';
    import MasterHeader from '@/Components/MasterHeader.vue';
    import BreezeButton from '@/Components/Button.vue';
    import commonFunctions from "@/use/common";
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import { ref, reactive , onMounted} from 'vue';
    import axios from 'axios';
    import useFooterList from "../../../use/useFooterList";

    const { Toast } = commonFunctions()
    const { footerLists , avb } = useFooterList()
    const names = ref({})

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
                <div class="border-8 border-[#556553] pb-5 border-opacity-75 mb-32 mt-5 mx-auto">
                    <div class="text-[#639f1e]">
                        <h1 class="text-3xl font-sans text-center bg-opacity-75 p-3">PROPOSED</h1>
                        <div class="text-center">Diet of Activities</div>
                    </div>
                    <div class="flex ml-5 mb-5 items-center" v-for="name in names">
                        <i class="far fa-pencil text-[16px]"></i>
                        <div class="ml-5 text-[16px]">{{name.name}}</div>
                    </div>
                    
                </div>
            </div>
            <MasterFooter
                :footerLists="footerLists"
            />
        </div>
    </BreezeAuthenticatedLayout>
</template>
