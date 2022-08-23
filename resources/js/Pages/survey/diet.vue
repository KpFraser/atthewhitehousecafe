<script setup>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import MasterFooter from '@/Components/MasterFooter.vue';
    import MasterHeader from '@/Components/MasterHeader.vue';
    import { ref , onMounted} from 'vue';
    import axios from 'axios';
    import useFooterList from "../../../use/useFooterList";

    const { footerLists  } = useFooterList()
    const names = ref({})

    const surveyProjects = () =>{
        axios
            .get('/surveyProjects')
            .then((response)=>{
                names.value = response.data
            })
    }

    const nameEdit = (id) =>{
        axios
            .post('/name-edit', id)
            .then((response)=>{
                console.log(response)
        });
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
                    <div class="flex ml-5 mb-5" v-for="name in names">
                        <div class="flex items-center ml-5 mb-5">
                            <i class="far fa-pencil text-[16px] hover:text-[#639f1e]"></i>
                            <div class="ml-5 text-[16px]">{{name.name}}</div>
                        </div>
                        <div class="flex ml-5 items-center mb-5">
                            <i class="far fa-check text-[20px] hover:text-[#639f1e]" @click="nameEdit(name.id)"></i>
                            <input type="text" v-model="name.name" class="ml-4 h-8 rounded">
                        </div>
                    </div>

                </div>
            </div>
            <MasterFooter
                :footerLists="footerLists"
            />
        </div>
    </BreezeAuthenticatedLayout>
</template>
