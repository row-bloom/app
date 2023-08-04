<template>
    <div class="grid h-screen grid-cols-8 overflow-hidden bg-slate-800">
        <div class="h-screen col-span-4 overflow-hidden border border-gray-300">
            <form @submit.prevent="render">
                <button
                    type="submit"
                    class="p-2 font-bold bg-gray-300 rounded-full text-slate-950"
                >
                    render
                </button>
            </form>
            <hr />
            <RenderingOptions />
            <hr />
            <ParseTable />
        </div>
        <div
            class="flex flex-col col-span-4 overflow-hidden border border-gray-300 grow-0 shrink basis-full"
        >
            <div
                class="overflow-hidden border border-gray-300 grow-0 shrink basis-1/2"
            >
                <div class="h-full overflow-auto">
                    <HtmlEditor />
                </div>
            </div>
            <div
                class="overflow-hidden border border-gray-300 grow-0 shrink basis-1/2"
            >
                <div class="h-full overflow-auto">
                    <CssEditor />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from "axios";

import { useAppStore } from "@/stores/app.js";
import HtmlEditor from "@/components/HtmlEditor.vue";
import CssEditor from "@/components/CssEditor.vue";
import RenderingOptions from "@/components/RenderingOptions.vue";
import ParseTable from "./components/ParseTable.Vue";

const appStore = useAppStore();

function render() {
    axios.post("/api/render", {
        css: appStore.css,
        template: appStore.template,
        options: appStore.renderingOptions,
    });
}
</script>
