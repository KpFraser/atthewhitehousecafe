<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import MasterFooter from '@/Components/MasterFooter.vue';
import MasterHeader from '@/Components/MasterHeader.vue';
import BreezeButton from '@/Components/Button.vue';
import useFooterList from "../../../use/useFooterList";
import { Head, Link } from '@inertiajs/inertia-vue3';
import {ref, onMounted, reactive } from "vue";
import commonFunctions from "@/use/common";

const { Toast } = commonFunctions()
const { footerLists } = useFooterList()
const all_names = ref([])
const user_names = ref([])

const projects = () =>{
    axios
        .get('/projects')
        .then((response)=>{
            all_names.value = response.data
            user_names.value = all_names.value.filter(x => x.is_user == 1)
        })
}

const plusBtn = (id) =>{
    axios
        .post('/user-project',{id: id})
        .then((response)=>{
            projects ()
            Toast.fire({icon: "success", title: "Add to User!"})
        })
}

const archieveBtn = (id) =>{
    axios
        .post('/archieve-project',{id: id})
        .then((response)=>{
            console.log(response)
            Toast.fire({icon: "success", title: "Add to Archieved!"})

        })
}

onMounted( ()=> {
    projects ()
})
</script>

<template>
    <!-- <Head title="Dashboard" /> -->
    <BreezeAuthenticatedLayout>
        <div class="flex justify-center bg-white items-center max-w-lg mx-auto font-serif">
            <div class="w-full">
                <MasterHeader/>
                  <div class="text-black border-4 border-b-4 border-[#20351d] mx-10 border-opacity-75 mt-10 mb-28 space-y-4 bg-white text-lg">
                        <ul class="nav w-full nav-tabs flex" id="tabs-tab" role="tablist">
                            <li class="nav-item w-1/2" role="presentation">
                                <a href="#tabs-home" class="text-center border-opacity-75 border-[#20351d] bg-opacity-75 focus:bg-opacity-75 focus:text-white block font-bold text-xs focus:bg-[#20351d] text-[#20351d] uppercase border-b-2 border-r-2 border-transparent px-6 py-3 hover:border-transparent hover:bg-gray-100 active " id="tabs-home-tab" data-bs-toggle="pill" data-bs-target="#tabs-home" role="tab" aria-controls="tabs-home"
                                   aria-selected="true">All</a>
                            </li>
                            <li class="nav-item w-1/2" role="presentation">
                                <a href="#tabs-profile" class="text-center border-opacity-75 border-[#20351d] bg-opacity-75 focus:bg-opacity-75 focus:text-white block font-bold text-xs  focus:bg-[#20351d] text-[#20351d] uppercase border-b-2 border-transparent px-6 py-3 hover:border-transparent hover:bg-gray-100 " id="tabs-profile-tab" data-bs-toggle="pill" data-bs-target="#tabs-profile" role="tab"
                                   aria-controls="tabs-profile" aria-selected="false">User</a>
                            </li>
                        </ul>
                        <div class="tab-content bg-white items-center max-w-lg mx-auto" id="tabs-tabContent">
                            <div class="tab-pane fade show active" id="tabs-home" role="tabpanel" aria-labelledby="tabs-home-tab">
                                <div class="flex p-1 my-1 mx-2 justify-between bg-[#639f1e] items-center" v-for="all in all_names">
                                    <div class="ml-5 text-white" >{{all.name}}</div>
                                    <div >
                                        <i class="fas cursor-pointer text-[30px] mr-2 fa-plus-circle" @click="plusBtn(all.id)"></i>
                                        <i class="fas cursor-pointer text-[30px] fa-save" @click="archieveBtn(all.id)"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tabs-profile" role="tabpanel" aria-labelledby="tabs-profile-tab">
                                <div class="flex p-1 my-1 mx-2 justify-between bg-[#639f1e] items-center" v-for="user in user_names">
                                    <div class="ml-5 text-white" >{{user.name}}</div>
                                    <div >
<!--                                        <i class="fas cursor-pointer text-[30px] mr-2 fa-plus-circle" @click="plusBtn(name.id)"></i>-->
<!--                                        <i class="fas cursor-pointer text-[30px] fa-save" @click="archieveBtn(name.id)"></i>-->
                                    </div>
                                </div>
                            </div>
                            <div v-if="all_names.length === 0" class="bg-white text-center">Projects Empty !</div>
                        </div>
                    </div>
            </div>
            <MasterFooter
                :footerLists="footerLists"
            />
        </div>
    </BreezeAuthenticatedLayout>
</template>
