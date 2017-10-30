import { Slider, SliderItem } from "vue-easy-slider";
import Production from "@/components/production/Production.vue";

export default {
    name: "Hero",
    data() {
        return {
            msg: "Test",
        };
    },
    components: {
        Slider,
        SliderItem,
        Production,
    },
};
