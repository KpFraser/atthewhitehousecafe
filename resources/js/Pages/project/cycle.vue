<script setup>
import BreezeLabel from '@/Components/Label.vue';
import MasterFooter from '@/Components/MasterFooter.vue';
import MasterHeader from '@/Components/MasterHeader.vue';
import BreezeButton from '@/Components/Button.vue';
import ImageLogo from '@/Components/CameraLogo.vue';
import BreezeCheckbox from '@/Components/Checkbox.vue';
import useFooterList from "../../../use/useFooterList";
import {Link, usePage} from '@inertiajs/inertia-vue3';
import {onMounted, ref} from "vue";
import commonFunctions from "@/use/common";
import ModalDialog from '@/Components/ModalDialog.vue';
import {Inertia} from "@inertiajs/inertia";
// import { usePage } from '@inertiajs/vue3';

const { Toast, ConfirmToast } = commonFunctions(),
    { footerLists } = useFooterList()

const baseUrl = window.location.origin,
    users = ref({}),
    errors = ref({}),
    urlGroup =  ref([]),
    user = ref({}),
    userImageUrl = ref(),
    imagesPreview = ref([]),
    userComment = ref({id:'', comment:'', user_id:'', cycle_comment_id:'', image:'', previous_image:''}),
    checkUsers = ref({module:1, id: '', date:'', start_time:'', end_time:'', images:[], previous_img:[], user_comments:[], groupComment:'', morning:{}, noon:{}, afternoon:{}}),
    approve = ref(false)

const validationError = (post) =>{

    errors.value = {}
    if(!post.groupComment)
        errors.value.groupComment = '*Comment is required!'
    if(!post.date || !post.end_time || !post.start_time)
        errors.value.date = '*Date and time required'

    return Object.values(errors.value).length === 0;
}

const groupComments = (post) =>{

    approve.value = true
    let valid = validationError (post)
    if (valid) {
        const formData = new FormData();
        for (let item in post) {
            if(post.hasOwnProperty(item)) {
                if (item === "images"){
                    let index=1
                    _.forEach(post[item], function (value, key){
                        const length = key+1
                        formData.append('image'+length ,  value);
                        index = key
                    })
                    formData.append('length',  JSON.stringify(index+1));
                }
                else
                formData.append(item,  JSON.stringify(post[item]));
            }
        }
        formData.append('image_name',  JSON.stringify(imagesPreview.value));
        axios
            .post('/cycle-info', formData , {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then((response) => {
                if (response.data.success === true){
                    cycleInfo ()
                    Toast.fire({icon: "success", title: "Information Saved"})
                }
            })
            .finally(() =>{
                approve.value = false
            })
    } else
        approve.value = false
}

const groupImages = (e) =>{
    _.forEach(e.target.files, function(value, key) {
        checkUsers.value.images.push(value)
        urlGroup.value.push(URL.createObjectURL(value))
    });
}

const removeImage = (key) =>{
    if(key !== ''){
        urlGroup.value.splice(key, 1)
        checkUsers.value.images.splice(key, 1)
    }
}

const emptyUserComment = () =>{
    userComment.value = {id:'', comment:'', user_id:'', cycle_comment_id:'', image:'', previous_image:''}
}

const userCommentSave = (comment) =>{

    errors.value = {}
    approve.value = true
    const formData = new FormData();
    if(!!comment.comment && !!comment.user_id){
        userComment.value.cycle_comment_id = checkUsers.value.id

        formData.append('cycle_comment_id', userComment.value.cycle_comment_id);
        formData.append('comment', comment.comment);
        formData.append('user_id', comment.user_id);
        formData.append('image', userComment.value.image);
        formData.append('previous_image', userComment.value.previous_image);

        axios
            .post('/user-comment', formData , {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then((response)=>{
                if(response.data.success){
                    $("#addComment").modal('hide')
                    Toast.fire({icon: "success", title: "Comment Saved"})
                    emptyUserComment ()
                    approve.value = false
                    cycleInfo ()
                }
            })
    } else{
        errors.value.userComment = 'Comment required'
        approve.value = false
    }
}

const commentModal = (id) =>{
    userImageUrl.value = ''
    emptyUserComment ()
    if(!!id) {
        userComment.value.user_id = id
        let Comment = checkUsers.value.user_comments.filter(x => x.user_id === id)
        if (Comment.length > 0){
            userComment.value = Comment[0]
            userComment.value.previous_image = Comment[0].image
        } else{
            emptyUserComment ()
            userComment.value.user_id=id
        }

        $("#addComment").modal('show')
    }
}

const cycleInfo = () =>{
    if(!!window.location.href.split('/')[4]){
        axios
            .get('/cycle-info/'+1+'/'+window.location.href.split('/')[4])
            .then((response)=>{
                if(response.data?.data1?.length>0)
                    users.value = response.data?.data1
                if(!!response.data?.data2){
                    checkUsers.value.id = response.data?.data2?.id
                    checkUsers.value.groupComment = response.data?.data2?.comment
                    checkUsers.value.date = response.data?.data2?.date
                    checkUsers.value.start_time = response.data?.data2?.start_time
                    checkUsers.value.end_time = response.data?.data2?.end_time
                    if(response.data?.data2?.cycle_track_image.length> 0) {
                        imagesPreview.value = response.data?.data2?.cycle_track_image
                        checkUsers.value.previous_img = response.data?.data2?.cycle_track_image
                    }
                    if(response.data?.data2?.user_comments?.length> 0)
                        checkUsers.value.user_comments = response.data?.data2?.user_comments
                    filterCheckData(response.data?.data2?.user_attendance)
                }
            })
        }
    }

const filterCheckData = (post) =>{

    _.forEach(post, function (value, key) {
        if(value.time_period === 1)
            checkUsers.value.morning[value.user_id] = value.status === 1;
        else if(value.time_period === 2)
            checkUsers.value.noon[value.user_id] = value.status === 1;
        else if(value.time_period === 3)
            checkUsers.value.afternoon[value.user_id] = value.status === 1;
    });
}

const userImage = (e) =>{
    userComment.value.image = e.target.files[0]
    userImageUrl.value = URL.createObjectURL(e.target.files[0])
}

const deleteParticipant = (id) =>{
    if (!!id){
        ConfirmToast.fire({}).then((confirmed) => {
            if (confirmed.isConfirmed === true) {
                axios
                    .delete('/delete-participant/' + id)
                    .then((response) => {
                        if (response.data.success){
                            Toast.fire({icon: "success", title: "Deleted"})
                            cycleInfo ()
                        }
                    })
                    .catch((err)=>{
                        Toast.fire({icon: "error", title: err.response.data.error})
                    })
            }
        })
    }
}

const registerCycle = () =>{
    Inertia.visit('/roster-register-cycle/'+window.location.href.split('/')[4])
}

const CloseModel = () =>{
    userImageUrl.value = ''
    emptyUserComment ()
}

onMounted( ()=> {
    user.value = usePage().props.value.auth.user
    cycleInfo ()
})

</script>

<template>
    <div class="flex justify-center bg-white items-center max-w-lg mx-auto font-serif">
        <div class="w-full">
            <MasterHeader/>
            <form class="text-black border-4 border-b-4 p-10 border-[#20351d] border-opacity-75 mt-10 mb-28 space-y-4 bg-white text-lg">
                <div class="flex justify-end">
                    <Link :href="route('display-projects')" class="text-[25px] bg-[#639f1e] py-1 px-3 text-center font-bold bg-opacity-75">
                        <i class="text-[40px]  hover:text-red-700 fal fa-times"></i>
                    </Link>
                </div>
                <div v-if="!!errors?.date" class="ml-2 text-red-700 font-bold text-sm">{{ errors.date }}</div>
                <div class="flex space-x-2 justify-between">
                    <div class="bg-opacity-75 w-32 rounded bg-[#639f1e]">
                        <div class="px-4 pt-2 text-[16px] text-center">Date</div>
                        <input class="mx-auto my-2 focus:ring-0 flex cursor-pointer justify-center" type="date" v-model="checkUsers.date">
                    </div>
                    <div class="bg-opacity-75 w-32 rounded bg-[#639f1e]">
                        <div class="px-4 pt-2 text-[16px] text-center">Start Time</div>
                        <input class="mx-auto my-2 focus:ring-0 flex cursor-pointer justify-center" type="time" v-model="checkUsers.start_time">
                    </div>
                    <div class="bg-opacity-75 w-32 rounded bg-[#639f1e]">
                        <div class="px-4 pt-2 text-[16px] text-center">End Time</div>
                        <input class="mx-auto my-2 focus:ring-0 flex cursor-pointer justify-center" type="time" v-model="checkUsers.end_time">
                    </div>
                </div>
                <BreezeLabel value="Attendance"/>
                <div class="bg-[#639f1e] w-full bg-opacity-75 pb-5">
                    <div class="ml-[20%] text-[12px] flex w-[70%] justify-around">
                        <div>Morning</div>
                        <div>Noon</div>
                        <div>Afternoon</div>
                    </div>
                    <div class="p-2 flex items-center" v-for="data in users">
                        <div :title="data?.name" class="w-28 truncate ... items-center">
                            {{ data?.name }}
                        </div>
                        <div class="w-[78%] flex w-full justify-around">
                            <BreezeCheckbox v-model="checkUsers.morning[data.id]" :checked="checkUsers.morning[data.id] === true" class="accent-[#639f1e] mr-2 w-4 h-4 border-[#639f1e] text-[16px] hover:text-[#639f1e]"/>
                            <BreezeCheckbox v-model="checkUsers.noon[data.id]" :checked="checkUsers.noon[data.id] === true" class="accent-[#639f1e] mr-2 w-4 h-4 border-[#639f1e] text-[16px] hover:text-[#639f1e]"/>
                            <BreezeCheckbox v-model="checkUsers.afternoon[data.id]" :checked="checkUsers.afternoon[data.id] === true" class="accent-[#639f1e] mr-2 w-4 h-4 border-[#639f1e] text-[16px] hover:text-[#639f1e]"/>
                        </div>
                        <div class="w-7 flex items-center mx-auto">
                            <i v-if=" data.created_by===user.id" @click="deleteParticipant(data.id)" class="far mr-3 hover:text-red-700 fa-trash cursor-pointer"></i>
                        </div>
                        <i @click="commentModal(data.id)" class="mx-auto w-7 far fa-pen cursor-pointer"></i>
                    </div>
                    <div @click="registerCycle()" class="flex mx-auto items-center mt-4 space-x-2 border border-white p-0.5 cursor-pointer w-36 justify-center text-[12px]">
                        <div>Add a Participant</div>
                        <i class="fa fa-plus"></i>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center justify-between w-full">
                        <div>
                            <BreezeLabel value="Group Comment"/>
                            <div v-if="!!errors?.groupComment" class="text-red-700 font-bold text-sm">{{ errors.groupComment }}</div>
                        </div>
                        <div class="flex items-end">
                            <div class="text-center">
                                <div v-if="imagesPreview.length !== 0 || urlGroup.length !== 0" class="mr-2 text-sm text-blue-700  cursor-pointer" data-te-toggle="modal" data-te-target="#preview" data-te-ripple-init>Preview</div>
                            </div>
                            <label for="camera">
                                <ImageLogo class="w-20 h-auto rounded-lg cursor-pointer" />
                            </label>
                        </div>
                        <input @change="groupImages($event)" class="hidden" id="camera" accept="image/*" multiple type="file">
                    </div>
                </div>
                <textarea v-model="checkUsers.groupComment" class="w-full h-28 bg-opacity-75 bg-[#639f1e]"></textarea>
                <BreezeButton @click="groupComments(checkUsers)" type="button" class="bg-opacity-75 px-10 mt-4 bg-[#639f1e] text-white w-full font-sans submit py-3 justify-center text-[25px] font-bold" :class="{ 'opacity-25': approve }" :disabled="approve">
                    Save
                </BreezeButton>
            </form>
        </div>
        <MasterFooter
            :footerLists="footerLists"
        />
        <modal-dialog ModalId='preview' ModalTitle='Group Images' @CloseModel=CloseModel>
            <div class="modal-body h-[500px] overflow-y-auto relative p-4">
                <div v-if="urlGroup.length !== 0" v-for="(img, key) in urlGroup">
                    <div class="flex justify-end">
                        <i @click="removeImage(key)" class="fas fa-times cursor-pointer hover:text-white hover:bg-red-500 text-red-500 border-2 border-red-500 px-2 py-[5px] -mr-3 -mb-4 z-10 bg-white rounded-full"></i>
                    </div>
                    <img alt="image" :src="img" class="p-2">
                </div>
                <div v-else v-for="info in imagesPreview">
                    <img alt="image" :src="'/storage/images/cycle-track/'+info.image" class="p-2">
                </div>
            </div>
        </modal-dialog>
        <modal-dialog ModalId='addComment' ModalTitle=''>
            <div class="pb-4 px-4">
                <div class="flex items-end -mt-8">
                    <label for="userCamera">
                        <ImageLogo class="w-20 h-auto rounded-lg cursor-pointer" />
                    </label>
                    <div class="text-center">
                        <a v-if="!!userImageUrl" :href="userImageUrl" target="_blank" class="ml-2 text-sm text-blue-700 cursor-pointer">Preview</a>
                        <a v-else-if="!!userComment.image" :href="baseUrl+'/storage/images/cycle-track-user/'+userComment.image" target="_blank" class="ml-2 text-sm text-blue-700 cursor-pointer">Preview</a>
                    </div>
                </div>
                <input @change="userImage($event)" class="hidden" id="userCamera" accept="image/*" type="file">
                <div class="flex items-center">
                    <h5 class="text-xl font-medium leading-normal text-gray-800">Comment:</h5>
                    <div v-if="!!errors?.userComment" class="ml-2 text-red-700 font-bold text-sm" >{{ errors.userComment }}</div>
                </div>
                <textarea v-model="userComment.comment" class="w-full h-28 bg-opacity-75 bg-[#639f1e]" placeholder="Add a comment here.."></textarea>
                <div class="flex justify-end">
                    <BreezeButton @click="userCommentSave(userComment)" type="button" class="bg-opacity-75 flex justify-end text-right bg-[#639f1e] text-white font-sans py-2 justify-center font-bold" :class="{ 'opacity-25': approve }" :disabled="approve">Save</BreezeButton>
                </div>
            </div>
        </modal-dialog>
    </div>
</template>
<style scoped>
[type='time'], [type='date'] {
    color: white;
    background-color: transparent;
    border-width: 0;
    border-radius: 0;
    padding: 0 !important;
    font-size: 0.75rem;
    text-align: center;
}
</style>
