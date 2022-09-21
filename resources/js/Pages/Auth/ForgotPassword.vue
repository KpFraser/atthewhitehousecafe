<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import MasterFooter from '@/Components/MasterFooter.vue';
import LoginRegisterHeader from '@/Components/LoginRegisterHeader.vue';
import useFooterList from "../../../use/useFooterList";


const { footerLists } = useFooterList()

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <BreezeGuestLayout>
        <Head title="Forgot Password" />
        <div class="mt-6">
            <LoginRegisterHeader />
        </div>
        <div class="min-h-[60vh] flex justify-center items-center max-w-lg mx-auto font-serif">
            <div class="w-full mx-10 mb-28 justify-center">
                <div class="mb-4 text-[16px] text-center text-black">
                    Forgot your password? <br>No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
                </div>

                <div v-if="status" class="mb-4 text-center font-medium text-sm text-green-600">
                    {{ status }}
                </div>

                <BreezeValidationErrors class="mb-4" />
                <form @submit.prevent="submit" class="text-[22px]">
                    <div>
                        <BreezeLabel for="email" value="Email" />
                        <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username" />
                    </div>
                    <BreezeButton class="bg-[#639f1e] mt-5 text-white w-full font-sans submit mx-auto py-3 justify-center font-bold text-[20px]" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Email Password Reset Link
                    </BreezeButton>
                </form>
            </div>
            <MasterFooter
                :footerLists="footerLists"
            />
        </div>
    </BreezeGuestLayout>
</template>
