<script setup>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import BreezeLabel from '@/Components/Label.vue';
    import BreezeInput from '@/Components/Input.vue';
    import LoginLogo from '@/Components/LoginLogo.vue';
    import MasterFooter from '@/Components/MasterFooter.vue';
    import MasterHeader from '@/Components/MasterHeader.vue';
    import BreezeButton from '@/Components/Button.vue';
    import commonFunctions from "@/use/common";
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import { ref, reactive , onMounted} from 'vue';
    import axios from 'axios';
    import useFooterList from "../../../use/useFooterList";

    const { Toast } = commonFunctions()
    const { footerLists , avb } = useFooterList()

</script>

<template>
    <BreezeAuthenticatedLayout>
        <div class="flex justify-center items-center max-w-lg mx-auto font-serif">
            <div class="w-full mb-20 justify-center">
                <MasterHeader/>
                <div class="h-fit flex justify-center text-[30px]">
                    <div class="w-full">
                        <Link :href="route('diet')" class="flex my-16 items-center justify-start space-x-6 ml-10">
                            <LoginLogo class="max-h-10"/>
                            <div>Diet</div>
                        </Link>
                        <Link :href="route('survey')" class="flex my-16 items-center justify-start space-x-6 ml-10">
                            <LoginLogo class="max-h-10"/>
                            <div>Survey</div>
                        </Link>
                        <Link class="flex my-16 items-center justify-start space-x-6 ml-10">
                            <LoginLogo class="max-h-10"/>
                            <div>Questionnaires</div>
                        </Link>
                        <Link :href="route('results')" class="flex my-16 items-center justify-start space-x-6 ml-10">
                            <LoginLogo class="max-h-10"/>
                            <div>Results</div>
                        </Link>
                    </div>
                </div>
            </div>
            <MasterFooter
                :footerLists="footerLists"
            />
        </div>
    </BreezeAuthenticatedLayout>
</template>
