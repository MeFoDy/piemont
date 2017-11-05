import Inputmask from "inputmask";

const inputmaskPlugin = {
    install: function(Vue) {
        Vue.directive("mask", {
            bind: function(el, binding) {
                Inputmask(binding.value).mask(el);
            },
        });
    },
};

export default inputmaskPlugin;
