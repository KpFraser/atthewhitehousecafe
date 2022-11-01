<script setup>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import LoginLogo from '@/Components/LoginLogo.vue';
    import MasterHeader from '@/Components/MasterHeader.vue';
    import { Link } from '@inertiajs/inertia-vue3';
    import MasterFooter from '@/Components/MasterFooter.vue';
    import useFooterList from "../../use/useFooterList";

    const { footerLists } = useFooterList()

</script>

<template>
    <BreezeAuthenticatedLayout>
        <div class="flex justify-center items-center max-w-lg mx-auto font-serif">
            <div class="w-full mb-20 justify-center">
                <MasterHeader/>
                <div class="h-fit flex justify-center text-[30px]">
                    <div class="w-full">
                        <Link :href="route('new-project')" class="flex my-16 items-center justify-start space-x-6 ml-10">
                            <LoginLogo class="max-h-10"/>
                            <div>Proposed</div>
                        </Link>
                        <Link :href="route('proposals')" class="flex my-16 items-center justify-start space-x-6 ml-10">
                            <LoginLogo class="max-h-10"/>
                            <div>Proposals</div>
                        </Link>
                        <Link :href="route('applications-projects')" class="flex my-16 items-center justify-start space-x-6 ml-10">
                            <LoginLogo class="max-h-10"/>
                            <div>Applications</div>
                        </Link>
                        <Link :href="route('all-project')" class="flex my-16 items-center justify-start space-x-6 ml-10">
                            <LoginLogo class="max-h-10"/>
                            <div>Projects</div>
                        </Link>
                        <Link :href="route('archieved')" class="flex my-16 items-center justify-start space-x-6 ml-10">
                            <LoginLogo class="max-h-10"/>
                            <div>Archieved</div>
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
