<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeLabel from '@/Components/Label.vue';
import MasterFooter from '@/Components/MasterFooter.vue';
import MasterHeader from '@/Components/MasterHeader.vue';
import BreezeButton from '@/Components/Button.vue';
import useFooterList from "../../../use/useFooterList";
import { Head, Link } from '@inertiajs/inertia-vue3';
import {ref, onMounted, reactive } from "vue";
import axios from "axios";

const { footerLists } = useFooterList()
const info = ref({})
const users = ref([])

const eventInfo = () => {
    const queryString = window.location.href
    let event_id = queryString.split('/')[4].split('-')[0]
    let project_id = (queryString.split('/')[4].split('-')[1])

    axios
        .get('/event-info/'+event_id+'/'+project_id)
        .then((response)=>{
            info.value.date = response.data[1]+' '+response.data[0]+' '+response.data[2]
            info.value.start_time = response.data[3]
            info.value.end_time = response.data[4]
            users.value = response.data[5]
        })
}

onMounted( ()=> {
    eventInfo ()
})

</script>

<template>
    <!-- <Head title="Dashboard" /> -->
    <BreezeAuthenticatedLayout>
        <div class="flex justify-center bg-white items-center max-w-lg mx-auto font-serif">
            <div class="w-full">
                <MasterHeader/>
                <form class="text-black border-4 border-b-4 p-10 border-[#20351d] border-opacity-75 mt-10 mb-28 space-y-4 bg-white text-lg">
                    <div class="flex justify-end">
                        <Link :href="route('projectshome')" class="text-[25px] bg-[#639f1e] p-1 text-center font-bold bg-opacity-75">
                            <i class="fas fa-home"></i>
                        </Link>
                    </div>
                    <div class="flex space-x-2 justify-between">
                        <div class="bg-opacity-75 w-32 rounded bg-[#639f1e]">
                            <div class="px-4 pt-2 text-[16px] text-center">Date</div>
                            <div class="text-[12px] text-white text-center font-sans">{{info.date}}</div>
                        </div>
                        <div class="bg-opacity-75 w-32 rounded bg-[#639f1e]">
                            <div class="px-4 pt-2 text-[16px] text-center">Start Time</div>
                            <div class="text-[12px] text-white text-center font-sans">{{info.start_time}}</div>
                        </div>
                        <div class="bg-opacity-75 w-32 rounded bg-[#639f1e]">
                            <div class="px-4 pt-2 text-[16px] text-center">End Time</div>
                            <div class="text-[12px] text-white text-center font-sans">{{info.end_time}}</div>
                        </div>
                    </div>
                    <BreezeLabel value="Roster"/>
                    <div class="bg-[#639f1e] py-5 bg-opacity-75">
                        <div class="flex items-center justify-between mx-5" v-for="user in users">
                            <input type="checkbox" name="project" class="text-[#639f1e] bg-[#cccccc] focus:ring-[#639f1e] transition ease-in-out">
                            <div class="ml-5">{{user.name}}</div>
                            <i class="far fa-pen"></i>
                        </div>
                    </div>
                    <BreezeLabel value="Group Comment"/>
                    <textarea class="w-full h-28 bg-opacity-75 bg-[#639f1e]"></textarea>
                    <BreezeButton type="button" class="bg-opacity-75 px-10 mt-4 bg-[#639f1e] text-white w-full font-sans submit py-3 justify-center text-[25px] font-bold">
                        Save
                    </BreezeButton>
                </form>
            </div>
            <MasterFooter
                :footerLists="footerLists"
            />
        </div>
    </BreezeAuthenticatedLayout>
</template>
