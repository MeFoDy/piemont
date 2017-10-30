import config from "@/config";

export default {
    name: "ProductCard",
    props: ["item"],
    data() {
        return {
            imagesBase: `${ config.imagesBase }icecream/`,
        };
    },
};
