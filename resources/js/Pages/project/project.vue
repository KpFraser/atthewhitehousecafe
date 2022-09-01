<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import MasterFooter from '@/Components/MasterFooter.vue';
import MasterHeader from '@/Components/MasterHeader.vue';
import useFooterList from "../../../use/useFooterList";
import { Head, Link } from '@inertiajs/inertia-vue3';
import {ref, onMounted, reactive } from "vue";

const { footerLists } = useFooterList()
const favourite = ref([])
const names = ref([])

const projects = () =>{
    axios
        .get('/favourite-projects')
        .then((response)=>{
            names.value = response.data
            let info = names.value.filter(x => x.is_key === 1)
            favourite.value = info[0]
            console.log(favourite.value.name)
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
            <div class="w-full justify-center">
                <MasterHeader/>
                <form class="text-black mt-10 mb-28 space-y-4 bg-white text-lg mx-10">
                    <div class="flex justify-end mr-4">
                        <Link :href="route('all-project')" class="text-[25px] bg-[#639f1e] p-1 text-center font-bold bg-opacity-75">
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
                    <BreezeLabel value="Events" />
                    <div class="flex items-center">
                        <select class="w-full bg-opacity-75 hover:bg-opacity-75 focus:ring-[#639f1e] border-none focus:border-[#639f1e] hover:bg-[#639f1e] bg-[#639f1e]">
                          <option class="" value="">Event</option>
                          <option class="" value="">Event1</option>
                          <option class="" value="">Event2</option>
                          <option class="" value="">Event3</option>
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
            <MasterFooter
                :footerLists="footerLists"
            />
        </div>
    </BreezeAuthenticatedLayout>
</template>
