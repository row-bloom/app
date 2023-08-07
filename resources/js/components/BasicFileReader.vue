<template>
    <div>
        <h1>File Reader</h1>
        <input type="file" @change="handleFileChange" />
        <pre>{{ store.css }}</pre>
    </div>
</template>

<script setup lang="ts">
import useAppStore from "@/stores/app";

const store = useAppStore();

const handleFileChange = (event: any) => {
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = () => {
            store.css = reader.result!.toString();
        };
        reader.readAsText(file);
    } else {
        store.css = "No file selected.";
    }
};
</script>
