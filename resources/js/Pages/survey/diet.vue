<script setup>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import MasterFooter from '@/Components/MasterFooter.vue';
    import MasterHeader from '@/Components/MasterHeader.vue';
    import { ref , onMounted} from 'vue';
    import axios from 'axios';
    import useFooterList from "../../../use/useFooterList";
    import commonFunctions from "@/use/common";
    import BreezeCheckbox from '@/Components/Checkbox.vue';

    const { Toast, ConfirmToast } = commonFunctions(),
        { footerLists  } = useFooterList()

    const names = ref({}),
        option = ref({})

    const surveyProjects = () => {
        axios
            .get('/survey-projects')
            .then((response)=>{
                if(response.data.success)
                    names.value = !!response.data.data ? response.data.data: ''
            })
    }

    const checkedProject = (id, name, check) => {
        option.value.id = id
        option.value.name = name
        option.value.check = check
        axios
            .post('/check-project', option.value)
            .then(()=>{

            })
    }

    const deleteProject = (id) =>{
        if (!!id){
            ConfirmToast.fire({}).then((confirmed) => {
                if (confirmed.isConfirmed === true) {
                    axios
                        .delete('/delete-project/' + id)
                        .then(() => {
                            Toast.fire({icon: "success", title: "Deleted Successfully!"})
                            surveyProjects()
                        })
                }
            })
        }
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
                    <div class="flex items-center justify-between ml-5 my-4" v-for="name in names">
                         <div class="flex items-center ml-5">
                             <BreezeCheckbox @change="checkedProject(name.id, name.name, $event.target.checked)" :checked="name.is_survey === 1" :value="name.id" type="checkbox" class="accent-[#639f1e] text-[16px] hover:text-[#639f1e]"/>
                             <div class="ml-5 text-[16px]">{{name.name}}</div>
                        </div>
                        <div class="flex items-center justify-center">
                            <i class="fas fa-trash cursor-pointer text-[20px] hover:text-white rounded px-2 py-1.5 border hover:bg-red-600 mx-5" @click="deleteProject(name.id)"></i>
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
