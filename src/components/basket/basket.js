import { SweetModal, SweetModalTab } from "sweet-modal-vue";
import config from "@/config";

export default {
    name: "PiemontBasket",
    components: {
        SweetModal,
        SweetModalTab,
    },
    data() {
        return {
            isInProcess: false,
            basket: [],
            total: 0,
            user: {
                name: "",
                phone: "",
                address: "",
                comment: "",
                products: [],
            },
        };
    },
    watch: {
        "$root.$data.basket.products"() {
            this.sync();
        },
    },
    created() {
        this.sync();
    },
    computed: {
        isValid() {
            const isValidName = !!this.user.name.trim();
            const isValidPhone = /\+375 \d{2} \d{3}-\d{2}-\d{2}/.test(this.user.phone);
            return isValidName && isValidPhone;
        },
        products() {
            return this.basket.products.filter(product => product.count > 0);
        },
        isVisible() {
            return this.basket.products.some(product => product.count > 0);
        },
        itemsCount() {
            return `${ this.products.length } ${ declOfNum(this.products.length, ["вид десерта", "вида десерта", "видов десерта"]) }`;
        },
        itemsPrice() {
            return this.products.reduce((prev, current) => prev + current.count * current.price, 0);
        },
    },
    methods: {
        sync() {
            this.basket = this.$root.$data.basket;
        },
        fillOrderInfo() {
            const self = this;
            this.user.products = this.products.map(product => {
                const category = self.$root.$data.categories.find(
                    category => category.products.some(p => p.id == product.id)
                );
                const productInfo = category.products.find(p => p.id == product.id);
                return {
                    displayName: productInfo.name,
                    count: product.count,
                    price: productInfo.price,
                    unit: productInfo.unit,
                    total: productInfo.price * product.count,
                    product_id: productInfo.id,
                };
            });
            this.total = this.user.products.reduce((prev, current) => prev + current.total, 0);
        },
        openModal() {
            this.fillOrderInfo();
            this.$refs.modal.open();
        },
        clearBasket() {
            this.$root.$data.basket.products.forEach(product => {
                product.isInBasket = false;
                product.count = 0;
            });
            this.sync();
            this.$root.$data.emitter.emit("basket-changed");
            this.$refs.modal.close();
        },
        showSuccessModal() {
            this.$refs.modal.close();
            this.$refs.successModal.open();
        },
        showWarningModal() {
            this.$refs.modal.close();
            this.$refs.warningModal.open();
        },
        acceptOrder() {
            if (!this.isValid) {
                this.showWarningModal();
                return;
            }
            this.isInProcess = true;
            this.$root.$data.emitter.emit("loading-started");
            const data = {
                name: this.user.name,
                phone: this.user.phone,
                address: this.user.address,
                comment: this.user.comment,
                products: this.user.products.map(product => ({
                    product_id: product.product_id,
                    count: product.count,
                })),
            };
            this.$http
                .post(`${ config.apiBaseUrl }order.php`, { basket: JSON.stringify(data) })
                .then(response => {
                    if (response && response.body && response.body.code == "OK") {
                        this.showSuccessModal();
                    } else {
                        this.showWarningModal();
                    }
                    this.isInProcess = false;
                    this.$root.$data.emitter.emit("loading-finished");
                }, () => {
                    this.showWarningModal();
                    this.isInProcess = false;
                    this.$root.$data.emitter.emit("loading-finished");
                });
        },
    },
};

// https://gist.github.com/realmyst/1262561
function declOfNum(number, titles) {
    const cases = [2, 0, 1, 1, 1, 2];
    return titles[(number % 100 > 4 && number % 100 < 20) ? 2 : cases[(number % 10 < 5) ? number % 10 : 5]];
}
