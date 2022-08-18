<script setup>
    import  commonCode from '../../composables/common';
    import { useInformant } from "../../store/informant";
    import { onMounted } from 'vue';
    import {ref} from "vue";


    const { t, router, ToastConfirm, Toast, bus } = commonCode(),
        storeInformant = useInformant(),
        readCategoryLength = ref('')
        //emit = defineEmits(['informantCategories'])

    async function getInformantCategories(lang = storeInformant.language){
        var arr_temp = []
        var categoryCompleted = 0;

        await axios
            .get('/api/informant-categories/'+lang)
            .then((response)=>{
            let scoreLoop = response.data.data.fndscoreQ
            storeInformant.total  = scoreLoop
            for(var i = 0; i < scoreLoop.length; i++)
            {
                categoryCompleted += parseInt(scoreLoop[i].fndIsCompleteQ)
                arr_temp[i] = ({fndQPstnQ : scoreLoop[i].fndQPstnQ, fndIsCompleteQ : scoreLoop[i].fndIsCompleteQ, fndTQustQ : scoreLoop[i].fndTQustQ, fndTotPontsQ : scoreLoop[i].fndTotPontsQ, fndIsRdQ : scoreLoop[i].fndIsRdQ, fndFilQustQ : scoreLoop[i].fndFilQustQ})
            }
            readCategoryLength.value = categoryCompleted
            shuffleVueArray(response.data.data.fndcategoriesQ,arr_temp, lang)
        })
    }

     function  shuffleVueArray(array, arr_temp, lang = language){
        var array_sorted
        var new_categories = [];
        for (var i = 0; i < array.length; i++) {
            new_categories[i] = ({
                id : array[i].id, InfxSlug : array[i].InfxSlug, Infx_CatName : array[i].Infx_CatName, position : arr_temp[i].fndQPstnQ, categotyIsRdQ : arr_temp[i].fndIsRdQ,
                fndIsCompleteQ : arr_temp[i].fndIsCompleteQ, fndTQustQ : arr_temp[i].fndTQustQ, fndTotPontsQ : arr_temp[i].fndTotPontsQ, fndFilQustQ : arr_temp[i].fndFilQustQ
            });
        }
        function compare(a, b) {

            if (a.position < b.position)
                return -1
            if (a.position > b.position)
                return 1

            return 0
        }

        array_sorted = new_categories.sort(compare)
        storeInformant.categories = array_sorted

        return  storeInformant.categories;
    }

    onMounted(() => {
        getInformantCategories();
    });

    /*
      this function run when language change etc.
    */

    const ToasterAlert = () => Toast.fire({icon: 'error', title:t("please_complete_as_many_of_theOtherQuestions")})

    /*
        general Category disable if user not visit every category
    */

    function linkDisable(slug){
        if(slug === "general-questions") {
            var categoryRead = 0
            var categoryLength = storeInformant.total.length
            for (var i = 0; i < categoryLength; i++) {
                categoryRead += storeInformant.total[i].fndIsRdQ
            }
            let readCategorySecondLength = categoryLength- 1
            if(categoryRead === readCategorySecondLength || categoryRead >= readCategorySecondLength)
                return false
            else
                return true
        }
    }

    /*
      general Category Alert box show if other categories questions not completed
    */

    function confirmDialog(){
        ToastConfirm.fire({
            html : "<p class='font-bold' style='text-align: initial'>"+t('please_answer_all_you_can_from_the_other_sections') +"</p><br><p class='font-bold' style='text-align: initial'>"+t("do_you_want_to_continue_to_the_General_Questions")+"</p>"
        }).then((result) => {
            if (result.isConfirmed) {
                router.push({path:'/informant/general-questions'});
            }
        })
    }

</script>
<template>
    <div class="flex sm:min-h-[72vh] mx-5 sm:mx-auto sm:justify-center items-center pt-6 sm:pt-0">
        <div class="bg-white mt-2">
            <div class="mx-auto justify-center max-w-6xl">
                <div class="py-5 ">
                    <div class="text-[28px]  font-[900]">
                        {{t('main_menu')}}
                    </div>
                    <div class="text-[15px]  pt-2">
                        {{t('to_begin_please_select_any_section_from_the_menu_below')}}<br><br>
                        {{t('there_are_eight_sections_each_containing_between_16_and_19_questions')}}<br><br>
                        {{t('you_can_go_back_to_a_section_to_change_or_add_responses_at_any_time')}}<br><br>
                        {{t('if_you_have_marked_a')}}
                    </div>
                </div>
                <div class="max-w-6xl my-10 mx-auto">
                    <div class="grid gap-5 x-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
                        <div class=" h-24" v-for="(category) in storeInformant.categories">
                            <div v-if="linkDisable(category.InfxSlug)"  class="bg-white border-2 rounded border-[#005F4B] text-[#005F4B]">
                                <div  v-bind:class="'flex align-center justify-center text-[20px]'" role="button" title="Please answer the other sections before completing the General Questions!" @click="ToasterAlert()">
                                    <h4 @click="ToasterAlert()" class="p-6">{{category.Infx_CatName}}</h4>
                                </div>
                            </div>
                            <div v-else class="text-center  border-2 rounded text-white" :class="category.fndIsCompleteQ === '1' || (!!category.fndFilQustQ && category.fndTQustQ !== category.fndFilQustQ) ? 'bg-[#7fafa5] border-[#7fafa5]':'bg-[#005F4B] border-2 border-[#005F4B]' ">
                                <div v-if="!!category.fndFilQustQ && category.fndTQustQ !== category.fndFilQustQ" data-module="editCase">
                                    <router-link v-if="category.InfxSlug !== 'general-questions' ? true : (readCategoryLength === storeInformant.total.length || readCategoryLength === storeInformant.total.length-1) ? true : false" :to="'/informant/'+category.InfxSlug">
                                        <h4 :class=" (category.fndIsCompleteQ === '1' || (!!category.fndFilQustQ && category.fndTQustQ !== category.fndFilQustQ) ? 'p-4' : 'p-6') ">
                                            <span class="text-[20px]">{{category.Infx_CatName}}</span>
                                            <h6 v-if="category.fndIsCompleteQ === '1'" class="text-[13px] text-center" role="button" style="color:black">{{t('completed')}}</h6>
                                            <h6 v-else-if="!!category.fndFilQustQ && category.fndTQustQ !== category.fndFilQustQ" class="text-[13px] text-red-500 text-center" role="button">{{t('not_completed')}}</h6>
                                        </h4>
                                    </router-link>
                                    <div v-else  @click="confirmDialog" role="button" >
                                        <h4 :class=" (category.fndIsCompleteQ === '1' || (!!category.fndFilQustQ && category.fndTQustQ !== category.fndFilQustQ) ? 'p-4' : 'p-6') ">
                                            <span class="text-[20px]">{{category.Infx_CatName}}</span>
                                            <h6 v-if="category.fndIsCompleteQ === '1'" class="text-[13px] text-center" role="button" style="color:black">{{t('completed')}}</h6>
                                            <h6 v-else-if="!!category.fndFilQustQ && category.fndTQustQ !== category.fndFilQustQ" class="text-[13px] text-red-500 text-center" role="button">{{t('not_completed')}}</h6>
                                        </h4>
                                    </div>
                                </div>
                                <div v-else data-module="completeCase">
                                    <router-link v-if="category.InfxSlug !== 'general-questions' ? true : (readCategoryLength === storeInformant.total.length || readCategoryLength === storeInformant.total.length-1) ? true : false" :to="'/informant/'+category.InfxSlug">
                                        <h4 :class=" (category.fndIsCompleteQ === '1' ? 'p-4' : 'p-6') ">
                                            <span class="text-[20px]">{{category.Infx_CatName}}</span>
                                            <h6 v-if="category.fndIsCompleteQ === '1'" class="text-[13px] text-center" role="button" style="color:black">{{t('completed')}}</h6>
                                            <h6 v-else-if="!!category.fndFilQustQ && category.fndTQustQ !== category.fndFilQustQ" class="text-[13px] text-red-500 text-center" role="button">{{t('not_completed')}}</h6>
                                        </h4>
                                    </router-link>
                                    <div v-else @click="confirmDialog" role="button">
                                        <h4 :class=" (category.fndIsCompleteQ === '1' ? 'p-4' : 'p-6') ">
                                            <span class="text-[20px]">{{category.Infx_CatName}}</span>
                                            <h6 v-if="category.fndIsCompleteQ === '1'" class="text-[13px] text-center" role="button" style="color:black">{{t('completed')}}</h6>
                                            <h6 v-else-if="!!category.fndFilQustQ && category.fndTQustQ !== category.fndFilQustQ" class="text-[13px] text-red-500 text-center" role="button">{{t('not_completed')}}</h6>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
