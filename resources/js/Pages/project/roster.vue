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
import commonFunctions from "@/use/common";

const { Toast } = commonFunctions(),
    { footerLists } = useFooterList()

const info = ref({}),
    roster = ref({}),
    users = ref([]),
    isRoster = ref({}),
    groupComment = ref({}),
    errors = ref({})

const eventInfo = () => {
    const queryString = window.location.href
    let event_id = queryString.split('/')[4].split('-')[0]
    let project_id = (queryString.split('/')[4].split('-')[1])
    roster.value.project_id = project_id
    groupComment.value.event_id = event_id

    axios
        .get('/event-info/'+event_id+'/'+project_id)
        .then((response)=>{
            info.value.date = response.data[1]+' '+response.data[0]+' '+response.data[2]
            info.value.start_time = response.data[3]
            info.value.end_time = response.data[4]
            users.value = response.data[5]
            console.log(users.value)
        })
}

const rosterComment = () =>{
    if(!!roster.value.comment) {
        axios
            .post('/roster-comment', roster.value)
            .then((response) => {
                if (response.data.success === true)
                    Toast.fire({icon: "success", title: "Comment Submitted!"})
            })
    }
}

const checkedProject = (id) =>{
    isRoster.value.user_id = id
    axios
        .post('/is-roster', isRoster.value)
        .then((response)=>{

        })
}
const validationError = (post) =>{
    errors.value = {}
    if(!post.comment)
        errors.value.comment = ['* Required field!']

    return Object.values(errors.value).length === 0;
}
const groupComments = (post) =>{
    let valid = validationError (post)
    if (valid === true) {
        if (groupComment.value.approve) return
        groupComment.value.approve = true

        axios
            .post('/group-comment', groupComment.value)
            .then((response) => {
                if (response.data.success === true)
                    Toast.fire({icon: "success", title: "Comment Submitted!"})
            })
            .finally(() => groupComment.value.approve = false)
    }else {
        groupComment.value.approve = false
    }
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
                            <input @change="checkedProject(user.identity)" v-model="isRoster.check" type="checkbox" :value="user.identity" class="text-[#639f1e] bg-[#cccccc] focus:ring-[#639f1e] transition ease-in-out">
                            <div class="ml-5">{{user.name}}</div>
                            <i class="far fa-pen cursor-pointer" data-bs-toggle="modal" data-bs-target="#addComment"></i>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <BreezeLabel value="Group Comment"/>
                        <div v-if="!groupComment.comment" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  errors.comment">{{ message }}</div>
                    </div>
                    <textarea v-model="groupComment.comment" class="w-full h-28 bg-opacity-75 bg-[#639f1e]"></textarea>
                    <BreezeButton @click="groupComments(groupComment)" type="button" class="bg-opacity-75 px-10 mt-4 bg-[#639f1e] text-white w-full font-sans submit py-3 justify-center text-[25px] font-bold" :class="{ 'opacity-25': groupComment.approve }" :disabled="groupComment.approve">
                        Save
                    </BreezeButton>
                </form>
            </div>
            <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="addComment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addCommentLabel" aria-hidden="true">
                <div class="modal-dialog relative w-auto pointer-events-none">
                    <div class="modal-content border-none shadow-lg relative mx-auto flex justify-center flex-col w-[300px] pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                        <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                            <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLabel">Comment</h5>
                            <button type="button" class="btn-close box-content flex items-center hover:bg-[#7eca21] h-3 text-center font-extrabold bg-[#639f1e] uppercase font-sans text-white" data-bs-dismiss="modal" aria-label="Close">x</button>
                        </div>
                        <div class="modal-body relative p-4">
                            <textarea v-model="roster.comment" class="w-full h-28 bg-opacity-75 bg-[#639f1e]" placeholder="Add a comment here.."></textarea>
                        </div>
                        <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                            <button @click="rosterComment()" type="button" class="inline-block px-6 py-2.5 bg-[#639f1e] text-white text-sm rounded hover:bg-[#89d335]" data-bs-dismiss="modal">Submit</button>
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
