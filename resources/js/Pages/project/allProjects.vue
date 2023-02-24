<script setup>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import MasterFooter from '@/Components/MasterFooter.vue';
    import MasterHeader from '@/Components/MasterHeader.vue';
    import useFooterList from "../../../use/useFooterList";
    import BreezeInput from '@/Components/Input.vue';
    import {ref, onMounted } from "vue";
    import ModalDialog from '@/Components/ModalDialog.vue';
    import commonFunctions from "@/use/common";
    import {Inertia} from "@inertiajs/inertia";
    import axios from "axios";

const { Toast, ConfirmToast } = commonFunctions(),
    { footerLists } = useFooterList(),
    all_names = ref([]),
    user_names = ref([]),
    event = ref ({}),
    errors = ref ({}),
    names = ref([]),
    isActive = ref(1),
    archieved = ref([]),
    project = ref({}),
    events = ref([])

const projects = () =>{
    axios
        .get('/projects')
        .then((response)=>{
            names.value = response?.data?.data
            if(!!response?.data?.data1){
                user_names.value = response?.data?.data1
                    .filter(x => x.is_user === 1 && x.project_names?.is_archived !== 1)
            }

            all_names.value = names?.value
                .filter(x => x.is_approved === 1 && x.is_archived !== 1)

            if(user_names.value.length===0)
                isActive.value = 3
            archieved.value = names.value
                .filter(x => x.is_archived === 1)
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

// const keyBtn = (id, key) =>{
//     if(key === '')
//         key = 1
//     else
//         key = 0
//     axios
//         .post('/favourite-project',{id: id, key:key})
//         .then((response)=>{
//             if (response.data.success){
//                 if(response.data?.data === 1)
//                     Toast.fire({icon: "success", title: "Added to Key Project!"})
//                 else
//                     Toast.fire({icon: "success", title: "Removed from Key Project!"})
//                 projects  ()
//             }
//         })
// }

// const allPencilBtn = (slug) =>{
//     if (slug !== 'bike-repair')
//     Inertia.visit('/proposed/'+slug)
// }

const bikeProject = (slug) =>{
    if(slug === 'bike-repair' || slug === 'bike-mechanic')
        Inertia.visit('/bike-all-projects/'+slug)
    // else if(slug === 'cycle-track')
    //     Inertia.visit('/cycle')
    // else if(slug === 'the-cafe')
    //     Inertia.visit('/cafe')
    else
        Inertia.visit('/favourite-project/'+slug)
}

const showEvents = (id, slug) =>{
    console.log(id, slug)
    // if(slug === 'bike-repair' || slug === 'bike-mechanic' || slug === 'cycle-track' || slug === 'the-cafe')
    if(slug === 'bike-repair' || slug === 'bike-mechanic')
        bikeProject (slug)
    else if($('.eventHide').hasClass('!h-[250px]')) {
        $('.btnMinus').removeClass('!rotate-90')
        $('.eventHide').removeClass('!h-[250px]')
    }else{
        getEvents (id)
    }
}

const getEvents = (id) =>{
    errors.value = {}
    events.value = []
    if (!!id){
        axios
            .get('/project-events/'+id)
            .then((response)=>{
                events.value = response.data?.data?.length > 0 ? response.data?.data: {}
            }).finally(()=>{
            $('#event'+id).addClass('!h-[250px]')
            $('#btn'+id).addClass('!rotate-90')
        })
    }
}

const unArchieved = (id) =>{
    axios
        .post('/un-archieve', {id: id})
        .then((response)=>{
            Toast.fire({icon: "success", title: "Moved to Projects!"})
            projects ()
        })
}

const eventName = () =>{
    errors.value = {}
    if (!!event.value.name) {
        axios
            .post('/event-name', {name: event.value.name, slug: project.value.slug})
            .then((response) => {
                if(response.data.success === true) {
                    event.value = {}
                    Toast.fire({icon: "success", title: "Event Added!"})
                    projects()
                    getEvents(project.value.id)
                    $("#eventmodel").modal('hide')
                }
            }).catch((response)=>{
            errors.value.duplicate = response.response.data.message
        })
    }
}

const openEvent =(event, project, module)=>{
    console.log(event, project, module)
    if (module === 0)
    Inertia.visit('/roster/'+event+'/'+project)
    else if(project === 'cycle-track' && module === 1)
        Inertia.visit('/cycle/'+event)
    else if(project === 'the-cafe' && module === 2)
        Inertia.visit('/cafe/'+event)
}

// const userDelBtn = (id) =>{
//     if (!!id){
//         ConfirmToast.fire({}).then((confirmed) => {
//             if (confirmed.isConfirmed === true) {
//                 axios
//                     .delete('/delete-project/' + id)
//                     .then((response) => {
//                         if (response.data.success){
//                             Toast.fire({icon: "success", title: "Removed from Key Project!"})
//                             projects ()
//                         }
//                     })
//             }
//         })
//     }
// }

onMounted( ()=> {
    projects ()
})

</script>

<template>
    <BreezeAuthenticatedLayout>
        <div class="flex justify-center bg-white items-center max-w-lg mx-auto font-serif">
            <div class="w-full">
                <MasterHeader/>
                <div class="max-w-lg text-black border-4 border-b-4 border-[#20351d] m-10 border-opacity-75 mb-28 bg-white text-lg">
                    <ul class="w-full flex">
                        <li class="w-1/3">
                            <a @click="(isActive=1)" :class="{'bg-[#20351d] !text-white': isActive === 1 }" class="text-center border-opacity-75 border-[#20351d] bg-opacity-75 block font-bold text-xs text-[#20351d] uppercase border-b-2 border-r-2 border-transparent px-6 py-3">
                                User
                            </a>
                        </li>
                        <li class="w-1/3">
                            <a @click="(isActive=2)" :class="{'bg-[#20351d] !text-white': isActive === 2 }" class="text-center border-opacity-75 border-[#20351d] bg-opacity-75 block font-bold text-xs text-[#20351d] uppercase border-b-2 border-r-2 border-transparent px-6 py-3">
                                Archieved
                            </a>
                        </li>
                        <li class="w-1/3">
                            <a @click="(isActive=3)" :class="{'bg-[#20351d] !text-white': isActive === 3 }" class="text-center border-opacity-75 border-[#20351d] bg-opacity-75 block font-bold text-xs text-[#20351d] uppercase border-b-2 border-transparent px-6 py-3">
                                <i class="mr-1 fas fa-user"></i>
                                All
                            </a>
                        </li>
                    </ul>
                    <div class="bg-white max-w-lg mx-auto">
                        <div v-if="isActive === 1">
                            <div class="relative flex h-12 p-1 my-1 mx-2 justify-between bg-[#639f1e] items-center" v-for="user in user_names">
                                <div @click="bikeProject(user?.project_names?.slug)" :class="!!user?.project_names?.is_key ? `ml-3 text-white cursor-pointer font-extrabold` : `ml-3 cursor-pointer text-white`" class="truncate w-1/2">{{user.project_names.name}}</div>
                                <div class="flex items-center">
                                    <i class="fas mr-4 cursor-pointer text-[30px] fa-save" @click="archieveBtn(user?.project_names?.id)"></i>
                                    <div @click="showEvents(user?.project_names?.id, user?.project_names?.slug)" :id="'btn'+user?.project_names?.id" class="btnMinus fas cursor-pointer duration-700 text-[30px] fa-minus-circle px-4">
                                    </div>
                                    <div :id="'event'+user?.project_names?.id" class="absolute text-white eventHide max-w-lg z-10 overflow-hidden bg-[#639f1e] h-0 left-0 right-0 top-[3.3rem] text-center text-base opacity-90 duration-700">
                                        <div class="text-left text-black font-bold text-lg pl-2">Events</div>
                                        <div class="h-[180px] overflow-auto">
                                            <div @click="openEvent(data?.slug, user?.project_names?.slug, data?.module)" class="max-w-md text-left p-2 cursor-pointer truncate ..." :title="data?.name" v-if="events.length>0" v-for="(data, key) in events">
<!--                                                {{key+1}}.-->
<!--                                                {{ data?.name }}-->
                                                <pre>{{key+1}}. {{data?.event_date+' ('+data.start_time+'  to  '+data.end_time+')'}}</pre>
                                            </div>
                                            <div v-else>Events not available !</div>
                                        </div>
                                        <button @click="project = user?.project_names" class="px-2 border-2 border-white text-black" data-te-toggle="modal" data-te-target="#eventmodel">Add an Event</button>
                                    </div>
<!--                                    <i class="far fa-trash mr-8 cursor-pointer text-[30px]"  @click="userDelBtn(user.id)"></i>-->
<!--                                    <i class="far fa-pencil mr-8 cursor-pointer text-[30px]"  @click="userPencilBtn(user.slug)"></i>-->
<!--                                    <i :class="!!user.is_key ? `far fa-key-skeleton cursor-pointer font-extrabold text-[32px] rotate-45 pr-5` : `far fa-key-skeleton cursor-pointer text-[30px] mt-2 rotate-45 pr-5`" @click="keyBtn(user.id, user.is_key)"></i>-->
                                </div>
                            </div>
                            <div v-if="user_names.length === 0" class="bg-white p-3 text-center">Empty!</div>
                        </div>
                        <div v-else-if="isActive === 2">
                            <div class="flex h-12 p-1.5 my-1 mx-2 justify-between bg-[#639f1e] items-center" v-for="all in archieved">
                                <div class="ml-3 text-white truncate w-1/2">{{all.name}}</div>
                                <i class="fas -rotate-180 fa-redo-alt cursor-pointer text-[30px]" @click="unArchieved(all.id)"></i>
                            </div>
                            <div v-if="archieved.length === 0" class="bg-white p-3 text-center">Empty!</div>
                        </div>
                        <div  v-else-if="isActive === 3">
                            <div class="flex h-12 p-1.5 my-1 mx-2 justify-between bg-[#639f1e] items-center" v-for="all in all_names">
                                <div :class="{'font-extrabold': all?.is_user === 1 && all?.is_user_by === $page.props.auth?.user?.id}" class="truncate w-1/2 ml-3 text-white">{{ all?.name }}</div>
                                <div>
<!--                                    $page.props.auth.user.id-->
<!--                                    <i class="far fa-pencil mr-4 cursor-pointer text-[30px]" @click="allPencilBtn(all.slug)"></i>-->
                                    <i :class="{'text-gray-600':all.is_user !== 1}" class="fas cursor-pointer text-[30px] mr-4 fa-plus-circle" @click="plusBtn(all.id)"></i>
                                    <i class="fas cursor-pointer text-[30px] fa-save" @click="archieveBtn(all.id)"></i>
                                </div>
                            </div>
                            <div v-if="all_names.length === 0" class="bg-white p-3 text-center">Empty!</div>
                        </div>
                    </div>
                </div>
            </div>
            <modal-dialog ModalId='eventmodel' ModalTitle='Add Event'>
                <div class="pb-4 px-4">
                    <div class="modal-body relative p-4">
                        <BreezeInput v-model="event.name" placeholder="Write Event Name.."/>
                    </div>
                    <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                        <button @click="eventName()" type="button" class="inline-block px-6 py-2.5 bg-[#639f1e] text-white text-sm rounded hover:bg-[#89d335]" >Submit</button>
                    </div>
                </div>
            </modal-dialog>
            <MasterFooter
                :footerLists="footerLists"
            />
        </div>
    </BreezeAuthenticatedLayout>
</template>
