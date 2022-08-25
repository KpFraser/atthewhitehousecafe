<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import MasterHeader from '@/Components/MasterHeader.vue';
import MasterFooter from '@/Components/MasterFooter.vue';
import useFooterList from "../../../use/useFooterList";
import commonFunctions from "@/use/common";
import {onMounted} from "vue";

const { Toast } = commonFunctions()
const { footerLists  } = useFooterList()

onMounted(()=>{
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
                backgroundColor: ["#639f1e", "#639f1e", "#639f1e", "#639f1e", "#639f1e", "#639f1e", "#639f1e", "#639f1e", "#639f1e"],
                hoverBackgroundColor: ["#00ee97", "#00ee97", "#00ee97", "#00ee97", "#00ee97", "#00ee97", "#00ee97", "#00ee97", "#00ee97"]
            },{
                label: 'Assist',
                data: [3, 4, 4, 3, 1, 3, 2, 3, 1, 2],
                backgroundColor: ["#7FFF00", "#7FFF00", "#7FFF00", "#7FFF00", "#7FFF00", "#7FFF00", "#7FFF00", "#7FFF00", "#7FFF00"],
                hoverBackgroundColor: ["#00ee97", "#00ee97", "#00ee97", "#00ee97", "#00ee97", "#00ee97", "#00ee97", "#00ee97", "#00ee97"]
            },{
                label: 'Participate',
                data: [2, 1, 2, 1, 2, 2, 3, 1, 0, 2],
                backgroundColor: ["#ADFF2F", "#ADFF2F", "#ADFF2F", "#ADFF2F", "#ADFF2F", "#ADFF2F", "#ADFF2F", "#ADFF2F", "#ADFF2F"],
                hoverBackgroundColor: ["#00ee97", "#00ee97", "#00ee97", "#00ee97", "#00ee97", "#00ee97", "#00ee97", "#00ee97", "#00ee97"]
            },{
                label: 'Never',
                data: [1, 1, 2, 2, 3, 1, 2, 1, 1, 1],
                backgroundColor: ["#32CD32", "#32CD32", "#32CD32", "#32CD32", "#32CD32", "#32CD32", "#32CD32", "#32CD32", "#32CD32"],
                hoverBackgroundColor: ["#00ee97", "#00ee97", "#00ee97", "#00ee97", "#00ee97", "#00ee97", "#00ee97", "#00ee97", "#00ee97"]
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    stacked: true
                },
                x: {
                    stacked: true
                }
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
                            <div class="absolute -left-7 top-32 -rotate-90 text-[18px]">Activities</div>
                            <canvas class="pl-5" id="myChart" width="300" height="200"></canvas>
                        </div>
                        <div class="text-[18px] text-center">Responses</div>
                    </div>
                </div>
            </div>
            <MasterFooter
                :footerLists="footerLists"
            />
        </div>
    </BreezeAuthenticatedLayout>
</template>
