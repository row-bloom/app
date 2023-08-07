<template>
    <base-editor
        :additionalExtensions="[css()]"
        :code="store.cssCopy"
        @change="store.setCss($event)"
    />
</template>

<script setup lang="ts">
import { css } from "@codemirror/lang-css";

import useAppStore from "@/stores/app";
import BaseEditor from "@/components/editors/BaseEditor.vue";

const store = useAppStore();

store.setCss(`* {
    padding : 0;
    margin : 0;
}`);
</script>
