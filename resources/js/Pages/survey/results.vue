<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import MasterHeader from '@/Components/MasterHeader.vue';
import MasterFooter from '@/Components/MasterFooter.vue';
import useFooterList from "../../../use/useFooterList";
import commonFunctions from "@/use/common";
import {onMounted, ref} from "vue";
import axios from 'axios';
import _ from 'lodash';


const { Toast } = commonFunctions()
const { footerLists  } = useFooterList()
const result_array = ref([])

const results = () =>{
    axios.get('/survey-results').then((response)=>{
        let test =  response.data
        let result = _.map(test, function(o) {
            if (o.game_id == "1") return o;
        });
        result = _.without(result, undefined)
        result_array.value.push(result.length)
        console.log(result)
    })
}
    onMounted(()=>{
        results()
        graph()
    })
    function graph(){
        const ctxP = document.getElementById('myChart').getContext('2d');

        const myPieChart = new Chart(ctxP, {
            type: 'bar',
            data: {
                labels: ["Canoeing", "Morning Runs", "Track Runs", "Frisbee", "Lead Cycling", "Lead Walks", "Cooking", "Gardening", "Pickelball"],
                datasets: [{
                    label: 'Lead',
                    data: [2, 1, 3, 2, 1, 2, 2, 1, 4, 1],
                    backgroundColor: "#639f1e",
                    hoverBackgroundColor: "#00ee97"
                },{
                    label: 'Assist',
                    data: [3, 4, 4, 3, 1, 3, 2, 3, 1, 2],
                    backgroundColor: "#7FFF00",
                    hoverBackgroundColor: "#00ee97"
                },{
                    label: 'Participate',
                    data: [2, 1, 2, 1, 2, 2, 3, 1, 0, 2],
                    backgroundColor: "#ADFF2F",
                    hoverBackgroundColor: "#00ee97"
                },{
                    label: 'Never',
                    data: [1, 1, 2, 2, 3, 1, 2, 1, 1, 1],
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
