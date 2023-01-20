<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import {onMounted, ref} from "vue";

const itemUrl = ref('')

const props = defineProps({
        footerLists: {
            Type: Object,
            required: true
        }
    })

onMounted(()=>{
     let url = window.location.pathname.split('/')
        itemUrl.value = url[1]
})
</script>
<template>
    <footer class="fixed w-full bottom-0">
        <div class="grid mx-auto text-[13.5px] sm:text-[20px] justify-center max-w-lg bg-white py-4 border border-black grid-cols-4">
            <div class="text-center text-gray-500" v-for="footer in footerLists">
                <Link :href="route(footer.to)" :class="{'text-[#639f1e]': itemUrl === footer.to}">
                    <div v-if="footer.label==='Plan'" class="mb-1 flex justify-center">
<!--                        <svg class="!-rotate-90 mx-auto" v-if="itemUrl === footer.to" width="40px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                            <rect x="2" y="3" width="16" height="3" stroke="rgb(99, 159, 30)" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                            <rect x="2" y="10" width="10" height="3" stroke="rgb(99, 159, 30)" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                            <rect x="2" y="17" width="14" height="3" stroke="rgb(99, 159, 30)" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                        </svg>-->
<!--                        <svg v-else class="mx-auto !-rotate-90" width="40px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                            <rect x="2" y="3" width="16" height="3" stroke="rgb(107 114 128)" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                            <rect x="2" y="10" width="10" height="3" stroke="rgb(107 114 128)" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                            <rect x="2" y="17" width="14" height="3" stroke="rgb(107 114 128)" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                        </svg>-->
                        <div :class="{'bg-[#639f1e] border-[2px] !border-black':itemUrl === footer.to}" class="!w-[11px] !h-10 rounded-[1px] border border-gray-500"></div>
                        <div :class="{'bg-[#639f1e] border-[2px] !border-black':itemUrl === footer.to}" class="!w-[11px] mx-[1px] !h-8 mt-2 rounded-[1px] border border-gray-500"></div>
                        <div :class="{'bg-[#639f1e] border-[2px] !border-black':itemUrl === footer.to}" class="!w-[11px] !h-10 rounded-[1px] border border-gray-500"></div>
<!--                        <i class="fas !w-3 overflow-hidden fa-rectangle-portrait"></i>-->
<!--                        <i class="fas !w-3 overflow-hidden fa-rectangle-portrait"></i>-->
                    </div>
                    <div v-else-if="footer.label==='Do'">
                        <i :class="{'text-[#639f1e] testIconSelect':itemUrl === footer.to}" class="fas testIcon fa-2x fa-check"></i>
                    </div>
                    <div v-else-if="footer.label==='Review'">
                        <i :class="{'text-[#639f1e] testIconSelect':itemUrl === footer.to}" class="fas testIcon fa-2x fa-clipboard-check"></i>
                    </div>
                    <div v-else-if="footer.label==='Account'">
                        <i :class="{'text-[#639f1e] testIconSelect':itemUrl === footer.to}" class="fas testIcon fa-2x fa-user-circle"></i>
                    </div>
                    <div class="text-center text-[9pt] h-5" :class="{'text-[12pt]': itemUrl === footer.to}">{{ footer.label }}</div>
                </Link>
            </div>
        </div>
    </footer>
</template>
<style>

.testIcon {
    -webkit-text-fill-color: white;
    -webkit-text-stroke-width: 1px;
    -webkit-text-stroke-color: black;
}
.testIconSelect {
    -webkit-text-fill-color: #639f1e !important;
    -webkit-text-stroke-width: 2px;
    -webkit-text-stroke-color: black;
}
</style>
