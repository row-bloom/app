<template>
    <div>
        <div class="grid h-screen grid-cols-8 overflow-hidden bg-slate-800">
            <div
                class="h-screen col-span-4 overflow-hidden border border-gray-300"
            >
                <form @submit.prevent="render">
                    <button
                        type="submit"
                        class="p-2 font-bold bg-gray-300 rounded-full text-slate-950"
                    >
                        render
                    </button>
                </form>
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
import axios from "axios";

import { useAppStore } from "@/stores/app.js";
import HtmlEditor from "@/components/HtmlEditor.vue";
import CssEditor from "@/components/CssEditor.vue";
import RenderingOptions from "@/components/RenderingOptions.vue";
import ParseTable from "@/components/ParseTable.Vue";

const appStore = useAppStore();

function render() {
    axios
        .post("/api/render", {
            css: appStore.css,
            template: appStore.template,
            table: appStore.table.data,
            options: appStore.renderingOptions,
        })
        .then((response) => {
            // Assuming the response contains the base64 encoded PDF content
            const base64PdfContent = response.data;

            // ! iframe

            // // Display the PDF content in an iframe or any suitable viewer
            // const pdfViewer = document.getElementById("pdfViewer");
            // pdfViewer.innerHTML = `<iframe src="data:application/pdf;base64,${base64PdfContent}" width="100%" height="500px"></iframe>`;

            // ! new window

            // Convert base64 PDF content to a Blob object
            const byteCharacters = atob(base64PdfContent);
            const byteArrays = [];
            for (
                let offset = 0;
                offset < byteCharacters.length;
                offset += 512
            ) {
                const slice = byteCharacters.slice(offset, offset + 512);
                const byteNumbers = new Array(slice.length);
                for (let i = 0; i < slice.length; i++) {
                    byteNumbers[i] = slice.charCodeAt(i);
                }
                const byteArray = new Uint8Array(byteNumbers);
                byteArrays.push(byteArray);
            }
            const pdfBlob = new Blob(byteArrays, { type: "application/pdf" });

            // Create a URL for the Blob object
            const pdfUrl = URL.createObjectURL(pdfBlob);

            // Open a new window with the PDF content
            window.open(pdfUrl, "_blank");
        })
        .catch((error) => {
            console.error("Error fetching the PDF content:", error);
        });
}
</script>
