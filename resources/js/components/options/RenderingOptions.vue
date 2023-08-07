<template>
    <form>
        <div>
            <label for="interpolator">interpolator</label>
            <select name="interpolator" v-model="appStore.interpolatorDriver">
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
            <select name="renderer" v-model="appStore.rendererDriver">
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
                v-model="appStore.renderingOptions.displayHeaderFooter"
                :value="true"
            />
            <input
                type="radio"
                name="displayHeaderFooter"
                v-model="appStore.renderingOptions.displayHeaderFooter"
                :value="false"
            />
        </div>

        <div>
            <label for="rawHeader">rawHeader</label>
            <textarea
                name="rawHeader"
                v-model="appStore.renderingOptions.rawHeader"
            ></textarea>
        </div>

        <div>
            <label for="rawFooter">rawFooter</label>
            <textarea
                name="rawFooter"
                v-model="appStore.renderingOptions.rawFooter"
            ></textarea>
        </div>

        <div>
            <label for="printBackground">printBackground</label>
            <input
                type="radio"
                name="printBackground"
                v-model="appStore.renderingOptions.printBackground"
                :value="true"
            />
            <input
                type="radio"
                name="printBackground"
                v-model="appStore.renderingOptions.printBackground"
                :value="false"
            />
        </div>

        <div>
            <label for="preferCSSPageSize">preferCSSPageSize</label>
            <input
                type="radio"
                name="preferCSSPageSize"
                v-model="appStore.renderingOptions.preferCSSPageSize"
                :value="true"
            />
            <input
                type="radio"
                name="preferCSSPageSize"
                v-model="appStore.renderingOptions.preferCSSPageSize"
                :value="false"
            />
        </div>

        <div>
            <label for="perPage">perPage</label>
            <input
                type="number"
                name="perPage"
                v-model="appStore.renderingOptions.perPage"
            />
        </div>

        <div>
            <label for="landscape">landscape</label>
            <input
                type="radio"
                name="landscape"
                v-model="appStore.renderingOptions.landscape"
                :value="true"
            />
            <input
                type="radio"
                name="landscape"
                v-model="appStore.renderingOptions.landscape"
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
                v-model="appStore.renderingOptions.margin"
            />
        </div>

        <div>
            <label for="metadataTitle">metadataTitle</label>
            <input
                type="text"
                name="metadataTitle"
                v-model="appStore.renderingOptions.metadataTitle"
            />
        </div>

        <div>
            <label for="metadataAuthor">metadataAuthor</label>
            <input
                type="text"
                name="metadataAuthor"
                v-model="appStore.renderingOptions.metadataAuthor"
            />
        </div>

        <div>
            <label for="metadataCreator">metadataCreator</label>
            <input
                type="text"
                name="metadataCreator"
                v-model="appStore.renderingOptions.metadataCreator"
            />
        </div>

        <div>
            <label for="metadataSubject">metadataSubject</label>
            <input
                type="text"
                name="metadataSubject"
                v-model="appStore.renderingOptions.metadataSubject"
            />
        </div>

        <div>
            <label for="metadataKeywords">metadataKeywords</label>
            <input
                type="text"
                name="metadataKeywords"
                v-model="appStore.renderingOptions.metadataKeywords"
            />
        </div>
    </form>
</template>
<script setup lang="ts">
import useAppStore from "@/stores/app";
import useSupportStore from "@/stores/support";

const appStore = useAppStore();
const supportStore = useSupportStore();
</script>
