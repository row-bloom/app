<template>
    <div
        class="flex-1 p-2 border-2 border-white border-dashed rounded-md cursor-pointer bg-slate-800"
    >
        <div v-bind="getRootProps()">
            <input v-bind="getInputProps()" />
            <p>
                Drop data files here ...
                {{
                    supportStore.supportedTableFileExtensions.value?.join(", ")
                }}
            </p>
        </div>
    </div>
</template>

<script setup lang="ts">
import axios from "axios";
import { useDropzone } from "vue3-dropzone";

import useRenderStore from "@/stores/render";
import useSupportStore from "@/stores/support";

const renderStore = useRenderStore();
const supportStore = useSupportStore();

const { getRootProps, getInputProps, ...rest } = useDropzone({
    onDrop,
    multiple: false,
});

function onDrop(acceptFile: File[], rejectReasons: string[]) {
    console.log(acceptFile);

    saveFile(acceptFile);

    if (rejectReasons.length) {
        console.error(rejectReasons);
    }
}

function saveFile(file: File[]) {
    const formData = new FormData();
    formData.append("table", file[0]);

    axios
        .post("/api/read-table-content", formData)
        .then((response) => {
            // console.table(response.data);
            renderStore.appendToTable(response.data);
        })
        .catch((err) => {
            console.error(err);
        });
}
</script>
