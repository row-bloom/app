<template>
    <codemirror
        :modelValue="props.code"
        placeholder="code goes here..."
        :style="{ height: '100%' }"
        :autofocus="true"
        :indent-with-tab="true"
        :tab-size="4"
        :extensions="extensions"
        @ready="handleReady"
    />
</template>

<script setup lang="ts">
import { shallowRef, computed } from "vue";
import { Codemirror } from "vue-codemirror";
import { oneDark } from "@codemirror/theme-one-dark";

const props = defineProps({
    additionalExtensions: {
        type: Array,
        required: true,
        default: [],
    },
    code: {
        type: String,
        required: true,
    },
});

const baseExtensions = [oneDark];

const extensions = computed(() => [
    ...baseExtensions,
    ...props.additionalExtensions,
]);

const view = shallowRef();
const handleReady = (payload: any) => {
    view.value = payload.view;
};
</script>
