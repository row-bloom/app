<template>
    <div class="grid h-screen grid-cols-8 overflow-hidden bg-slate-800">
        <div
            class="h-screen col-span-4 overflow-hidden border border-gray-300"
        ></div>
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
import HtmlEditor from "@/components/HtmlEditor.vue";
import CssEditor from "@/components/CssEditor.vue";
</script>
