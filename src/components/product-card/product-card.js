import config from "@/config";

export default {
    name: "ProductCard",
    props: ["item"],
    data() {
        return {
            entryCount: 1,
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
        this.entryCount = config.entryCount;
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
            this.count = +this.count + this.entryCount;
            this.validate();
        },
        decrementCount() {
            this.count -= this.count > 0 ? this.entryCount : 0;
            this.validate();
        },
        validate() {
            this.count = +this.count;
            if (this.count > this.item.quantity) {
                this.count = this.item.quantity;
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
            return (this.count * this.item.price).toFixed(2);
        },
        minusDisabled: function() {
            return this.count == 0;
        },
        plusDisabled: function() {
            return (+this.count + this.entryCount) >= this.item.quantity;
        },
        hasInStore: function() {
            return this.item.quantity >= this.entryCount;
        },
    },
};
