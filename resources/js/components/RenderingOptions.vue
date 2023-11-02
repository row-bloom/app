<template>
    <form
        class="grid items-center grid-cols-2 p-2 gap-x-1 gap-y-3 justify-items-start"
    >
        <!-- -------------- -->

        <label for="interpolator">Interpolator </label>
        <select
            name="interpolator"
            v-model="renderStore.interpolator"
            class="w-full border rounded-md bg-slate-900 border-gray-50"
        >
            <option
                v-for="interpolator in supportStore.interpolatorDrivers.value"
                :key="interpolator"
                :value="interpolator"
            >
                {{ interpolator }}
            </option>
        </select>

        <!-- -------------- -->

        <label for="renderer">Renderer </label>
        <select
            name="renderer"
            v-model="renderStore.renderer"
            class="w-full border rounded-md bg-slate-900 border-gray-50"
        >
            <option
                v-for="renderer in supportStore.rendererDrivers.value"
                :key="renderer"
                :value="renderer"
            >
                {{ renderer }}
            </option>
        </select>

        <!-- -------------- -->

        <label for="displayHeaderFooter">Headers and footers </label>
        <input
            type="checkbox"
            name="displayHeaderFooter"
            v-model="renderStore.renderingOptions.displayHeaderFooter"
        />

        <!-- -------------- -->

        <textarea
            name="rawHeader"
            v-model="renderStore.renderingOptions.rawHeader"
            class="w-full col-span-2 p-1 rounded-md bg-slate-800 text-gray-50 border-gray-50"
        ></textarea>

        <textarea
            name="rawFooter"
            v-model="renderStore.renderingOptions.rawFooter"
            class="w-full col-span-2 p-1 rounded-md bg-slate-800 text-gray-50 border-gray-50"
        ></textarea>

        <!-- -------------- -->

        <label for="printBackground">Background graphics </label>
        <input
            type="checkbox"
            name="printBackground"
            v-model="renderStore.renderingOptions.printBackground"
        />

        <!-- -------------- -->

        <label for="preferCSSPageSize">Prefer CSS page size </label>
        <input
            type="checkbox"
            name="preferCSSPageSize"
            v-model="renderStore.renderingOptions.preferCSSPageSize"
        />

        <!-- -------------- -->

        <label for="perPage">Rows before page break </label>
        <input
            type="number"
            name="perPage"
            v-model="renderStore.renderingOptions.perPage"
            class="w-full p-1 border rounded-md border-gray-50 bg-slate-800"
        />

        <!-- -------------- -->

        <label for="landscape">Landscape </label>
        <input
            type="checkbox"
            name="landscape"
            v-model="renderStore.renderingOptions.landscape"
        />

        <!-- -------------- -->

        <!-- TODO: format -->
        <!-- TODO: width -->
        <!-- TODO: height -->

        <label for="margin">Margins </label>
        <input
            type="text"
            name="margin"
            v-model="renderStore.renderingOptions.margin"
            class="w-full p-1 border rounded-md border-gray-50 bg-slate-800"
        />

        <!-- -------------- -->

        <label for="metadataTitle">File title (meta data) </label>
        <input
            type="text"
            name="metadataTitle"
            v-model="renderStore.renderingOptions.metadataTitle"
            class="w-full p-1 border rounded-md border-gray-50 bg-slate-800"
        />

        <!-- -------------- -->

        <label for="metadataAuthor">File author (meta data) </label>
        <input
            type="text"
            name="metadataAuthor"
            v-model="renderStore.renderingOptions.metadataAuthor"
            class="w-full p-1 border rounded-md border-gray-50 bg-slate-800"
        />

        <!-- -------------- -->

        <label for="metadataCreator">File creator (meta data) </label>
        <input
            type="text"
            name="metadataCreator"
            v-model="renderStore.renderingOptions.metadataCreator"
            class="w-full p-1 border rounded-md border-gray-50 bg-slate-800"
        />

        <!-- -------------- -->

        <label for="metadataSubject">File subject (meta data) </label>
        <input
            type="text"
            name="metadataSubject"
            v-model="renderStore.renderingOptions.metadataSubject"
            class="w-full p-1 border rounded-md border-gray-50 bg-slate-800"
        />

        <!-- -------------- -->

        <label for="metadataKeywords">File keywords (meta data) </label>
        <input
            type="text"
            name="metadataKeywords"
            v-model="renderStore.renderingOptions.metadataKeywords"
            class="w-full p-1 border rounded-md border-gray-50 bg-slate-800"
        />

        <!-- -------------- -->
    </form>
</template>

<script setup lang="ts">
import useRenderStore from "@/stores/render";
import useSupportStore from "@/stores/support";

const renderStore = useRenderStore();
const supportStore = useSupportStore();
</script>
