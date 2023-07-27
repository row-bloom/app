import { defineStore } from "pinia";
import { ref } from "vue";

export const useAppStore = defineStore("app", () => {
    const css = ref("");
    // const name = ref('Eduardo')

    // const doubleCount = computed(() => count.value * 2)

    // function increment() {
    //   count.value++
    // }

    return {
        css,
        // name,
        // doubleCount,
        // increment
    };
});
