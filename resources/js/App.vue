<template>
    <div>
        <div class="grid h-screen grid-cols-8 overflow-hidden bg-slate-800">
            <div
                class="h-screen col-span-4 overflow-hidden border border-gray-300"
            >
                <RenderAction />
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
        <div id="pdfViewer"></div>
    </div>
</template>

<script setup>
import HtmlEditor from "@/components/HtmlEditor.vue";
import CssEditor from "@/components/CssEditor.vue";
import RenderAction from "@/components/RenderAction.vue";
import RenderingOptions from "@/components/RenderingOptions.vue";
import ParseTable from "@/components/ParseTable.Vue";
</script>
