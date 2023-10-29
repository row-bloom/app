<template>
    <div class="flex flex-col w-full h-screen overflow-hidden">
        <div class="flex flex-1">
            <div class="flex-1 h-full border">
                <HtmlEditor />
            </div>
            <div class="flex-1 h-full border">
                <CssEditor />
            </div>
            <div class="h-full border min-w-[320px] max-w-[480px] w-1/3">
                <RenderingOptions />
            </div>
        </div>
        <div class="flex items-center justify-center gap-4 p-4 py-2 border-t">
            <ParseTable />
            <RenderAction />
            <p>{{ renderStore.table.total }} row(s)</p>
        </div>
        <div class="h-[10%] min-h-[200px] flex flex-col">
            <div class="w-full p-1 overflow-auto">
                <DataTable :value="renderStore.table.data" :class="''">
                    <Column
                        v-for="col of columns"
                        :key="col"
                        :field="col"
                        :header="col"
                        :class="'border p-1'"
                    ></Column>
                </DataTable>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import DataTable from "primevue/datatable";
import Column from "primevue/column";

import { computed } from "vue";

import useSupportStore from "@/stores/support";
import HtmlEditor from "@/components/editors/HtmlEditor.vue";
import CssEditor from "@/components/editors/CssEditor.vue";
import RenderAction from "@/components/RenderAction.vue";
import RenderingOptions from "@/components/RenderingOptions.vue";
import ParseTable from "@/components/ParseTable.vue";

import useRenderStore from "@/stores/render";

const renderStore = useRenderStore();

const columns = computed(() => {
    if (renderStore.table.data.length > 0) {
        return Object.keys(renderStore.table.data[0]);
    }
    return [];
});

useSupportStore().init();
</script>
