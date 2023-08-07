<template>
    <base-editor
        :additional-extensions="[html()]"
        :code="renderStore.templateCopy"
        @change="renderStore.setTemplate($event)"
    />
</template>

<script setup lang="ts">
import { html } from "@codemirror/lang-html";

import useRenderStore from "@/stores/render";
import BaseEditor from "@/components/editors/BaseEditor.vue";

const renderStore = useRenderStore();

renderStore.setTemplate("<h1>template</h1>");
</script>
