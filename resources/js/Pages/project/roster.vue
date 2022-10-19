<script setup>
    import BreezeLabel from '@/Components/Label.vue';
    import MasterFooter from '@/Components/MasterFooter.vue';
    import MasterHeader from '@/Components/MasterHeader.vue';
    import BreezeButton from '@/Components/Button.vue';
    import ImageLogo from '@/Components/CameraLogo.vue';
    import useFooterList from "../../../use/useFooterList";
    import {Link} from '@inertiajs/inertia-vue3';
    import {onMounted, ref} from "vue";
    import commonFunctions from "@/use/common";
    import {Inertia} from "@inertiajs/inertia";


    const { Toast } = commonFunctions(),
        { footerLists } = useFooterList()

    const info = ref({}),
        baseUrl = window.location.origin,
        roster = ref({}),
        users = ref([]),
        groupImages = ref([]),
        groupComment = ref({}),
        errors = ref({})

    const eventInfo = () => {
        const queryString = window.location.href
        let event_id = queryString.split('/')[4]
        let project_id = queryString.split('/')[5]
        groupComment.value.event_id = event_id

        axios
            .get('/event-info/'+event_id+'/'+project_id)
            .then((response)=>{
                info.value.date =  response.data[0]
                info.value.start_time = response.data[1]
                info.value.end_time = response.data[2]
                users.value = response.data[3]
                groupComment.value.comment = response.data[4].group_comment;
            })
    }

    const modalValidation = (post) =>{
        console.log(post)
        errors.value = {}
        if(!post.comment)
            errors.value.rosterComment = ['* Required field!']

        return Object.values(errors.value).length === 0;
    }

    const rosterComment = (post) =>{
        console.log(post)
        let validComment = modalValidation (post)
        if (validComment === true) {
            if (groupComment.value.roster_comment) return
            groupComment.value.roster_comment = true
            axios
                .post('/roster-comment', roster.value,{
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then((response) => {
                    if (response.data.success === true) {
                        Toast.fire({icon: "success", title: "Comment Submitted!"})
                        $(".modal").modal('hide')
                        roster.value.image = ''
                        eventInfo()
                    }

                })
                .finally(() => {
                    groupComment.value.roster_comment = false

                })

        }
        groupComment.value.modal = false
    }

    const checkedProject = (one, two, three) =>{
        axios
            .post('/is-roster', { id: one, project_id: two, check: three})
            .then(( )=>{

            })
    }

    const validationError = (post) =>{

        errors.value = {}
        if(!post.comment)
            errors.value.comment = ['*Group comment is required field!']
        // if(groupImages.value.length === 0)
        //     errors.value.pic = ['*Group Image is required field!']
        if(!info.value.date || !info.value.start_time || !info.value.end_time)
            errors.value.dateAndTime = ['*Date and time is required!']

        return Object.values(errors.value).length === 0;
    }

    const groupComments = (post) =>{

        let valid = validationError (post)
        const formData = new FormData();

        if (valid === true) {
            if (groupComment.value.approve) return
            groupComment.value.approve = true
            //
            // groupImages.value.forEach((element, index, array) => {
            //     formData.append('photo-' + index, element)
            // });
            // formData.append('comment',post.comment)
            // formData.append('info',info.value)
            axios
                .post('/group-comment', {comment:post, datetime: info.value})
                .then((response) => {
                    if (response.data.success === true)
                        Toast.fire({icon: "success", title: "Comment Submitted!"})
                })
                .finally(() => groupComment.value.approve = false)
        } else
            groupComment.value.approve = false
    }

    const rosterRegister = () =>{
        const queryString = window.location.href
        let event_id = queryString.split('/')[4]
        let project_id = queryString.split('/')[5]
        Inertia.visit('/roster-register/'+event_id+'/'+project_id)
    }

    const commentModal = (user_id, project_id) =>{
        roster.value.id = user_id
        roster.value.project_id = project_id
        let obj = users.value.find(x => x.identity === user_id)
        roster.value.comment = obj.comment
        roster.value.image_name = obj.image
        roster.value.system_name = obj.image
    }

    const groupImg = (e) =>{
        _.forEach(e.target.files, function(value, key) {
            groupImages.value.push(value)
        });
    }

    const rosterImage = (e) =>{
        roster.value.image = e.target.files[0]
        roster.value.image_name = roster.value.image.name
    }

    onMounted( ()=> {
        eventInfo ()
    })

</script>

<template>
    <div class="flex justify-center bg-white items-center max-w-lg mx-auto font-serif">
        <div class="w-full">
            <MasterHeader/>
            <form class="text-black border-4 border-b-4 p-10 border-[#20351d] border-opacity-75 mt-10 mb-28 space-y-4 bg-white text-lg">
                <div class="flex justify-end">
                    <Link :href="route('projectshome')" class="text-[25px] bg-[#639f1e] p-1 text-center font-bold bg-opacity-75">
                        <i class="fas fa-home"></i>
                    </Link>
                </div>
                <div v-if="errors.length !== 0" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  errors.dateAndTime">{{ message }}</div>
                <div class="flex space-x-2 justify-between">
                    <div class="bg-opacity-75 w-32 rounded bg-[#639f1e]">
                        <div class="px-4 pt-2 text-[16px] text-center">Date</div>
<!--                        <div class="text-[12px] text-white text-center font-sans">{{info.date}}</div>-->
                        <input class="mx-auto my-2 focus:ring-0 flex cursor-pointer justify-center" type="date" v-model="info.date">
                    </div>
                    <div class="bg-opacity-75 w-32 rounded bg-[#639f1e]">
                        <div class="px-4 pt-2 text-[16px] text-center">Start Time</div>
<!--                        <div class="text-[12px] text-white text-center font-sans">{{info.start_time}}</div>-->
                        <input class="mx-auto my-2 focus:ring-0 flex cursor-pointer justify-center" type="time" v-model="info.start_time">
                    </div>
                    <div class="bg-opacity-75 w-32 rounded bg-[#639f1e]">
                        <div class="px-4 pt-2 text-[16px] text-center">End Time</div>
<!--                        <div class="text-[12px] text-white text-center font-sans">{{info.end_time}}</div>-->
                        <input class="mx-auto my-2 focus:ring-0 flex cursor-pointer justify-center" type="time" v-model="info.end_time">
                    </div>
                </div>
                <BreezeLabel value="Roster"/>
                <div class="bg-[#639f1e] w-full py-5 bg-opacity-75">
                    <div class="flex items-center justify-between mx-5" v-for="user in users">
                        <input @change="checkedProject(user.identity, user.project, $event.target.checked)" :checked ="user.roster === 1 " :value="user.identity" type="checkbox" class="text-[#639f1e] bg-[#cccccc] focus:ring-[#639f1e] transition ease-in-out">
                        <div class="text-center">{{user.name}}</div>
                        <i @click="commentModal(user.identity, user.project)" class="far fa-pen cursor-pointer" data-bs-toggle="modal" data-bs-target="#addComment"></i>
                    </div>
                    <div @click="rosterRegister()" class="flex mx-auto items-center mt-4 space-x-2 border border-white p-0.5 cursor-pointer w-36 justify-center text-[12px]">
                        <div>Add a Participant</div>
                        <i class="fa fa-plus"></i>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center justify-between w-full">
                        <div>
                            <BreezeLabel value="Group Comment"/>
                            <div v-if="!groupComment.comment" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  errors.comment">{{ message }}</div>
<!--                            <div v-if="errors.length !== 0" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  errors.pic">{{ message }}</div>-->
                        </div>
                        <div>
                            <label for="camera">
                                <ImageLogo class="w-20 h-auto rounded-lg cursor-pointer" />
                            </label>
                        </div>
                        <input class="hidden" @change="groupImg($event)" id="camera" multiple type="file">
                    </div>
                </div>
                <textarea v-model="groupComment.comment" class="w-full h-28 bg-opacity-75 bg-[#639f1e]"></textarea>
                <BreezeButton @click="groupComments(groupComment)" type="button" class="bg-opacity-75 px-10 mt-4 bg-[#639f1e] text-white w-full font-sans submit py-3 justify-center text-[25px] font-bold" :class="{ 'opacity-25': groupComment.approve }" :disabled="groupComment.approve">
                    Save
                </BreezeButton>
            </form>
        </div>
        <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="addComment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addCommentLabel" aria-hidden="true">
            <div class="modal-dialog relative w-auto pointer-events-none">
                <div class="modal-content border-none shadow-lg relative mx-auto flex justify-center flex-col w-auto pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                    <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                        <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLabel">Comment</h5>
                        <div v-if="!roster.comment" class="ml-2 text-red-700 font-bold text-sm" v-for="message in errors.rosterComment">{{ message }}</div>
                        <button type="button" class="btn-close box-content flex items-center hover:bg-[#7eca21] h-3 text-center font-extrabold bg-[#639f1e] uppercase font-sans text-white" data-bs-dismiss="modal" aria-label="Close">x</button>
                    </div>
                    <div class="modal-body relative p-4">
                        <textarea v-model="roster.comment" class="w-full h-28 bg-opacity-75 bg-[#639f1e]" placeholder="Add a comment here.."></textarea>
                    </div>
                    <div class="p-4 border-t border-gray-200 rounded-b-md">
                        <div class="p-2 text-sm">{{ roster.image_name }}</div>
                        <div class="flex items-center justify-between">
                            <div>
                                <label for="rosterImg" class="flex items-center">
                                    <ImageLogo class="w-20 h-auto rounded-lg cursor-pointer" />
                                    <a v-show="roster.image_name !== null" target="_blank" :href="baseUrl+'/storage/images/roster/'+roster.image_name" class="ml-2 px-4 py-1 text-white bg-blue-600 hover:bg-blue-700 rounded">Preview</a>
                                </label>
                                <input @change="rosterImage($event)" type="file" id="rosterImg" class="hidden">
                            </div>
                            <button @click="rosterComment(roster)" type="button" class="inline-block px-6 py-2.5 bg-[#639f1e] text-white text-sm rounded hover:bg-[#89d335]" :class="{ 'opacity-25': groupComment.roster_comment }" :disabled="groupComment.roster_comment">Submit</button>
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
<style>
[type='time'], [type='date'] {
     color: white;
     background-color: transparent;
     border-width: 0px;
     border-radius: 0px;
     padding: 0px !important;
     font-size: 0.75rem;
    text-align: center;
}
</style>

