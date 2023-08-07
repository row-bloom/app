import { defineStore } from "pinia";

import { computed, reactive, ref } from "vue";

const useRenderStore = defineStore("render", () => {
    const interpolatorDriver = ref(null);
    const rendererDriver = ref(null);

    const css = ref("");
    const cssCopy = computed(() => css.value);
    const setCss = (newCss: string) => {
        css.value = newCss;
    };

    const template = ref("");
    const templateCopy = computed(() => template.value);
    const setTemplate = (newTemplate: string) => {
        template.value = newTemplate;
    };

    const renderingOptions = reactive({
        displayHeaderFooter: true,
        rawHeader: "",
        rawFooter: "",
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

    const table = reactive<{
        total: number;
        data: any;
    }>({
        total: 0,
        data: [],
    });

    function appendToTable(data: any) {
        const dataArray = Array.isArray(data) ? data : [data];

        table.data = [...table.data, ...dataArray];
        table.total = table.data.length;
    }

    return {
        interpolatorDriver,
        rendererDriver,
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

export default useRenderStore;
