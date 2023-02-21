<script setup>
    const props = defineProps({
        ModalId: {
            default: '',
            type: String
        },
        ModalTitle: {
            default: '',
            type: String
        }
    })
    defineEmits(['CloseModel'])

</script>

<template>
    <div data-te-modal-init :id="ModalId" class="fixed top-0 left-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none" data-te-backdrop="static" data-te-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div data-te-modal-dialog-ref class="pointer-events-none relative w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px]">
            <div class="min-[576px]:shadow-[0_0.5rem_1rem_rgba(#000, 0.15)] pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-neutral-600">
                <div class="flex flex-shrink-0 items-center justify-between rounded-t-md p-4 dark:border-opacity-50">
                    <h5 class="text-xl font-medium leading-normal text-neutral-800 dark:text-neutral-200">
                        {{ ModalTitle }}
                    </h5>
                    <div class="flex items-center justify-between rounded-t-md">
                        <button @click="$emit('CloseModel')" type="button" class="btn-close py-1 px-3 box-content flex items-center hover:bg-[#7eca21] text-center font-extrabold bg-[#639f1e] uppercase font-sans text-white" data-te-modal-dismiss aria-label="Close">x</button>
                    </div>
                </div>
                <div data-te-modal-body-ref class="relative px-4">
                    <slot />
                </div>
            </div>
        </div>
    </div>
</template>
