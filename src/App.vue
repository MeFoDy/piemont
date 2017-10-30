<template>
  <div id="app">
    <piemont-header/>
    <div class="content-wrapper">
      <router-view/>
    </div>
    <piemont-footer/>
  </div>
</template>


<script>
import PiemontFooter from "@/components/footer/PiemontFooter";
import PiemontHeader from "@/components/header/PiemontHeader";

export default {
  name: "app",
  components: {
    PiemontHeader,
    PiemontFooter,
  },
};
</script>


<style lang="scss">
@import './styles/common.scss';

</style>
