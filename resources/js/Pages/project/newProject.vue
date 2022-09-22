<script setup>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import MasterFooter from '@/Components/MasterFooter.vue';
    import MasterHeader from '@/Components/MasterHeader.vue';
    import { ref , onMounted} from 'vue';
    import axios from 'axios';
    import { Link } from '@inertiajs/inertia-vue3';
    import useFooterList from "../../../use/useFooterList";
    import commonFunctions from "@/use/common";
    import {Inertia} from "@inertiajs/inertia";

    const baseUrl = window.location.origin
    const { Toast, ConfirmToast } = commonFunctions()
    const { footerLists  } = useFooterList()
    const names = ref({}),
        option = ref(-1),
        validationErrors = ref({})


    const pencil = (slug) => {
        Inertia.visit('/proposed/'+slug)
        // option.value = key
    }

    const plusbtn = () => {

        if(names.value.length === 0){
            names.value.push({id: '', name: ''});
            option.value = names.value.length-1;
        }
        else {
            let last_id = names.value[names.value.length-1]?.id;
            if(!!last_id) {
                names.value.push({id: '', name: ''});
                option.value = names.value.length-1;
            }
        }
    }

    const validation = (name) =>{
        if(!name.name)
            validationErrors.value.name = ['* Required field!']
    }

    const enterNewProject = (name) => {
        validation (name)
        if (!!name.name){
            axios
                .post('/project-names', {name, module:1})
                .then((response)=>{
                    Toast.fire({icon: "success", title: "Updated Successfully!"})
                    projectName ()
                    option.value = -1
                });
        }
    }

    const projectName = () => {
      axios
        .get('/project-names')
        .then((response)=>{
            console.log(response)
            names.value = response.data
        })
    }

    const deleteProject = (id) =>{
        if (!!id){
            ConfirmToast.fire({}).then((confirmed) => {
                if (confirmed.isConfirmed === true) {
                    axios
                        .delete('/delete-project/' + id)
                        .then((response) => {
                            Toast.fire({icon: "success", title: "Deleted Successfully!"})
                            projectName()
                        })
                }
            })
        }
    }

    onMounted( ()=> {
         projectName ()
    })

</script>

<template>
    <BreezeAuthenticatedLayout>
        <div class="flex justify-center bg-white items-center max-w-lg mx-auto font-serif">
            <div class="w-full justify-center">
                <MasterHeader/>
                <div class="flex justify-end my-6 mr-4">
                    <Link :href="route('projectshome')" class="text-[25px] bg-[#639f1e] p-1 text-center font-bold bg-opacity-75">
                        <i class="fas fa-home"></i>
                    </Link>
                </div>
                <div class="border-8 border-[#556553] pb-5 border-opacity-75 mb-28 mt-5 mx-auto">
                    <div class="text-[#639f1e]">
                        <h1 class="text-3xl font-sans text-center bg-opacity-75 p-3 uppercase">PROPOSED</h1>
                        <div class="text-center">Diet of Activities</div>
                    </div>
                    <div class="min-h-[30vh] overflow-y-auto">
                        <div class="flex ml-5 mt-4" v-for="(name,key) in names">
                            <div class="grid grid-cols-4 w-full flex items-center ml-5 mt-5" v-show="key !== option">
                                <Link :href="baseUrl+'/proposed/'+name.slug" class="col-span-3 text-[16px]">
                                    {{name.name}}
                                </Link>
                                <div class="flex justify-center">
                                    <i class="far fa-pencil cursor-pointer border hover:text-white rounded p-1.5 text-[20px] hover:bg-[#639f1e]" @click="pencil(name.slug)"></i>
                                    <i class="fas fa-trash cursor-pointer text-[20px] hover:text-white rounded px-2 py-1.5 border hover:bg-red-600 mx-5" @click="deleteProject(name.id)"></i>
                                </div>
                            </div>
                            <div class="flex ml-5 flex items-center mt-4" v-show="option === key">
                                <input type="text" v-on:keyup.enter="enterNewProject(name)" v-model="name.name" class="ml-4 h-8 rounded border-[#556553] active:border-[#556553] focus:ring-0 focus:border-[#556553] hover:border-[#556553]" autofocus>
                                <i class="far fa-check cursor-pointer ml-4 border hover:text-white rounded p-1.5 text-[20px] hover:bg-[#639f1e]" @click="enterNewProject(name)"></i>
                                <div v-if="!name.name" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.name">{{ message }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="mx-auto flex mt-5 justify-center">
                        <div class="w-60 cursor-pointer p-4 bg-[#639f1e] justify-between items-center flex" @click="plusbtn()">
                            <div class="text-xl ">Proposed An Activity</div>
                            <i class="text-xl fas fa-plus-circle"></i>
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
