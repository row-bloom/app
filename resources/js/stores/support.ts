import axios from "axios";
import { defineStore } from "pinia";
import { reactive } from "vue";

const useSupportStore = defineStore("support", () => {
    {
        const dataLoaderDrivers = reactive<any>([]);
        const interpolatorDrivers = reactive<any>([]);
        const rendererDrivers = reactive<any>([]);
        const supportedTableFileExtensions = reactive<any>({});
        const rendererOptionsSupport = reactive<any>({});

        function init() {
            axios
                .get("/api/support")
                .then((response) => {
                    dataLoaderDrivers.value =
                        response.data.dataLoaderDrivers;
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
            dataLoaderDrivers,
            interpolatorDrivers,
            rendererDrivers,
            supportedTableFileExtensions,
            rendererOptionsSupport,
        };
    }
});

export default useSupportStore;
