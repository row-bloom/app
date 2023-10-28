<template>
    <div
        class="flex-1 p-2 border-2 border-white border-dashed rounded-md cursor-pointer"
    >
        <div v-bind="getRootProps()">
            <input v-bind="getInputProps()" />
            <p>Drop the files here ...</p>
        </div>
    </div>
</template>

<script setup lang="ts">
import axios from "axios";
import { useDropzone } from "vue3-dropzone";

import useRenderStore from "@/stores/render";

const renderStore = useRenderStore();

const { getRootProps, getInputProps, ...rest } = useDropzone({
    onDrop,
    multiple: false,
});

const url = "/api/read-table-content";

function onDrop(acceptFile: File[], rejectReasons: string[]) {
    console.log(acceptFile);

    saveFile(acceptFile); // saveFiles as callback

    if (rejectReasons.length) {
        console.error(rejectReasons);
    }
}

function saveFile(file: File[]) {
    const formData = new FormData();
    formData.append("table", file[0]);

    axios
        .post(url, formData)
        .then((response) => {
            console.info(response.data);
            renderStore.appendToTable(response.data);
        })
        .catch((err) => {
            console.error(err);
        });
}
</script>
