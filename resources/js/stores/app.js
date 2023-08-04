import { defineStore } from "pinia";

import { computed, reactive, ref } from "vue";

export const useAppStore = defineStore("app", () => {
    const css = ref("");
    const cssCopy = computed(() => css.value);
    const setCss = (newCss) => {
        css.value = newCss;
    };

    const template = ref("");
    const templateCopy = computed(() => template.value);
    const setTemplate = (newTemplate) => {
        template.value = newTemplate;
    };

    const renderingOptions = reactive({
        displayHeaderFooter: true,
        rawHeader: null,
        rawFooter: null,
        printBackground: false,
        preferCSSPageSize: false,
        perPage: 1,
        landscape: false,
        format: null,
        width: null,
        height: null,
        margin: "1 in",
        metadataTitle: null,
        metadataAuthor: null,
        metadataCreator: null,
        metadataSubject: null,
        metadataKeywords: null,
    });

    const table = reactive({
        total: 0,
        data: [],
    });

    function appendToTable(data) {
        table.data = [...table.data, ...data];
        table.total = table.data.length;
    }

    return {
        css,
        cssCopy,
        setCss,
        template,
        templateCopy,
        setTemplate,
        renderingOptions,
        table,
        appendToTable,
    };
});
