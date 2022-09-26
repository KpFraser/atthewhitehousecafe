<script setup>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import MasterFooter from '@/Components/MasterFooter.vue';
    import MasterHeader from '@/Components/MasterHeader.vue';
    import useFooterList from "../../../use/useFooterList";
    import {ref, onMounted } from "vue";
    import { Link } from '@inertiajs/inertia-vue3';
    import commonFunctions from "@/use/common";
    import {Inertia} from "@inertiajs/inertia";

const { Toast } = commonFunctions(),
    { footerLists } = useFooterList(),
    all_names = ref([]),
    user_names = ref([]),
    names = ref([]),
    isActive = ref(1)
    // classObject = reactive({
    //     active: true,
    //     'text-danger': false
    // })

const projects = () =>{
    axios
        .get('/projects')
        .then((response)=>{
            names.value = response.data.data
            all_names.value = names.value
                .filter(x => x.is_approved === 1 && x.is_archived !== 1)
            console.log(all_names.value)

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

const allPencilBtn = (slug) =>{
    Inertia.visit('/proposed/'+slug)
}

const userPencilBtn = (slug) =>{
    Inertia.visit('/favourite-project/'+slug)
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
                <div class="flex justify-between px-10">
                    <div class="flex justify-end my-6">
                        <Link :href="route('projectshome')" class="text-[25px] bg-[#639f1e] p-1 text-center font-bold bg-opacity-75">
                            <i class="fas fa-home px-1"></i>
                        </Link>
                    </div>
                    <div class="flex justify-end my-6">
                        <Link class="text-[25px] bg-[#639f1e] p-1 text-center font-bold bg-opacity-75">
                            <i class="fas fa-plus px-1.5"></i>
                        </Link>
                    </div>
                </div>
                  <div class="text-black border-4 border-b-4 border-[#20351d] mx-10 border-opacity-75 mb-28 space-y-4 bg-white text-lg">
                        <ul class="w-full uppercase flex">
                            <li class="nav-item w-1/2">
                                <a @click="(isActive=1)" :class="{'bg-[#20351d] !text-white': isActive === 1 }" class="text-[15px] text-center border-opacity-75 border-[#20351d] bg-opacity-75 block text-[#20351d] border-b-2 px-6 py-3 active">
                                    Active
                                </a>
                            </li>
                            <li class="nav-item w-1/2">
                                <a @click="(isActive=2)" :class="{'bg-[#20351d] !text-white': isActive === 2 }" class="text-[15px] text-center border-opacity-75 border-[#20351d] bg-opacity-75 block text-[#20351d] border-b-2 px-6 py-3">
                                    Archieved
                                </a>
                            </li>
                        </ul>
                        <div class="bg-white items-center max-w-lg mx-auto">
                            <div>
                                <div :class="{'hidden': isActive === 2 }" class="flex p-1 my-1 mx-2 justify-between bg-[#639f1e] items-center">
                                    <div class="ml-2">
                                        <p class="font-normal py-1 text-[18px] self-center leading-tight">Name</p>
                                        <p class="font-normal py-1 text-[18px] self-center leading-tight">Phone number</p>
                                    </div>
                                    <i class="fa-3x mr-2 fal fa-bicycle"></i> 
                                </div>
                                <div :class="{'hidden': isActive === 2 }" class="flex p-1 my-1 mx-2 justify-between bg-[#639f1e] items-center">
                                    <div class="ml-2">
                                        <p class="font-normal py-1 text-[18px] self-center leading-tight">Name</p>
                                        <p class="font-normal py-1 text-[18px] self-center leading-tight">Phone number</p>
                                    </div>
                                    <i class="fa-3x mr-2 fal fa-bicycle"></i> 
                                </div>
                                <div :class="{'hidden': isActive === 2 }" class="flex p-1 my-1 mx-2 justify-between bg-[#639f1e] items-center">
                                    <div class="ml-2">
                                        <p class="font-normal py-1 text-[18px] self-center leading-tight">Name</p>
                                        <p class="font-normal py-1 text-[18px] self-center leading-tight">Phone number</p>
                                    </div>
                                    <i class="fa-3x mr-2 fal fa-bicycle"></i> 
                                </div>
                                <div :class="{'hidden': isActive === 2 }" class="flex p-1 my-1 mx-2 justify-between bg-[#639f1e] items-center">
                                    <div class="ml-2">
                                        <p class="font-normal py-1 text-[18px] self-center leading-tight">Name</p>
                                        <p class="font-normal py-1 text-[18px] self-center leading-tight">Phone number</p>
                                    </div>
                                    <i class="fa-3x mr-2 fal fa-bicycle"></i> 
                                </div>
                            </div>
                            <div>
                                <div :class="{'hidden': isActive === 1 }" class="flex p-1 my-1 mx-2 justify-between bg-[#639f1e] items-center">
                                    <div class="ml-2">
                                        <p class="font-bold py-1 text-[18px] self-center leading-tight">Name</p>
                                        <p class="font-bold py-1 text-[18px] self-center leading-tight">Phone number</p>
                                    </div>
                                    <i class="fa-3x mr-2 fal fa-bicycle"></i> 
                                </div>
                                <div :class="{'hidden': isActive === 1 }" class="flex p-1 my-1 mx-2 justify-between bg-[#639f1e] items-center">
                                    <div class="ml-2">
                                        <p class="font-bold py-1 text-[18px] self-center leading-tight">Name</p>
                                        <p class="font-bold py-1 text-[18px] self-center leading-tight">Phone number</p>
                                    </div>
                                    <i class="fa-3x mr-2 fal fa-bicycle"></i> 
                                </div>
                                <div :class="{'hidden': isActive === 1 }" class="flex p-1 my-1 mx-2 justify-between bg-[#639f1e] items-center">
                                    <div class="ml-2">
                                        <p class="font-bold py-1 text-[18px] self-center leading-tight">Name</p>
                                        <p class="font-bold py-1 text-[18px] self-center leading-tight">Phone number</p>
                                    </div>
                                    <i class="fa-3x mr-2 fal fa-bicycle"></i> 
                                </div>
                                <div :class="{'hidden': isActive === 1 }" class="flex p-1 my-1 mx-2 justify-between bg-[#639f1e] items-center">
                                    <div class="ml-2">
                                        <p class="font-bold py-1 text-[18px] self-center leading-tight">Name</p>
                                        <p class="font-bold py-1 text-[18px] self-center leading-tight">Phone number</p>
                                    </div>
                                    <i class="fa-3x mr-2 fal fa-bicycle"></i> 
                                </div>
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
