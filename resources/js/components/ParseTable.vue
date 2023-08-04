<template>
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
</template>

<script setup>
import { ref } from "vue";
import axios from "axios";

const fileInput = ref(null);

function parse() {
    const file = fileInput.value.files[0];
    if (file) {
        const formData = new FormData();
        formData.append("table", file);

        axios
            .post("/api/parse-table", formData)
            .then((response) => {
                // Handle the response from the server if needed
                console.table(response.data);
            })
            .catch((error) => {
                // Handle errors if any
                console.error(error);
            });
    } else {
        console.error("No file selected");
    }
}
</script>
