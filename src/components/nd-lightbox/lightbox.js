export default {
    props: {
        images: {
            type: Array,
            required: true,
        },
        image_class: {
            type: String,
        },
        album_class: {
            type: String,
        },
        options: {
            type: Object,
            required: false,
        },
    },
    name: "NdLightbox",
    mounted() {
        try {
            require("simplelightbox");
            $(this.$el).find(".nd-lightbox-gallery a").simpleLightbox(this.options);
        } catch (e) { }
    },
};
