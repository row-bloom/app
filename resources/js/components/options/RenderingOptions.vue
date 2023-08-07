<template>
    <form>
        <div>
            <label for="interpolator">interpolator</label>
            <select
                name="interpolator"
                v-model="renderStore.interpolatorDriver"
            >
                <option
                    v-for="interpolator in supportStore.interpolatorDrivers
                        .value"
                    :key="interpolator"
                    :value="interpolator"
                >
                    {{ interpolator }}
                </option>
            </select>
        </div>

        <div>
            <label for="renderer">renderer</label>
            <select name="renderer" v-model="renderStore.rendererDriver">
                <option
                    v-for="renderer in supportStore.rendererDrivers.value"
                    :key="renderer"
                    :value="renderer"
                >
                    {{ renderer }}
                </option>
            </select>
        </div>

        <div>
            <label for="displayHeaderFooter">displayHeaderFooter</label>
            <input
                type="radio"
                name="displayHeaderFooter"
                v-model="renderStore.renderingOptions.displayHeaderFooter"
                :value="true"
            />
            <input
                type="radio"
                name="displayHeaderFooter"
                v-model="renderStore.renderingOptions.displayHeaderFooter"
                :value="false"
            />
        </div>

        <div>
            <label for="rawHeader">rawHeader</label>
            <textarea
                name="rawHeader"
                v-model="renderStore.renderingOptions.rawHeader"
            ></textarea>
        </div>

        <div>
            <label for="rawFooter">rawFooter</label>
            <textarea
                name="rawFooter"
                v-model="renderStore.renderingOptions.rawFooter"
            ></textarea>
        </div>

        <div>
            <label for="printBackground">printBackground</label>
            <input
                type="radio"
                name="printBackground"
                v-model="renderStore.renderingOptions.printBackground"
                :value="true"
            />
            <input
                type="radio"
                name="printBackground"
                v-model="renderStore.renderingOptions.printBackground"
                :value="false"
            />
        </div>

        <div>
            <label for="preferCSSPageSize">preferCSSPageSize</label>
            <input
                type="radio"
                name="preferCSSPageSize"
                v-model="renderStore.renderingOptions.preferCSSPageSize"
                :value="true"
            />
            <input
                type="radio"
                name="preferCSSPageSize"
                v-model="renderStore.renderingOptions.preferCSSPageSize"
                :value="false"
            />
        </div>

        <div>
            <label for="perPage">perPage</label>
            <input
                type="number"
                name="perPage"
                v-model="renderStore.renderingOptions.perPage"
            />
        </div>

        <div>
            <label for="landscape">landscape</label>
            <input
                type="radio"
                name="landscape"
                v-model="renderStore.renderingOptions.landscape"
                :value="true"
            />
            <input
                type="radio"
                name="landscape"
                v-model="renderStore.renderingOptions.landscape"
                :value="false"
            />
        </div>

        <!-- TODO: format -->
        <!-- TODO: width -->
        <!-- TODO: height -->

        <div>
            <label for="margin">margin</label>
            <input
                type="text"
                name="margin"
                v-model="renderStore.renderingOptions.margin"
            />
        </div>

        <div>
            <label for="metadataTitle">metadataTitle</label>
            <input
                type="text"
                name="metadataTitle"
                v-model="renderStore.renderingOptions.metadataTitle"
            />
        </div>

        <div>
            <label for="metadataAuthor">metadataAuthor</label>
            <input
                type="text"
                name="metadataAuthor"
                v-model="renderStore.renderingOptions.metadataAuthor"
            />
        </div>

        <div>
            <label for="metadataCreator">metadataCreator</label>
            <input
                type="text"
                name="metadataCreator"
                v-model="renderStore.renderingOptions.metadataCreator"
            />
        </div>

        <div>
            <label for="metadataSubject">metadataSubject</label>
            <input
                type="text"
                name="metadataSubject"
                v-model="renderStore.renderingOptions.metadataSubject"
            />
        </div>

        <div>
            <label for="metadataKeywords">metadataKeywords</label>
            <input
                type="text"
                name="metadataKeywords"
                v-model="renderStore.renderingOptions.metadataKeywords"
            />
        </div>
    </form>
</template>
<script setup lang="ts">
import useRenderStore from "@/stores/render";
import useSupportStore from "@/stores/support";

const renderStore = useRenderStore();
const supportStore = useSupportStore();
</script>
