<template>
    <div>
      <h1>File Reader</h1>
      <input type="file" @change="handleFileChange">
      <pre>{{ fileContent }}</pre>
    </div>
  </template>

  <script setup>
  import { ref } from 'vue';

  const fileContent = ref('');

  const handleFileChange = (event) => {
    const file = event.target.files[0];

    if (file) {
      const reader = new FileReader();
      reader.onload = () => {
        fileContent.value = reader.result;
      };
      reader.readAsText(file);
    } else {
      fileContent.value = "No file selected.";
    }
  };
  </script>
