<template>
    <base-editor
        :additionalExtensions="[css()]"
        :code="renderStore.cssCopy"
        @change="renderStore.setCss($event)"
    />
</template>

<script setup lang="ts">
import { css } from "@codemirror/lang-css";

import useRenderStore from "@/stores/render";
import BaseEditor from "@/components/editors/BaseEditor.vue";

const renderStore = useRenderStore();

renderStore.setCss(`* {
    padding : 0;
    margin : 0;
}`);
</script>
