<script setup>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import MasterFooter from '@/Components/MasterFooter.vue';
    import {onMounted, ref} from "vue";
    import MasterHeader from '@/Components/MasterHeader.vue';
    import commonFunctions from "@/use/common";
    import BreezeInput from '@/Components/Input.vue';
    import BreezeLabel from '@/Components/Label.vue';
    import { Link } from '@inertiajs/inertia-vue3';
    import useFooterList from "../../../use/useFooterList";
    const { Toast, ConfirmToast } = commonFunctions()
    const { footerLists  } = useFooterList()

    const answer = ref({})
    const appAnswer = ref({})

    const answers = () =>{
        axios.get('application-answers')
            .then((response)=>{
                answer.value = !!response.data? response.data: ''
            })
    }

    const applicationRole = (id) =>{
        if (!!id) {
            appAnswer.value = answer.value.find(x => x.id === id)
            $('#ApplicationModal').modal('show');
        }
    }

    onMounted( ()=> {
        answers ()
    })
</script>

<template>
    <BreezeAuthenticatedLayout>
        <div class="flex justify-center bg-white items-center max-w-lg mx-auto font-serif">
            <div class="w-full justify-center">
                <MasterHeader/>
                <div class="text-black border-4 border-b-4 border-[#20351d] my-10 p-5 border-opacity-75 mb-28 space-y-4 bg-white text-lg">
                    <div class="flex justify-between py-2 px-6">
                        <div class="flex flex-col">
                            <h3 class="font-semibold mb-2">Project Leadership</h3>
                            <h3 class="text-[15px] ml-8">Leaders Application</h3>
                            <h3 class="text-[15px] ml-8">Assistant Application</h3>
                        </div>
                        <div class="flex justify-end my-6 mr-4">
                            <Link :href="route('projectshome')" class="text-[25px] flex items-center bg-[#639f1e] p-1 text-center font-bold bg-opacity-75">
                                <i class="fas fa-home"></i>
                            </Link>
                        </div>
                    </div>
                    <div class="space-y-2 font-sans mx-auto w-3/4">
                        <div v-for="info in answer" class="flex justify-between items-center pr-6 py-1.5 bg-[#639f1e] bg-opacity-75 text-black text-xs leading-tight rounded shadow-md font-bold transition duration-150 ease-in-out flex items-center whitespace-nowrap">
                            <span @click="applicationRole(info.id)" class="px-6 py-2 text-[16px] font-bold">{{ info.name }}</span>
                            <span class="flex">
                                <i class="fas border-2 border-black flex justify-center items-center fa-plus fa-2x w-8 ml-3 h-8 bg-white rounded-full text-black py-1"></i>
                                <i class="fas fa-star fa-2x w-8 ml-3 flex justify-center items-center h-8 bg-white rounded-full text-black py-1"></i>
                            </span>
                        </div>
                        <div v-show="answer.length === 0" class="bg-white py-4 border-t-2 border-opacity-75 font-bold flex items-center justify-center border-[#639f1e] text-center">Empty!</div>
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
                                    <BreezeInput disabled v-model="appAnswer.text1" />
                                </div>
                                <div class="px-2 mt-3">
                                    <BreezeLabel value="Why do you want this role?"/>
                                    <BreezeInput disabled v-model="appAnswer.text2" />
                                </div>
                                <div class="px-2 mt-3">
                                    <BreezeLabel value="What experience do you have?"/>
                                    <BreezeInput disabled v-model="appAnswer.text3" />
                                </div>
                                <div class="px-2 mt-3">
                                    <BreezeLabel value="Reference 1 Answers"/>
                                    <BreezeInput disabled v-model="appAnswer.ref1_email" />
                                </div>
                                <div class="px-2 mt-3">
                                    <BreezeLabel value="Reference 2 Answers"/>
                                    <BreezeInput disabled v-model="appAnswer.ref2_email"/>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                            <button type="button" class="px-6 py-2.5  bg-[#639f1e] bg-opacity-75 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0  active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out" data-bs-dismiss="modal">Close</button>
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

