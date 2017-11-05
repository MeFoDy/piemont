import ProductCard from "@/components/product-card/ProductCard.vue";
import config from "@/config";

export default {
    name: "Hero",
    props: ["apiBaseUrl"],
    components: {
        ProductCard,
    },
    mounted() {
        this.getProducts();
    },
    methods: {
        getProducts() {
            this.$root.$data.emitter.emit("loading-started");
            this.$http.get(`${ config.apiBaseUrl }products.php`).then(response => {
                this.$root.$data.categories = response.body.filter(category => category.products.length);
                this.categories = this.$root.$data.categories;
                this.$root.$data.emitter.emit("loading-finished");
            }, () => {
                this.$root.$data.emitter.emit("loading-finished");
            });
        },
    },
    data() {
        return {
            msg: "Test",
            categories: [],
        };
    },
};
