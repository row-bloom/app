<template>
    <div>
        <form @submit.prevent="parse">
            <label for="table">Table</label>
            <input type="file" ref="fileInput" name="table" />
            <button
                type="submit"
                class="p-2 font-bold bg-gray-300 rounded-full text-slate-950"
            >
                parse
            </button>
        </form>

        <div class="overflow-y-auto max-h-96">
            <vue-json-pretty :data="appStore.table" />
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref } from "vue";
import axios from "axios";
import VueJsonPretty from "vue-json-pretty";
import "vue-json-pretty/lib/styles.css";

import useAppStore from "@/stores/app";

const appStore = useAppStore();

const fileInput = ref<HTMLInputElement | null>(null);

function parse() {
    const file = fileInput.value?.files?.[0];
    if (file) {
        const formData = new FormData();
        formData.append("table", file);

        axios
            .post("/api/read-table-content", formData)
            .then((response) => {
                appStore.appendToTable(response.data);
            })
            .catch((error) => {
                console.error(error);
            });
    } else {
        console.error("No file selected");
    }
}
</script>
