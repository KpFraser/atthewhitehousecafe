<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import MasterHeader from '@/Components/MasterHeader.vue';
import MasterFooter from '@/Components/MasterFooter.vue';
import useFooterList from '../../../use/useFooterList';
import axios from "axios";
import {onMounted, ref} from "vue";
import { Link } from '@inertiajs/inertia-vue3';
import {Inertia} from "@inertiajs/inertia";

const names = ref({}),
    { footerLists } = useFooterList()

const projects = () =>{
    axios
        .get('/project-names')
        .then((response)=>{
            names.value = response.data.data

        })
}
const detail = (slug) =>{
    Inertia.visit('/favourite-project/'+slug)

}
onMounted( ()=> {
    projects ()
})
</script>

<template>
    <BreezeAuthenticatedLayout>
        <div class="flex justify-center items-center max-w-lg mx-auto font-serif">
            <div class="w-full mb-28 justify-center">
                <MasterHeader/>
                <div class="text-black mt-4 border-4 border-b-4 border-[#20351d] border-opacity-75 bg-white text-lg">
                    <div class="h-fit flex justify-center mb-10">
                        <div class="w-full font-sans">
                            <div class="cursor-pointer text-[30px] text-gray-800 font-bold px-5 my-4">Projects</div>
                            <div @click="detail(data.slug)" class="cursor-pointer text-[22px] text-gray-600 font-semibold px-5 my-3 truncate ..." v-for="(data, key) in names">{{key+1}}. {{ data.name }}</div>
                            <Link :href="route('proposals')" class="cursor-pointer text-[20px] w-52 mt-5 text-gray-800 border-gray-700 rounded border-2 p-2 flex justify-center mx-auto text-gray-600 font-semibold px-5 my-2">
                                 Add New Project
                            </Link>
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
