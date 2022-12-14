<script setup>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import MasterFooter from '@/Components/MasterFooter.vue';
    import MasterHeader from '@/Components/MasterHeader.vue';
    import useFooterList from "../../../use/useFooterList";
    import {ref, onMounted } from "vue";
    import { Link } from '@inertiajs/inertia-vue3';
    import commonFunctions from "@/use/common";
    import {Inertia} from "@inertiajs/inertia";
    import axios from "axios";

const { Toast, ConfirmToast } = commonFunctions(),
    { footerLists } = useFooterList(),
    all_names = ref([]),
    user_names = ref([]),
    names = ref([]),
    isActive = ref(1)

const projects = () =>{
    axios
        .get('/projects')
        .then((response)=>{
            names.value = response.data.data
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

const keyBtn = (id, key) =>{
    if(key === '')
        key = 1
    else
        key = 0
    axios
        .post('/favourite-project',{id: id, key:key})
        .then((response)=>{
            if (response.data.success){
                if(response.data?.data === 1)
                    Toast.fire({icon: "success", title: "Added to Key Project!"})
                else
                    Toast.fire({icon: "success", title: "Removed from Key Project!"})
                projects  ()
            }
        })
}

const allPencilBtn = (slug) =>{
    if (slug !== 'bike-repair')
    Inertia.visit('/proposed/'+slug)
}

const userPencilBtn = (slug) =>{
    if(slug === 'bike-repair')
        Inertia.visit('/bike-all-projects/'+slug)
    else
    Inertia.visit('/favourite-project/'+slug)
}

const bikeProject = (slug) =>{
    if(slug === 'bike-repair')
        Inertia.visit('/bike-all-projects/'+slug)
    else
        userPencilBtn(slug)
}

const userDelBtn = (id) =>{
    if (!!id){
        ConfirmToast.fire({}).then((confirmed) => {
            if (confirmed.isConfirmed === true) {
                axios
                    .delete('/delete-project/' + id)
                    .then((response) => {
                        if (response.data.success){
                            Toast.fire({icon: "success", title: "Removed from Key Project!"})
                            projects  ()
                        }
                    })
            }
        })
    }
}

onMounted( ()=> {
    projects ()
})

</script>

<template>
    <BreezeAuthenticatedLayout>
        <div class="flex justify-center bg-white items-center max-w-lg mx-auto font-serif">
            <div class="w-full">
                <MasterHeader/>
                <div class="flex justify-end my-6 mr-4">
                    <Link :href="route('projectshome')" class="text-[25px] bg-[#639f1e] p-1 text-center font-bold bg-opacity-75">
                        <i class="fas fa-home"></i>
                    </Link>
                </div>
                  <div class="text-black border-4 border-b-4 border-[#20351d] mx-10 border-opacity-75 mb-28 space-y-4 bg-white text-lg">
                        <ul class="w-full flex">
                            <li class="nav-item w-1/2">
                                <a @click="(isActive=1)" :class="{'bg-[#20351d] !text-white': isActive === 1 }" class="text-center border-opacity-75 border-[#20351d] bg-opacity-75 focus:bg-opacity-75 focus:text-white block font-bold text-xs focus:bg-[#20351d] text-[#20351d] uppercase border-b-2 border-r-2 border-transparent px-6 py-3 active">
                                    User
                                </a>
                            </li>
                            <li class="nav-item w-1/2">
                                <a @click="(isActive=2)" :class="{'bg-[#20351d] !text-white': isActive === 2 }" class="text-center border-opacity-75 border-[#20351d] bg-opacity-75 focus:bg-opacity-75 focus:text-white block font-bold text-xs  focus:bg-[#20351d] text-[#20351d] uppercase border-b-2 border-transparent px-6 py-3">
                                    <i class="mr-1 fas fa-user"></i>
                                    All
                                </a>
                            </li>
                        </ul>
                        <div class="bg-white items-center max-w-lg mx-auto">
                            <div :class="{'hidden': isActive === 2 }">
                                <div class="flex p-1 my-1 mx-2 justify-between bg-[#639f1e] items-center" v-for="user in user_names">
                                    <div @click="bikeProject(user.slug)" :class="!!user.is_key ? `ml-3 text-white cursor-pointer font-extrabold` : `ml-3 cursor-pointer text-white`" class="truncate w-1/2">{{user.name}}</div>
                                    <div class="flex items-center">
                                        <i class="far fa-trash mr-8 cursor-pointer text-[30px]"  @click="userDelBtn(user.id)"></i>
                                        <i class="far fa-pencil mr-8 cursor-pointer text-[30px]"  @click="userPencilBtn(user.slug)"></i>
                                        <i :class="!!user.is_key ? `far fa-key-skeleton cursor-pointer font-extrabold text-[32px] rotate-45 pr-5` : `far fa-key-skeleton cursor-pointer text-[30px] mt-2 rotate-45 pr-5`" @click="keyBtn(user.id, user.is_key)"></i>
                                    </div>
                                </div>
                                <div v-if="user_names.length === 0" class="bg-white pb-3 text-center">Empty!</div>
                            </div>
                            <div :class="{'hidden': isActive === 1 }">
                                <div class="flex p-1 my-1 mx-2 justify-between bg-[#639f1e] items-center" v-for="all in all_names">
                                    <div :class="!!all.is_user ? `ml-3 text-white font-extrabold`: `ml-3 text-white`" class="truncate w-1/2">{{all.name}}</div>
                                    <div>
                                        <i class="far fa-pencil mr-4 cursor-pointer text-[30px]"  @click="allPencilBtn(all.slug)"></i>
                                        <i class="fas cursor-pointer text-[30px] mr-4 fa-plus-circle" @click="plusBtn(all.id)"></i>
                                        <i class="fas cursor-pointer text-[30px] fa-save" @click="archieveBtn(all.id)"></i>
                                    </div>
                                </div>
                                <div v-if="all_names.length === 0" class="bg-white pb-3 text-center">Empty!</div>
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
