import { defineStore } from "pinia";

import { computed, ref } from "vue";

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

    return {
        css,
        cssCopy,
        setCss,
        template,
        templateCopy,
        setTemplate,
    };
});
