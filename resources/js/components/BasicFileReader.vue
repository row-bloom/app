<template>
    <div>
        <h1>File Reader</h1>
        <input type="file" @change="handleFileChange" />
        <pre>{{ store.css }}</pre>
    </div>
</template>

<script setup>
import { useAppStore } from "@/stores/app";

const store = useAppStore();

const handleFileChange = (event) => {
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = () => {
            store.css = reader.result;
        };
        reader.readAsText(file);
    } else {
        store.css = "No file selected.";
    }
};
</script>
