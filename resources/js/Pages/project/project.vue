<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import MasterFooter from '@/Components/MasterFooter.vue';
import MasterHeader from '@/Components/MasterHeader.vue';
import useFooterList from "../../../use/useFooterList";
import { Head, Link } from '@inertiajs/inertia-vue3';
import {ref, onMounted, reactive } from "vue";
import commonFunctions from "@/use/common";
import {Inertia} from "@inertiajs/inertia";

const { Toast } = commonFunctions()
const { footerLists } = useFooterList()
const favourite = ref([])
const names = ref([])
const event = ref ({})
const eventShow = ref ({})
const eventValue = reactive (-1)

const projects = () =>{
    axios
        .get('/favourite-projects')
        .then((response)=>{
            console.log(response.data[0])
            names.value = response.data
            let info = names.value.filter(x => x.is_key === 1)
            favourite.value = info[0]
        })
}

const eventName = () =>{
    if (!!event.value.name) {
        axios
            .post('event-name', event.value)
            .then((response) => {
                event.value = {}
                Toast.fire({icon: "success", title: "Event Added!"})
                showEvent()
            })
    }
}

const showEvent = () =>{
    axios
        .get('event-name')
        .then((response)=> {
            eventShow.value = response.data
        })
}

const selectedEvent = (id) =>{
    console.log(id)
    Inertia.visit('/roster/'+id)

}

onMounted( ()=> {
    projects ()
    showEvent()
})

</script>

<template>
    <!-- <Head title="Dashboard" /> -->
    <BreezeAuthenticatedLayout>
        <div class="flex justify-center bg-white items-center max-w-lg mx-auto font-serif">
            <div class="w-full justify-center">
                <MasterHeader/>
                <form class="text-black mt-10 mb-28 space-y-4 bg-white text-lg mx-10">
                    <div class="flex justify-end mr-4">
                        <Link :href="route('projectshome')" class="text-[25px] bg-[#639f1e] p-1 text-center font-bold bg-opacity-75">
                            <i class="fas fa-home"></i>
                        </Link>
                    </div>
                    <div class="flex items-center">
                        <BreezeLabel value="Name" />
                    </div>
                    <BreezeInput v-model="favourite.name" disabled/>
                    <div class="flex items-center">
                        <BreezeLabel value="Frequency" />
                    </div>
                    <BreezeInput  v-model="favourite.frequency" disabled/>
                    <div class="flex items-center justify-between">
                        <BreezeLabel value="Events" />
                        <div class="flex items-center space-x-2 border border-[#639f1e] p-0.5 rounded w-28 justify-center text-[12px]" data-bs-toggle="modal" data-bs-target="#eventmodel">
                            <div>Add New</div>
                            <i class="fa fa-plus"></i>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <select @change="selectedEvent(eventValue)" v-model="eventValue" class="w-full bg-opacity-75 hover:bg-opacity-75 focus:ring-[#639f1e] border-none focus:border-[#639f1e] hover:bg-[#639f1e] bg-[#639f1e]">
                            <option value="-1" disabled hidden >Select Event</option>
                            <option v-for="name in eventShow" class="text-[20px]" v-if="!!eventShow" :value="name.id">{{name.name}}</option>
                        </select>
                    </div>
                    <div class="flex items-center">
                        <BreezeLabel value="Roles" />
                    </div>
                    <textarea class="focus:ring-[#639f1e] border-none focus:border-[#639f1e] w-full h-28 bg-[#639f1e] bg-opacity-75"></textarea>
                    <div class="flex items-center">
                        <BreezeLabel value="Goles" />
                    </div>
                    <textarea class="focus:ring-[#639f1e] border-none focus:border-[#639f1e] w-full h-28 bg-[#639f1e] bg-opacity-75"></textarea>
                </form>
            </div>

            <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="eventmodel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="eventmodelLabel" aria-hidden="true">
                <div class="modal-dialog relative w-auto pointer-events-none">
                    <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                        <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                            <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLabel"> Add Event </h5>
                            <button type="button" class="btn-close box-content flex items-center hover:bg-[#7eca21] h-3 text-center font-extrabold bg-[#639f1e] uppercase font-sans text-white" data-bs-dismiss="modal" aria-label="Close">x</button>
                        </div>
                        <div class="modal-body relative p-4">
                            <BreezeInput v-model="event.name" placeholder="Write Event Name.."/>
                        </div>
                        <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                            <button @click="eventName" type="button" class="inline-block px-6 py-2.5 bg-[#639f1e] text-white text-sm rounded hover:bg-[#89d335]" data-bs-dismiss="modal">Submit</button>
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
