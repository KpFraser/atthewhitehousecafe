<script setup>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import MasterFooter from '@/Components/MasterFooter.vue';
    import MasterHeader from '@/Components/MasterHeader.vue';
    import { ref , onMounted} from 'vue';
    import axios from 'axios';
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import useFooterList from "../../../use/useFooterList";
    import commonFunctions from "@/use/common";

    const { Toast } = commonFunctions()
    const { footerLists  } = useFooterList()
    const names = ref({}), option = ref(-1), validationErrors = ref({})


    const pencil = (key) => {
        option.value = key
    }

    const plusbtn = () => {

        if(names.value.length == 0){
            names.value.push({id: '', name: ''});
            let last = names.value.length-1;
            option.value = last
        }
        else {
            let last_entry = names.value[names.value.length-1].name;
            if(last_entry != '') {
                names.value.push({id: '', name: ''});
                let last = names.value.length-1;
                option.value = last
            }
        }
    }

    const validation = (name) =>{
        if(!name.name)
            validationErrors.value.name = ['* Required field!']
    }

    const enterNewProject = (name) => {
        console.log(name)
        let validation_detail = validation (name)
        if (!!name.name){
            axios
                .post('/project-names', {name, module:1})
                .then((response)=>{
                    Toast.fire({icon: "success", title: "Updated Successfully!"})
                    option.value = -1
                });
        }
    }

    const projectName = () => {
      axios
        .get('/project-names')
        .then((response)=>{
            names.value = response.data
            // console.log(names.value)
        })
    }

    onMounted( ()=> {
         projectName ()
    })

</script>

<template>
    <BreezeAuthenticatedLayout>
        <div class="flex justify-center bg-white items-center max-w-lg mx-auto font-serif">
            <div class="w-full justify-center">
                <MasterHeader/>
                <div class="border-8 border-[#556553] pb-5 border-opacity-75 mb-28 mt-5 mx-auto">
                    <div class="text-[#639f1e]">
                        <h1 class="text-3xl font-sans text-center bg-opacity-75 p-3">PROPOSED</h1>
                        <div class="text-center">Diet of Activities</div>
                    </div>
                    <div class="min-h-[30vh] overflow-y-auto">
                        <div class="flex ml-5 mt-4" v-for="(name,key) in names">
                            <div class="flex items-center ml-5 mt-5" v-show="key != option">
                                <i class="far fa-pencil text-[16px] hover:text-[#639f1e]" @click="pencil(key)"></i>
                                <Link :href="route('proposed', name.id)" class="ml-5 text-[16px]">
                                    {{name.name}}
                                </Link>
                            </div>
                            <div class="flex ml-5 items-center mt-4" v-show="option == key">
                                <i class="far fa-check text-[20px] hover:text-[#639f1e]" @click="enterNewProject(name)"></i>
                                <input type="text" v-model="name.name" class="ml-4 h-8 rounded">
                                <div v-if="!name.name" class="ml-2 text-red-700 font-bold text-sm" v-for="message in  validationErrors.name">{{ message }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="mx-auto flex mt-5 justify-center">
                        <div class="w-60 cursor-pointer p-4 bg-[#639f1e] justify-between items-center flex" @click="plusbtn()">
                            <div class="text-xl ">Add New Activity</div>
                            <i class="text-xl fas fa-plus-circle"></i>
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
