import ProductCard from "@/components/product-card/ProductCard.vue";
import config from "@/config";

export default {
    name: "Hero",
    props: ["apiBaseUrl"],
    components: {
        ProductCard,
    },
    created() {
        this.getProducts();
    },
    methods: {
        getProducts() {
            this.$http.get(`${ config.apiBaseUrl }products.php`).then(response => {
                this.$root.$data.categories = response.body.filter(category => category.products.length);
                this.categories = this.$root.$data.categories;
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
