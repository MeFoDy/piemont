import NdLightbox from "@/components/nd-lightbox/NdLightbox.vue";
import Partners from "@/components/partners/Partners.vue";

export default {
    name: "About",
    components: {
        NdLightbox,
        Partners,
    },
    data() {
        return {
            images: {
                sertificate: [
                    {
                        thumb: "/static/images/documents/sertificate@thumb.jpg",
                        src: "/static/images/documents/sertificate.jpg",
                        title: "Сертификат продукции собственного производства",
                    },
                ],
                declaration: [
                    {
                        thumb: "/static/images/documents/declaration@thumb.jpg",
                        src: "/static/images/documents/declaration.jpg",
                        title: "Декларация о соответствии",
                    },
                ],
                registration: [
                    {
                        thumb: "/static/images/documents/registration@thumb.jpg",
                        src: "/static/images/documents/registration.jpg",
                        title: "Свидетельство о государственной регистрации юридического лица",
                    },
                ],
            },
            lightboxOptions: {
                captionPosition: "bottom",
                loop: false,
                history: false,
                disableScroll: true,
                captions: false,
            },
        };
    },
};
