<script setup>
    import MasterFooter from '@/Components/MasterFooter.vue';
    import MasterHeader from '@/Components/MasterHeader.vue';
    import useFooterList from "../../../use/useFooterList";
    import {ref, onMounted } from "vue";
    import { Link } from '@inertiajs/inertia-vue3';
    import commonFunctions from "@/use/common";
    import {Inertia} from "@inertiajs/inertia";

const { Toast } = commonFunctions(),
    { footerLists } = useFooterList(),
    names = ref([]),
    isActive = ref(1),
    projects = ref({}),
    baseUrl = window.location.origin


    const newBike = () =>{
    const queryString = window.location.href.split('/')[4]
    Inertia.visit('/bike-project/'+queryString)
}

const project = () =>{
    const queryString = window.location.href.split('/')[4]
    axios
        .get('/bike-projects/'+queryString)
        .then((response)=>{
            projects.value = response.data.data
        })
}

const editBike = (slug) =>{
    const queryString = window.location.href.split('/')[4]
    Inertia.visit('/bike-project/'+queryString+'/'+slug)
}

onMounted(()=>{
    project ()
})

</script>

<template>
    <div class="flex justify-center bg-white items-center max-w-lg mx-auto font-serif">
        <div class="w-full">
            <MasterHeader/>
            <div class="flex justify-between px-10">
                <div class="flex justify-end my-6">
                    <Link :href="route('plan')" class="text-[25px] bg-[#639f1e] py-1 px-3 text-center font-bold bg-opacity-75">
                        <i class="text-[40px] hover:text-red-700 fal fa-times"></i>
                    </Link>
                </div>
                <div class="flex justify-end my-6">
                    <div @click="newBike()" class="text-[25px] bg-[#639f1e] cursor-pointer py-1 px-3 text-center font-bold bg-opacity-75">
                        <i class="text-[40px] fal fa-plus "></i>
                    </div>
                </div>
            </div>
            <div class="text-black border-4 border-b-4 border-[#20351d] mx-10 border-opacity-75 mb-28 bg-white text-lg">
                <ul class="w-full uppercase flex">
                    <li class="nav-item w-1/2">
                        <a @click="(isActive=1)" :class="{'bg-[#20351d] !text-white': isActive === 1 }" class="text-[15px] cursor-pointer text-center border-opacity-75 border-[#20351d] bg-opacity-75 block text-[#20351d] border-b-2 px-6 py-3 active">
                            Active
                        </a>
                    </li>
                    <li class="nav-item w-1/2">
                        <a @click="(isActive=2)" :class="{'bg-[#20351d] !text-white': isActive === 2 }" class="text-[15px] cursor-pointer text-center border-opacity-75 border-[#20351d] bg-opacity-75 block text-[#20351d] border-b-2 px-6 py-3">
                            Archieved
                        </a>
                    </li>
                </ul>
                <div class="bg-white max-w-lg mx-auto">
                    <div class="h-96 overflow-y-auto" :class="{'hidden': isActive === 2 }" >
                        <div v-for="data in projects">
                            <div @click="editBike(data?.slug)" class="flex cursor-pointer p-1 my-1 mx-2 justify-between bg-opacity-75 bg-[#639f1e] items-center">
                                <div class="ml-2">
                                    <p class="font-normal py-1 text-[18px] self-center leading-tight">{{ data?.name }}</p>
                                    <p class="font-normal py-1 text-[18px] self-center leading-tight">{{ data?.mobile }}</p>
                                </div>
                                <img alt="bike image" v-if="!!data?.mobile" class="w-16 h-16" :src="baseUrl+'/storage/images/'+data?.image_name" />
                            </div>
                        </div>
                        <div class="flex justify-center items-center" v-show="projects.length === 0">
                            Data not available !
                        </div>
                    </div>
                    <div class="h-96 overflow-y-auto" :class="{'hidden': isActive === 1 }">
                        <div class="flex justify-center items-center">
                            Data not available !
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <MasterFooter
            :footerLists="footerLists"
        />
    </div>
</template>
