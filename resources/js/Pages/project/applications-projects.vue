<script setup>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import MasterFooter from '@/Components/MasterFooter.vue';
    import {onMounted, ref} from "vue";
    import MasterHeader from '@/Components/MasterHeader.vue';
    import commonFunctions from "@/use/common";
    import BreezeLabel from '@/Components/Label.vue';
    import { Link } from '@inertiajs/inertia-vue3';
    import useFooterList from "../../../use/useFooterList";

    const { Toast } = commonFunctions()
    const { footerLists  } = useFooterList()

    const allInformation = ref({}),
        projects = ref({}),
        appAnswer = ref({}),
        projectApplication = ref({})

    const apllicationsInfo = () =>{
        axios
            .get('/applications-information')
            .then((response)=>{
                allInformation.value = response.data.data
                projects.value = [...new Map(allInformation.value.map(item =>
                    [item['project_id'], item])).values()]
            })
    }

    const projectApps = (id) =>{
        projectApplication.value = {}
        projectApplication.value = allInformation.value.filter(x => x.project_id === id)
    }

    const applicationInfo = (id) =>{
        appAnswer.value = {}
        appAnswer.value = allInformation.value.find(x => x.id === id)
    }

onMounted( ()=> {
    apllicationsInfo ()
})
</script>

<template>
    <BreezeAuthenticatedLayout>
        <div class="flex justify-center bg-white items-center max-w-lg mx-auto font-serif">
            <div class="w-full justify-center">
                <MasterHeader/>
                <div class="text-black border-4 border-b-4 border-[#20351d] my-10 p-5 border-opacity-75 mb-28 space-y-4 bg-white text-lg">
                    <div class="flex justify-between mx-4">
                        <div class="text-[#20351d] text-2xl font-extrabold">Projects</div>
                        <Link :href="route('projectshome')" class="text-[25px] flex items-center bg-[#639f1e] p-1 text-center font-bold bg-opacity-75">
                            <i class="fas fa-home"></i>
                        </Link>
                    </div>
                    <div class="mx-10 py-2 px-6">
                        <h3 v-if="projects.length !== 0" @click="projectApps(data.projects_name.id)" class="font-bold mb-2 cursor-pointer text-[#639f1e] uppercase" v-for="data in projects" data-bs-toggle="modal" data-bs-target="#preview">
                            {{ data.projects_name.name }}
                        </h3>
                        <div v-else-if="projects.length === 0" class="bg-white py-4 border-t-2 border-opacity-75 font-bold flex items-center justify-center border-[#639f1e] text-center">Empty!</div>
                    </div>
                </div>
            </div>
            <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="preview" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="previewLabel" aria-hidden="true">
                <div class="modal-dialog relative w-auto pointer-events-none">
                    <div class="modal-content border-none shadow-lg relative mx-auto flex justify-center flex-col w-auto pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                        <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                            <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLabel">Application</h5>
                            <button type="button" class="btn-close box-content flex items-center hover:bg-[#7eca21] h-3 text-center font-extrabold bg-[#639f1e] uppercase font-sans text-white" data-bs-dismiss="modal" aria-label="Close">x</button>
                        </div>
                        <div class="modal-body overflow-y-auto relative p-4">
                            <div v-if="projectApplication.length !== 0" v-for="data in projectApplication">
                                <div class="my-2 font-sans mx-auto w-3/4">
                                    <div class="flex justify-between items-center pr-6 py-1.5 bg-[#639f1e] bg-opacity-75 text-black text-xs leading-tight rounded shadow-md font-bold transition duration-150 ease-in-out whitespace-nowrap">
                                        <span class="px-6 py-2 text-[13px] font-bold">{{ data.name }} as {{ data.application_roles.name }}</span>
                                        <span class="flex">
                                        <i @click="applicationInfo(data.id)" class="fas border-2 cursor-pointer border-black flex justify-center items-center fa-plus fa-2x w-8 ml-3 h-8 bg-white rounded-full text-black py-1" data-bs-toggle="modal" data-bs-target="#ApplicationModal"></i>
                                        <i class="fas fa-star fa-2x w-8 ml-3 flex justify-center cursor-pointer items-center h-8 bg-white rounded-full text-black py-1"></i>
                                    </span>
                                    </div>
                                </div>
                            </div>
                            <div v-else-if="projectApplication.length === 0" class="bg-white py-4 border-t-2 border-opacity-75 font-bold flex items-center justify-center border-[#639f1e] text-center">Empty!</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="ApplicationModal" tabindex="-1" aria-labelledby="ApplicationModalLabel" aria-hidden="true">
                <div class="modal-dialog relative w-auto pointer-events-none">
                    <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                        <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                            <h5 class="text-xl font-medium leading-normal text-gray-800" id="ApplicationModalLabel">Applicant as Role</h5>
                            <button type="button" class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline" data-bs-dismiss="modal" aria-label="Close">X</button>
                        </div>
                        <div class="modal-body bg-white relative p-4">
                            <div class="">
                                <div class="px-2">
                                    <BreezeLabel value="What do you do for fun?"/>
                                    <div class="p-2 border-2">{{appAnswer.text1}}</div>
                                </div>
                                <div class="px-2 mt-3">
                                    <BreezeLabel value="Why do you want this role?"/>
                                    <div class="p-2 border-2">{{appAnswer.text2}}</div>
                                </div>
                                <div class="px-2 mt-3">
                                    <BreezeLabel value="What experience do you have?"/>
                                    <div class="p-2 border-2">{{appAnswer.text3}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                            <button type="button" class="px-6 py-2.5 bg-[#639f1e] bg-opacity-75 text-white font-medium text-xs uppercase rounded transition duration-150 ease-in-out" data-bs-dismiss="modal">Close</button>
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

