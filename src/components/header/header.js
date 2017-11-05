export default {
    name: "PiemontHeader",
    data() {
        return {
            isNavigationVisible: false,
        };
    },
    methods: {
        toggleNavigation() {
            this.isNavigationVisible = !this.isNavigationVisible;
        },
        hideNavigation() {
            $(this.$el).find("#header__nav-toggler").click();
        },
    },
};
