<template>
    <div class="flex flex-col w-full h-screen overflow-hidden">
        <div class="flex flex-1">
            <div class="flex-1 h-full border">
                <HtmlEditor />
            </div>
            <div class="flex-1 h-full border">
                <CssEditor />
            </div>
            <div class="h-full border w-80">
                <RenderingOptions />
            </div>
        </div>
        <div class="flex items-center justify-center gap-4 py-2 border-t">
            <RenderAction />
            <ParseTable />
        </div>
        <div class="h-[10%] flex flex-col">
            <div class="w-full overflow-auto">
                <table class="w-full text-sm">
                    <tr class="border-b">
                        <th class="h-12 px-4 font-medium align-middle">
                            Column 1
                        </th>
                        <th class="h-12 px-4 font-medium align-middle">
                            Column 2
                        </th>
                        <th class="h-12 px-4 font-medium align-middle">
                            Column 3
                        </th>
                    </tr>
                    <tr class="border-b">
                        <td class="p-4 align-middle">Data 1</td>
                        <td class="p-4 align-middle">Data 2</td>
                        <td class="p-4 align-middle">Data 3</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import useSupportStore from "@/stores/support";
import HtmlEditor from "@/components/editors/HtmlEditor.vue";
import CssEditor from "@/components/editors/CssEditor.vue";
import RenderAction from "@/components/render/RenderAction.vue";
import RenderingOptions from "@/components/options/RenderingOptions.vue";
import ParseTable from "@/components/tables/ParseTable.vue";

useSupportStore().init();
</script>
