<script setup>
    import BreezeButton from '@/Components/Button.vue';
    import MasterFooter from '@/Components/MasterFooter.vue';
    import BreezeGuestLayout from '@/Layouts/Guest.vue';
    import BreezeInput from '@/Components/Input.vue';
    import BreezeLabel from '@/Components/Label.vue';
    import LoginRegisterHeader from '@/Components/LoginRegisterHeader.vue';
    import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
    import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
    import useFooterList from "../../../use/useFooterList";

    const { footerLists , avb } = useFooterList()
    const form = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        terms: false,
    });

    const submit = () => {
        form.post(route('register'), {
            onFinish: () => form.reset('password', 'password_confirmation'),
        });
    }
    const eye_one = (e) => {
        const password = document.querySelector("#password")

        const type = password.getAttribute("type") === "password" ? "text" : "password"
        password.setAttribute("type", type)
        e.target.classList.toggle('fa-eye-slash')
    }
    const eye_two = (e) => {
        const password = document.querySelector("#password_confirmation")

        const type = password.getAttribute("type") === "password" ? "text" : "password"
        password.setAttribute("type", type)
        e.target.classList.toggle('fa-eye-slash')
    }
</script>

<template>
    <BreezeGuestLayout>
        <Head title="Register" />
        <div class="min-h-screen flex justify-center items-center max-w-lg mx-auto font-serif">
            <div class="w-full mb-28 justify-center">
                <LoginRegisterHeader/>
                <form @submit.prevent="submit" class="text-[22px] mx-10">
                    <div>
                        <BreezeLabel for="name" class="text-black" value="Name" />
                        <BreezeInput id="name" type="text" class="mt-1 border-b-8 border-[#639f1e] bg-transparent outline-0 block w-full" v-model="form.name" required autofocus autocomplete="name" />
                    </div>

                    <div class="mt-4">
                        <BreezeLabel for="email" value="Email" />
                        <BreezeInput id="email" type="email" class="mt-1 block w-full border-b-8 border-[#639f1e] outline-0 bg-transparent" v-model="form.email" required autocomplete="username" />
                    </div>

                    <div class="mt-4">
                        <div class="flex mt-2 justify-between">
                            <BreezeLabel for="password" value="Password" />
                            <i @click="eye_one" class="fa fa-eye fa-lg mt-2 mr-4 text-[#639f1e]"></i>
                        </div>
                        <BreezeInput id="password" type="password" class="mt-1 block w-full border-b-8 border-[#639f1e] outline-0 bg-transparent" v-model="form.password" required autocomplete="new-password" />
                    </div>

                    <div class="mt-4">
                        <div class="flex mt-2 justify-between">
                            <BreezeLabel for="password_confirmation" value="Confirm Password" />
                            <i @click="eye_two" class="fa fa-eye fa-lg mt-2 mr-4 text-[#639f1e]"></i>
                        </div>
                        <BreezeInput id="password_confirmation" type="password" class="mt-1 block w-full border-b-8 border-[#639f1e] outline-0 bg-transparent" v-model="form.password_confirmation" required autocomplete="new-password" />
                    </div>
                    <Link :href="route('login')" class="text-center flex justify-center mt-5 underline text-sm text-gray-600 hover:text-gray-900">
                        Already registered?
                    </Link>
                    <BreezeValidationErrors class="mb-4" />
                    <div class="flex items-center justify-end mt-4">
                        <BreezeButton class="bg-[#639f1e] text-white w-full font-sans submit mx-auto py-3 justify-center text-[25px] font-bold" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Register
                        </BreezeButton>
                    </div>
                </form>

            </div>
            <MasterFooter
                :footerLists="footerLists"
            />
        </div>
    </BreezeGuestLayout>
</template>
