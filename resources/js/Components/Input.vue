<script setup>
import { onMounted, ref } from 'vue';

defineProps(['modelValue']);

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});
</script>

<template>
    <input class="!bg-white mt-1 block w-full border-x-0 border-t-0 border-b-8 border-[#639f1e] outline-0 focus:border-[#639f1e] focus:ring focus:ring-[#639f1e] focus:ring-opacity-50 shadow-sm" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">
</template>
