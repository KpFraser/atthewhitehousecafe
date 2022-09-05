<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import MasterFooter from '@/Components/MasterFooter.vue';
import MasterHeader from '@/Components/MasterHeader.vue';
import useFooterList from "../../../use/useFooterList";
import {ref, onMounted, reactive } from "vue";
import commonFunctions from "@/use/common";

const { Toast } = commonFunctions()
const { footerLists } = useFooterList()
const all_names = ref([])
const user_names = ref([])
const names = ref([])
const classObject = reactive({
    active: true,
    'text-danger': false
})
const projects = () =>{
    axios
        .get('/projects')
        .then((response)=>{
            names.value = response.data
            all_names.value = names.value
                .filter(x => x.is_approved === 1 && x.is_archived !== 1)
            user_names.value = all_names.value
                .filter(x => x.is_user === 1)
        })
}

const plusBtn = (id) =>{
    axios
        .post('/user-project',{id: id})
        .then((response)=>{
            projects ()
            Toast.fire({icon: "success", title: "Added to User!"})
        })
}

const archieveBtn = (id) =>{
    axios
        .post('/archieve-project',{id: id})
        .then((response)=>{
            projects ()
            Toast.fire({icon: "success", title: "Added to Project!"})

        })
}

const keyBtn = (id) =>{
    axios
        .post('/favourite-project',{id: id})
        .then((response)=>{
            Toast.fire({icon: "success", title: "Added to Key Project!"})
            projects  ()
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
                                    <div v-if="all.is_user === 1" class="ml-5 text-white font-extrabold">{{all.name}}</div>
                                    <div v-if="all.is_user !== 1" class="ml-5 text-white">{{all.name}}</div>
                                    <div >
                                        <i class="fas cursor-pointer text-[30px] mr-2 fa-plus-circle" @click="plusBtn(all.id)"></i>
                                        <i class="fas cursor-pointer text-[30px] fa-save" @click="archieveBtn(all.id)"></i>
                                    </div>
                                </div>
                                <div v-if="all_names.length === 0" class="bg-white pb-3 text-center">Empty!</div>
                            </div>
                            <div class="tab-pane fade" id="tabs-profile" role="tabpanel" aria-labelledby="tabs-profile-tab">
                                <div class="flex p-1 my-1 mx-2 justify-between bg-[#639f1e] items-center" v-for="user in user_names">
                                    <div v-if="user.is_key === 1" class="ml-5 text-white font-extrabold">{{user.name}}</div>
                                    <div v-if="user.is_key !== 1" class="ml-5 text-white">{{user.name}}</div>
                                    <i v-if="user.is_key === 1" class="far fa-key-skeleton cursor-pointer font-extrabold text-[32px] mt-2 rotate-45 pr-5" @click="keyBtn(user.id)"></i>
                                    <i v-if="user.is_key !== 1" class="far fa-key-skeleton cursor-pointer text-[30px] mt-2 rotate-45 pr-5" @click="keyBtn(user.id)"></i>
                                </div>
                            <div v-if="user_names.length === 0" class="bg-white pb-3 text-center">Empty!</div>
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
