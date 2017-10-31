<template>
  <div id="app">
    <piemont-header/>
    <div class="content-wrapper">
      <router-view/>
    </div>
    <piemont-footer/>
    <piemont-basket/>
  </div>
</template>


<script>
import PiemontBasket from "@/components/basket/PiemontBasket";
import PiemontFooter from "@/components/footer/PiemontFooter";
import PiemontHeader from "@/components/header/PiemontHeader";

export default {
  name: "app",
  components: {
    PiemontBasket,
    PiemontHeader,
    PiemontFooter,
  },
};
</script>


<style lang="scss">
@import './styles/common.scss';

</style>
