<script setup>
import BreezeLabel from '@/Components/Label.vue';
import MasterFooter from '@/Components/MasterFooter.vue';
import MasterHeader from '@/Components/MasterHeader.vue';
import BreezeButton from '@/Components/Button.vue';
import ImageLogo from '@/Components/CameraLogo.vue';
import BreezeCheckbox from '@/Components/Checkbox.vue';
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
    users = ref({}),
    errors = ref({}),
    urlRoster =  ref([]),
    urlGroup =  ref([]),
    imagesPreview = ref([]),
    checkUsers = ref({date:'', images:[], groupComment:'', morning:{}, noon:{}, afternoon:{}}),
    approve = ref(false),
    allInformation = ref ({groupComment:{event_slug:'', approve:false, comment:'', roster_comment:false}, dateTime:{date:'', start_time:'', end_time:''}, images:[]})

const validationError = (post) =>{
    return true
}

const groupComments = (post) =>{
    console.log(post);
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
            users.value = !!response.data?.data1?.length>0 ? response.data?.data1:[]
            if(!!response.data?.data2 && response.data?.data2.length>0){
                filterCheckData(response.data.data2)
            }
        })
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

onMounted( ()=> {
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
<!--                <div v-if="errors.length !== 0" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  errors.dateAndTime">{{ message }}</div>-->
                <div class="flex space-x-2 justify-between">
                    <div class="bg-opacity-75 w-full rounded bg-[#639f1e] flex p-4 justify-between items-center">
                        <div class="text-[16px] text-center">Date</div>
                        <Datepicker v-model="checkUsers.date" />
                    </div>
                </div>
                <BreezeLabel value="Attendance"/>
                <div class="bg-[#639f1e] w-full bg-opacity-75">
                    <div class="ml-[25%] text-[12px] flex w-[70%] justify-around">
                        <div>Morning</div>
                        <div>Noon</div>
                        <div>Afternoon</div>
                    </div>
                    <div class="p-2 flex items-center" v-for="data in users">
                        <div :title="data?.name" class="w-28 truncate ... items-center">
                            {{ data?.name }}
                        </div>
                        <div class="w-[70%] flex w-full justify-around">
                            <BreezeCheckbox v-model="checkUsers.morning[data.id]" :checked="checkUsers.morning[data.id] === true" class="accent-[#639f1e] mr-2 w-4 h-4 border-[#639f1e] text-[16px] hover:text-[#639f1e]"/>
                            <BreezeCheckbox v-model="checkUsers.noon[data.id]" :checked="checkUsers.noon[data.id] === true" class="accent-[#639f1e] mr-2 w-4 h-4 border-[#639f1e] text-[16px] hover:text-[#639f1e]"/>
                            <BreezeCheckbox v-model="checkUsers.afternoon[data.id]" :checked="checkUsers.afternoon[data.id] === true" class="accent-[#639f1e] mr-2 w-4 h-4 border-[#639f1e] text-[16px] hover:text-[#639f1e]"/>
                        </div>
                        <i class="fal fa-pencil cursor-pointer p-1"></i>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center justify-between w-full">
                        <div>
                            <BreezeLabel value="Group Comment"/>
<!--                            <div v-if="!allInformation.groupComment.comment" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  errors.groupComment">{{ message }}</div>-->
<!--                            <div v-if="errors.length !== 0" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  errors.groupImage">{{ message }}</div>-->
                        </div>
                        <div class="flex items-end">
                            <div class="text-center">
                                <div v-if="imagesPreview.length !== 0 || urlGroup.length !== 0" class="mr-2 text-sm text-blue-700  cursor-pointer" data-bs-toggle="modal" data-bs-target="#preview">Preview</div>
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
        <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="preview" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="previewLabel" aria-hidden="true">
            <div class="modal-dialog relative w-auto pointer-events-none">
                <div class="modal-content border-none shadow-lg relative mx-auto flex justify-center flex-col w-auto pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                    <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                        <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLabel">Group Images</h5>
                        <button type="button" class="btn-close box-content flex items-center hover:bg-[#7eca21] h-3 text-center font-extrabold bg-[#639f1e] uppercase font-sans text-white" data-bs-dismiss="modal" aria-label="Close">x</button>
                    </div>
                    <div class="modal-body h-[500px] overflow-y-auto relative p-4">
                        <div v-if="urlGroup.length !== 0" v-for="(img, key) in urlGroup">
                            <div class="flex justify-end">
                                <i @click="removeImage(key)" class="fas fa-times cursor-pointer hover:text-white hover:bg-red-500 text-red-500 border-2 border-red-500 px-2 py-[5px] -mr-3 -mb-4 z-10 bg-white rounded-full"></i>
                            </div>
                            <img alt="image" :src="img" class="p-2">
                        </div>
                        <div v-else v-for="info in imagesPreview">
                            <img alt="image" :src="'/storage/images/group/'+info.system_name" class="p-2">
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

