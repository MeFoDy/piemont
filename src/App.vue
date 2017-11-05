<template>
  <div id="app">
    <loading-spinner/>
    <piemont-header/>
    <div class="content-wrapper">
      <router-view/>
    </div>
    <piemont-footer/>
    <piemont-basket/>
  </div>
</template>


<script>
import LoadingSpinner from "@/components/loading-spinner/LoadingSpinner";
import PiemontBasket from "@/components/basket/PiemontBasket";
import PiemontFooter from "@/components/footer/PiemontFooter";
import PiemontHeader from "@/components/header/PiemontHeader";

export default {
  name: "app",
  components: {
    LoadingSpinner,
    PiemontBasket,
    PiemontHeader,
    PiemontFooter,
  },
};
</script>


<style lang="scss">
@import './styles/common.scss';

</style>
