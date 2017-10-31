import config from "@/config";

export default {
    name: "ProductCard",
    props: ["item"],
    data() {
        return {
            count: 0,
            isInBasket: false,
            imagesBase: `${ config.imagesBase }icecream/`,
            unbindEmitter: null,
        };
    },
    mounted: function() {
        this.unbindEmitter = this.$root.$data.emitter.on("basket-changed", () => {
            this.syncFromBasket();
        });
        const product = this.basket.products.find(product => product.id == this.item.id);
        if (product) {
            this.count = product.count;
            this.isInBasket = !!product.isInBasket;
        }
    },
    beforeDestroy() {
        if (this.unbindEmitter) {
            this.unbindEmitter();
        }
    },
    methods: {
        syncFromBasket() {
            const product = this.basket.products.find(product => product.id == this.item.id);
            if (product) {
                this.count = +product.count;
            } else {
                this.count = 0;
            }
            this.isInBasket = this.count > 0;
        },
        syncToBasket() {
            let product = this.basket.products.find(product => product.id == this.item.id);
            if (product) {
                if (!product.isInBasket) {
                    product.count = this.count;
                    product.isInBasket = (+this.count) > 0;
                } else {
                    product.count = 0;
                    product.isInBasket = false;
                }
            } else {
                product = {
                    id: +this.item.id,
                    price: +this.item.price,
                    count: +this.count,
                    isInBasket: (+this.count) > 0,
                };
                this.basket.products.push(product);
            }
            this.isInBasket = product.isInBasket;
        },
        incrementCount() {
            this.count = +this.count + 1;
        },
        decrementCount() {
            this.count -= this.count > 0 ? 1 : 0;
        },
        validate() {
            this.count = Math.floor(this.count);
            if (this.count > Math.floor(this.item.quantity)) {
                this.count = Math.floor(this.item.quantity);
            }
            if (this.count < 0) {
                this.count = 0;
            }
        },
    },
    computed: {
        basket: function() {
            return this.$root.$data.basket;
        },
        total: function() {
            return this.count * this.item.price;
        },
        minusDisabled: function() {
            return this.count == 0;
        },
        plusDisabled: function() {
            return (+this.count + 1) >= this.item.quantity;
        },
        hasInStore: function() {
            return this.item.quantity >= 1;
        },
    },
};
