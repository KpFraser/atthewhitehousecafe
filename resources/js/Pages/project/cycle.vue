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
import BreezeInput from '@/Components/Input.vue';
import Datepicker from '@vuepic/vue-datepicker';

const { Toast } = commonFunctions(),
    { footerLists } = useFooterList()

const
    baseUrl = window.location.origin,
    roster = ref({image:[], previous_img:[]}),
    users = ref([]),
    errors = ref({}),
    urlRoster =  ref([]),
    urlGroup =  ref([]),
    imagesPreview = ref([]),
    allInformation = ref ({groupComment:{event_slug:'', approve:false, comment:'', roster_comment:false}, dateTime:{date:'', start_time:'', end_time:''}, images:[]})



const modalValidation = (post) =>{
    errors.value = {}
    if(!post.comment)
        errors.value.rosterComment = ['* Required field!']
    if(!post.userName)
        errors.value.userName = ['* Required field!']

    return Object.values(errors.value).length === 0;
}

const rosterComment = (post) =>{
    console.log(post)
    // return
    let validComment = modalValidation (post)
    if (validComment) {

        if (allInformation.value.groupComment.roster_comment) return
        allInformation.value.groupComment.roster_comment = true

        const formData = new FormData();
        for (let item in post) {
            if(post.hasOwnProperty(item)) {
                if(item === "id" || item === "project_id" || item === "userName" || item === "comment" || item === "previous_img") {
                    formData.append(item,  JSON.stringify(post[item]));
                } else if (item === "image"){
                    let index=1
                    _.forEach(post[item], function (value, key){
                        const length = key+1
                        formData.append('image'+length ,  value);
                        index = key
                    })
                    formData.append('length',  JSON.stringify(index+1));
                }
            }
        }

        axios
            .post('/roster-comment', formData,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then((response) => {
                if (response.data.success === true) {
                    Toast.fire({icon: "success", title: "Comment Submitted!"})
                    $(".modal").modal('hide')
                    roster.value.image = []
                    eventInfo()
                }

            })
            .finally(() => {
                allInformation.value.groupComment.roster_comment = false

            })

    }
    allInformation.value.groupComment.modal = false
}


const groupComments = (post) =>{
                    Toast.fire({icon: "success", title: "Comment Submitted!"})

    // let valid = validationError (post)
    //
    // if (valid) {
    //     if (allInformation.value.groupComment.approve) return
    //     const formData = new FormData();
    //     for (let item in post) {
    //         if(post.hasOwnProperty(item)) {
    //             if(item === "dateTime" || item === "groupComment") {
    //                 formData.append(item,  JSON.stringify(post[item]));
    //             } else if (item === "images"){
    //                 let index=1
    //                 _.forEach(post[item], function (value, key){
    //                     const length = key+1
    //                     formData.append('image'+length ,  value);
    //                     index = key
    //                 })
    //                 formData.append('length',  JSON.stringify(index+1));
    //             }
    //         }
    //     }
    //     formData.append('image_name',  JSON.stringify(imagesPreview.value));
    //     axios
    //         .post('/group-comment', formData , {
    //             headers: {
    //                 'Content-Type': 'multipart/form-data'
    //             }
    //         })
    //         .then((response) => {
    //             if (response.data.success === true){
    //                 allInformation.value.images=[]
    //                 eventInfo ()
    //                 Toast.fire({icon: "success", title: "Comment Submitted!"})
    //             }
    //         })
    //         .finally(() => allInformation.value.groupComment.approve = false)
    // } else
    //     allInformation.value.groupComment.approve = false
}

const groupImg = (e) =>{
    _.forEach(e.target.files, function(value, key) {
        allInformation.value.images.push(value)
        urlGroup.value.push(URL.createObjectURL(value))
    });
}

// const removeImage = (key) =>{
//     if(key !== ''){
//         urlGroup.value.splice(key, 1)
//         allInformation.value.images.splice(key, 1)
//     }
// }
//
// const rosterRegister = () =>{
//     const queryString = window.location.href
//     let event_slug = queryString.split('/')[4]
//     let project_id = queryString.split('/')[5]
//     Inertia.visit('/roster-register/'+event_slug+'/'+project_id)
// }
//
// const commentModal = (user_id, project_id) =>{
//     urlRoster.value = []
//     errors.value = {}
//     roster.value.id = user_id
//     roster.value.project_id = project_id
//     let obj = users.value.find(x => x.identity === user_id)
//     roster.value.comment = obj.comment
//     roster.value.userName = obj.name
//     // roster.value.image_name = obj.image
//     // roster.value.system_name = obj.image
//     roster.value.image = []
//     if (user_id !== '') {
//         let img = users.value.filter(x => x.identity === user_id)
//         roster.value.image = img[0].images
//         roster.value.previous_img = img[0].images
//         // if (roster.value.image.length !== 0)
//         //     $("#userImagePeview").modal('show')
//     }
// }
//
// const rosterImage = (e) =>{
//     urlRoster.value = []
//     _.forEach(e.target.files, function(value, key) {
//         roster.value.image.push(value)
//         urlRoster.value.push(URL.createObjectURL(value))
//     });
// }
//
// const UserImagePreviewModal = (id) =>{
//     // roster.value.image = []
//     // if (id !== '') {
//     //     let img = users.value.filter(x => x.identity === id)
//     //     roster.value.image = img[0].images
//     if (roster.value.image.length !== 0)
//         $("#userImagePeview").modal('show')
//     // }
// }
// const RemoveRosterImage = (key) =>{
//     if(key !== ''){
//         urlRoster.value.splice(key, 1)
//         roster.value.image.splice(key, 1)
//     }
// }
const cycleInfo = () =>{
    axios
        .get('/cycle-info')
        .then((response)=>{
            console.log(response)
        })
}
onMounted( ()=> {
    // cycleInfo ()
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
<!--                <div v-if="errors.length !== 0" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  errors.dateAndTime">{{ message }}</div>-->
                <div class="flex space-x-2 justify-between">
                    <div class="bg-opacity-75 w-full rounded bg-[#639f1e] flex p-4 justify-between items-center">
                        <div class="text-[16px] text-center">Date</div>
                        <Datepicker v-model="allInformation.date" />
                    </div>
                </div>
                <BreezeLabel value="Attendance"/>
                <div class="bg-[#639f1e] w-full bg-opacity-75">
                    <div class="ml-[25%] text-[12px] flex w-[70%] justify-around">
                        <div>Morning</div>
                        <div>Noon</div>
                        <div>Afternoon</div>
                    </div>
                    <div class="p-2 flex items-center" v-for="data in 6">
                        <div class="w-[25%] truncate items-center flex">
<!--                            <input type="checkbox" class="text-[#639f1e] bg-white focus:ring-[#639f1e] rounded mx-1">-->
                            <div>name {{ data }}</div>
                        </div>
                        <div class="w-[70%] flex w-full justify-around">
                            <input type="checkbox" class="text-[#639f1e] bg-white focus:ring-[#639f1e] rounded mx-1">
                            <input type="checkbox" class="text-[#639f1e] bg-white focus:ring-[#639f1e] rounded mx-1">
                            <input type="checkbox" class="text-[#639f1e] bg-white focus:ring-[#639f1e] rounded mx-1">
                        </div>
                        <i class="fal fa-pencil cursor-pointer p-1"></i>

                    </div>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center justify-between w-full">
                        <div>
                            <BreezeLabel value="Group Comment"/>
                            <div v-if="!allInformation.groupComment.comment" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  errors.groupComment">{{ message }}</div>
                            <div v-if="errors.length !== 0" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  errors.groupImage">{{ message }}</div>
                        </div>
                        <div class="flex items-end">
                            <div class="text-center">
                                <div v-if="imagesPreview.length !== 0 || urlGroup.length !== 0" class="mr-2 text-sm text-blue-700  cursor-pointer" data-bs-toggle="modal" data-bs-target="#preview">Preview</div>
                            </div>
                            <label for="camera">
                                <ImageLogo class="w-20 h-auto rounded-lg cursor-pointer" />
                            </label>
                        </div>
                        <input class="hidden" id="camera" accept="image/*" multiple type="file">
                    </div>
                </div>
                <textarea v-model="allInformation.groupComment.comment" class="w-full h-28 bg-opacity-75 bg-[#639f1e]"></textarea>
                <BreezeButton @click="groupComments(allInformation)" type="button" class="bg-opacity-75 px-10 mt-4 bg-[#639f1e] text-white w-full font-sans submit py-3 justify-center text-[25px] font-bold" :class="{ 'opacity-25': allInformation.groupComment.approve }" :disabled="allInformation.groupComment.approve">
                    Save
                </BreezeButton>
            </form>
        </div>

<!--        <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="userImagePeview" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="userImagePeview" aria-hidden="true">-->
<!--            <div class="modal-dialog relative w-auto pointer-events-none">-->
<!--                <div class="modal-content border-none shadow-lg relative mx-auto flex justify-center flex-col w-auto pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">-->
<!--                    <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">-->
<!--                        <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLabel">Images</h5>-->
<!--                        <button type="button" class="btn-close box-content flex items-center hover:bg-[#7eca21] h-3 text-center font-extrabold bg-[#639f1e] uppercase font-sans text-white" data-bs-dismiss="modal" aria-label="Close">x</button>-->
<!--                    </div>-->
<!--                    <div class="modal-body h-[500px] overflow-y-auto relative p-4">-->
<!--                         -->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
        <MasterFooter
            :footerLists="footerLists"
        />
    </div>
</template>

