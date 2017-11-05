export default {
    name: "LoadingSpinner",
    data() {
        return {
            counter: 0,
        };
    },
    mounted: function() {
        this.$root.emitter.on("loading-started", () => {
            this.counter++;
        });
        this.$root.emitter.on("loading-finished", () => {
            this.counter--;
        });
    },
    computed: {
        isLoading() {
            return this.counter > 0;
        },
    },
};
