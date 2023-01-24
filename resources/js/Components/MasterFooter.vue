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
                        <div :class="{'bg-[#639f1e] border-[2px] !border-black':itemUrl === footer.to}" class="!w-[11px] !h-10 rounded-[1px] border border-gray-500"></div>
                        <div :class="{'bg-[#639f1e] border-[2px] !border-black':itemUrl === footer.to}" class="!w-[11px] mx-[1px] !h-8 mt-2 rounded-[1px] border border-gray-500"></div>
                        <div :class="{'bg-[#639f1e] border-[2px] !border-black':itemUrl === footer.to}" class="!w-[11px] !h-10 rounded-[1px] border border-gray-500"></div>
                    </div>
                    <div v-else-if="footer.label==='Do'">
                        <i :class="{'text-[#639f1e] testIconSelect':itemUrl === ''}" class="fas testIcon fa-2x fa-check"></i>
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
