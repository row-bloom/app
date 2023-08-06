import { defineStore } from "pinia";
import { reactive } from "vue";

const useSupportStore = defineStore("support", () => {
    {
        const dataCollectorDrivers = reactive([]);
        const interpolatorDrivers = reactive([]);
        const rendererDrivers = reactive([]);
        const supportedTableFileExtensions = reactive({});
        const rendererOptionsSupport = reactive({});

        function init() {
            axios
                .get("/api/support")
                .then((response) => {
                    dataCollectorDrivers.value =
                        response.data.dataCollectorDrivers;
                    interpolatorDrivers.value =
                        response.data.interpolatorDrivers;
                    rendererDrivers.value = response.data.rendererDrivers;
                    supportedTableFileExtensions.value =
                        response.data.supportedTableFileExtensions;
                    rendererOptionsSupport.value =
                        response.data.rendererOptionsSupport;
                })
                .catch((error) => {
                    console.error("Error fetching options:", error);
                });
        }

        return {
            init,
            dataCollectorDrivers,
            interpolatorDrivers,
            rendererDrivers,
            supportedTableFileExtensions,
            rendererOptionsSupport,
        };
    }
});

export default useSupportStore;
