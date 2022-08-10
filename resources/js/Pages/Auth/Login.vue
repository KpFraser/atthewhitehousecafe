<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeCheckbox from '@/Components/Checkbox.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import LoginRegisterHeader from '@/Components/LoginRegisterHeader.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm, } from '@inertiajs/inertia-vue3';
import MasterFooter from '@/Components/MasterFooter.vue';
import { VueElement } from 'vue';
import useFooterList from "../../../use/useFooterList";

const { footerLists } = useFooterList()
defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

const PasswordView = (e) => {
    const password = document.querySelector("#password")

    const type = password.getAttribute("type") === "password" ? "text" : "password"
    password.setAttribute("type", type)
    e.target.classList.toggle('fa-eye-slash')
};
</script>

<template>

<!-- <img :src="'../storage/user_286_1607371610.jpg'"> -->
    <BreezeGuestLayout>
        <Head title="Log in" />
            <div class="min-h-screen flex justify-center items-center max-w-lg mx-auto font-serif">
                <div class="w-full mb-28 justify-center">
                    <LoginRegisterHeader />
                    <form  @submit.prevent="submit" class="text-[22px] mx-10">
                        <BreezeLabel for="email" class="text-black" value="Username" />
                        <BreezeInput id="email" type="email" v-model="form.email" required autofocus autocomplete="username" />
                        <div class="flex mt-2 justify-between">
                            <BreezeLabel for="password" value="Password" />
                            <i @click="PasswordView" class="cursor-pointer fa fa-eye fa-lg mt-2 mr-4 text-[#639f1e]"></i>
                        </div>
                        <BreezeInput id="password" type="password" v-model="form.password" required autocomplete="current-password" />
                        <BreezeValidationErrors class="mb-4" />
                        <div class="flex justify-between items-center py-5">
                            <label class="flex items-center">
                                <BreezeCheckbox class="accent-[#639f1e] w-6 h-6 mr-2" name="remember" v-model:checked="form.remember" />
                                <span class="ml-2 text-sm text-black">Remember me</span>
                            </label>
                            <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">
                                Forgot your password?
                            </Link>
                        </div>
                        <BreezeButton class="bg-[#639f1e] text-white w-full font-sans submit mx-auto py-3 justify-center font-bold text-[25px]" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Log In
                        </BreezeButton>
                    </form>
                    <div class="flex m-2 justify-center">
                        <Link :href="route('register')" class="text-gray-900 hover:text-gray-700 text-[20px]">
                            <i>Create Account</i>
                        </Link>
                    </div>
                </div>
                <MasterFooter
                :footerLists="footerLists"
                 />
            </div>
    </BreezeGuestLayout>
</template>
