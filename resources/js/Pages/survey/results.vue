<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import MasterHeader from '@/Components/MasterHeader.vue';
import MasterFooter from '@/Components/MasterFooter.vue';
import useFooterList from "../../../use/useFooterList";
import commonFunctions from "@/use/common";
import {onMounted, ref} from "vue";

const { Toast } = commonFunctions(),
    { footerLists  } = useFooterList(),
    questionName = ref([]),
    questionData = ref([]),
    surveyTable = ref([]),
    surveyTbData = ref([]),
    tbHeaderTh = "text-sm text-center py-3 bg-gray-50 border border-slate-300 text-left bg-black text-white",
    tbBodyTd= "text-center text-sm  py-3 bg-gray-50 border border-slate-300 text-left"

    const results = async () =>{

        await axios.get('/survey-results').then((response)=>{
             if(response.data.status === 200 )
             {
                 questionData.value = response.data?.data
                 questionName.value = response.data?.data2
                 surveyTable.value = response.data?.data3
             }
        }).finally(()=>{
            graph();
            surveyTableShow()
        })
    }

    function surveyTableShow(){
        var arrayData = [],
            results = [],
            getNames,
            innerResult,
            mergedArray,
            filterUndefinedData

        if(!!questionName.value){
            questionName.value.forEach(function(value){
                results = _.filter(questionData.value, function(o) { return o.project_id === value.id });

                if(!!results)
                {
                    innerResult = _.map(results, function(obj) {

                        getNames = _.find(surveyTable.value, ['contractId',obj.survey_contact_id]);

                        if(!!getNames)
                        {
                            for (const key in getNames) {

                                if (obj.survey_contact_id === getNames.contractId){
                                    if(!!arrayData[value.id])
                                        arrayData[value.id].push({['question_id']: value.id, ['name']: getNames.c_name, ['option'] : obj.options})
                                    else
                                    {
                                        arrayData[value.id] = []
                                        arrayData[value.id].push({['question_id']: value.id, ['name']: getNames.c_name, ['option'] : obj.options})
                                    }

                                    return obj;
                                }

                            }
                        }
                    });
                }

            })
        }
        // same question_id arrays merge
        mergedArray = [].concat.apply([], arrayData);
        // filter undefined object in array
        filterUndefinedData = _.without(mergedArray, undefined)
        surveyTbData.value = filterUndefinedData
    }

    function getName(optionNumber, q_id)
    {
        let namesArr = ''
        if(!!surveyTbData.value)
        {
            surveyTbData.value.forEach(function(value){
                if(!!value )
                {

                    if(value.question_id === q_id &&  value.option === optionNumber)
                    {
                        if(!!namesArr)
                            namesArr += ', ' +value.name
                        else
                            namesArr = value.name
                    }
                }
            })
        }
        return namesArr

    }

    function graphLabel(arrayData)
    {
        let questionLabel = []
        if(!!arrayData)
        {
            for (const element of arrayData ) {
                questionLabel.push(element.name)
            }
            return questionLabel
        }
    }
    function scoreData(optionValue)
    {
        var dataArray = []
        var data = ''
        questionName.value.forEach(function(value){
            var result = _.filter(questionData.value, function(o) { return o.project_id === value.id });
            if(!!result)
            {
                var result2 = _.filter(result, function(obj) { return obj.options === optionValue });
                if(!!result2){
                    data = countOfSurvey(result2)
                    dataArray.push(data)
                }
            }
        })
        return dataArray
    }

    /*
        In this function we get same options length and then get value of countsObject;
     */
    function countOfSurvey(arr)
    {
        var counts = {}
        var getValues = ''
        var questionVal = 0
        if(arr.length > 0){
            arr.forEach(x => counts[x] = (counts[x] || 0)+1 )

            getValues = Object.values(counts)
            if(!!getValues)
                questionVal = getValues[0]
        }
        return questionVal
    }

    onMounted(async ()=>{
        await results()
    })

    async function graph(){
        const ctxP = document.getElementById('myChart').getContext('2d');

        const myPieChart = new Chart(ctxP, {
            type: 'bar',
            data: {
                labels: await graphLabel(questionName.value),
                datasets: [{
                    label: 'Lead',
                    data: scoreData(3),
                    backgroundColor: "#639f1e",
                    hoverBackgroundColor: "#00ee97"
                },{
                    label: 'Assist',
                    data: scoreData(2),
                    backgroundColor: "#7FFF00",
                    hoverBackgroundColor: "#00ee97"
                },{
                    label: 'Participate',
                    data: scoreData(1),
                    backgroundColor: "#ADFF2F",
                    hoverBackgroundColor: "#00ee97"
                },{
                    label: 'Never',
                    data: scoreData(0),
                    backgroundColor: "#32CD32",
                    hoverBackgroundColor: "#00ee97"
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        stacked: true
                    },
                    y: {
                        beginAtZero: true,
                        stacked: true
                    },

                }
            }
        });
    }
</script>
<template>
    <BreezeAuthenticatedLayout>
        <div class="flex justify-center items-center max-w-lg mx-auto font-serif">
            <div class="w-full mb-28 justify-center">
                <MasterHeader/>
                <div class="h-fit flex justify-center text-[30px]">
                    <div class="w-full">
                        <div class="flex relative">
                            <div class="absolute -left-7 top-32 -rotate-90 text-[18px]">Responses</div>
                            <canvas class="pl-8" id="myChart"></canvas>
                        </div>
                        <div class="text-[18px] text-center">Activities </div>
                        <table class="min-w-full divide-y divide-gray-200 border-collapse border border-slate-400">
                            <thead>
                                <tr>
                                    <th :class="tbHeaderTh"></th>
                                    <th :class="tbHeaderTh">None</th>
                                    <th :class="tbHeaderTh">Participant</th>
                                    <th :class="tbHeaderTh">Assistant</th>
                                    <th :class="tbHeaderTh">Leader</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                                <tr v-for="row in questionName">
                                    <td :class="tbHeaderTh">{{ row.name }}</td>
                                    <td :class="tbBodyTd">
                                        {{ getName(0, row.id) }}
                                    </td>
                                    <td :class="tbBodyTd">
                                        {{ getName(1, row.id) }}
                                    </td>
                                    <td :class="tbBodyTd">
                                        {{ getName(2, row.id) }}
                                    </td>
                                    <td :class="tbBodyTd">
                                        {{ getName(3, row.id) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <MasterFooter
                :footerLists="footerLists"
            />
        </div>
    </BreezeAuthenticatedLayout>
</template>
<style scoped>
    canvas{
            width:450px !important;
            height:400px !important;
        }
</style>
