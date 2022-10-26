<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import MasterFooter from '@/Components/MasterFooter.vue';
import MasterHeader from '@/Components/MasterHeader.vue';
import useFooterList from "../../../use/useFooterList";
import { Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import {ref, onMounted } from "vue";
import commonFunctions from "@/use/common";

const { Toast } = commonFunctions()
const { footerLists } = useFooterList()
const information = ref({}),
    errors = ref({name:[]})

const projectInfo = () => {
    const queryString = window.location.href;
    let slug = queryString.split('/')[4];
    axios
        .get('/new-projects/'+slug)
        .then((response)=>{
            information.value= response.data.data
        })
}

const updateInfo = (id) =>{
    if(information.value.name !== ''){
        if(information.value.updating) return
        information.value.updating = true
        axios
            .post ('/update-project', information.value)
            .then((response)=>{
                if(response.data.success === true)
                    Toast.fire({icon: "success",title: "Project updated successfully!"})
                if (id===1)
                    Inertia.visit('/projectshome')
            })
            .catch(function (error) {
                   errors.value.name = error.response.data.errors.name
            })
            .finally(()=> information.value.updating = false)
    } else
        errors.value.name.push('Name is required')
}

const approveInfo = () =>{
    if(information.value.approving) return
    information.value.approving = true
    information.value.approve = 1
    axios
        .post ('/approve-project' , information.value)
        .then((response)=>{
            if(response.data.success === true) {
                Toast.fire({icon: "success", title: "Project approved successfully!"})
                Inertia.visit('/allproject')
            }
        })
        .finally(()=> information.value.approving = false)
}

onMounted( ()=> {
    projectInfo ()

})
</script>

<template>
    <BreezeAuthenticatedLayout>
        <div class="flex justify-center bg-white items-center max-w-lg mx-auto font-serif">
            <div class="w-full justify-center">
                <MasterHeader/>
                <form class="text-black mt-10 mb-28 space-y-4 bg-white text-lg mx-10">
                    <div class="flex justify-end mr-4">
                        <Link :href="route('all-project')" class="text-[25px] bg-[#639f1e] px-1 text-center font-bold bg-opacity-75">X</Link>
                    </div>
                    <div class="flex items-center">
                        <BreezeLabel value="Name" />
                        <div v-if="errors?.name !== ''" class="text-xs font-bold text-red-700 ml-2" v-for="message in errors?.name">* {{message}}</div>
                    </div>
                    <BreezeInput v-model="information.name"/>
                    <div class="flex items-center">
                        <BreezeLabel value="Possible Location" />
                    </div>
                    <BreezeInput v-model="information.location"/>
                    <div class="flex items-center">
                        <BreezeLabel value="Frequency" />
                    </div>
                    <BreezeInput v-model="information.frequency"/>
                    <div class="flex items-center">
                        <BreezeLabel value="Requirements" />
                    </div>
                    <BreezeInput v-model="information.requirements"/>
                    <a :href="'/project-leadership/application/'+ information.slug" target="_blank" class="flex  bg-[#639f1e] hover:bg-opacity-100 bg-opacity-75 cursor-pointer w-[125px] items-center">
                        <BreezeLabel value="Applications" class="cursor-pointer !text-white text-center py-1 px-3"/>
                    </a>
                    <div class="flex justify-around border-b-8 border-opacity-75 border-[#639f1e] space-x-4 items-center">
                        <a :href="'/project-leadership/assistant/'+ information.slug" target="_blank">
                            <BreezeLabel value="Assistant" class="cursor-pointer hover:underline"/>
                        </a>
                        <a :href="'/project-leadership/leader/'+ information.slug" target="_blank">
                            <BreezeLabel value="Leader" class="cursor-pointer hover:underline"/>
                        </a>
                    </div>
                    <button v-show="information.is_approved !== 1" type="button" @click="updateInfo" class="inline-flex items-center font-bold transition ease-in-out duration-150 bg-opacity-75 mt-4 bg-[#639f1e] text-white w-full font-sans submit mx-auto py-3 justify-center text-[25px]" :class="{ 'opacity-25': information.updating }" :disabled="information.updating">
                        Update
                    </button>
                    <button v-show="information.is_approved !== 1" type="button" @click="approveInfo" class="inline-flex items-center font-bold transition ease-in-out duration-150 bg-opacity-75 mt-4 bg-[#639f1e] text-white w-full font-sans submit mx-auto py-3 justify-center text-[25px]" :class="{ 'opacity-25': information.approving }" :disabled="information.approving">
                        Approved
                    </button>
                    <button v-show="information.is_approved === 1" type="button" @click="updateInfo(1)" class="inline-flex items-center font-bold transition ease-in-out duration-150 bg-opacity-75 mt-4 bg-[#639f1e] text-white w-full font-sans submit mx-auto py-3 justify-center text-[25px]" :class="{ 'opacity-25': information.approving }" :disabled="information.approving">
                        Save
                    </button>
                </form>
            </div>
            <MasterFooter
                :footerLists="footerLists"
            />
        </div>
    </BreezeAuthenticatedLayout>
</template>
