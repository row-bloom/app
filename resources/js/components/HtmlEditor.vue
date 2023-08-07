<template>
    <base-editor
        :additional-extensions="[html()]"
        :code="store.templateCopy"
        @change="store.setTemplate($event)"
    />
</template>

<script setup lang="ts">
import { html } from "@codemirror/lang-html";

import useAppStore from "@/stores/app";
import BaseEditor from "@/components/BaseEditor.vue";

const store = useAppStore();

store.setTemplate("<h1>template</h1>");
</script>
