<template>
  <div>
    <div class="hero" id="main">

        <div class="hero__carousel">
            <slider animation="fade" :interval="5000">
                <slider-item v-for="index in [1, 2, 3, 4]" :key="index">
                    <div class="hero__carousel-slide" v-bind:class="'slide-' + index"></div>
                </slider-item>
            </slider>
        </div>

        <div class="hero__wrapper">
          <div class="hero__container">
              <h1 class="hero__title">Пьемонт</h1>
              <p class="hero__subtitle">Наслаждайтесь ощущениями сегодня!</p>
          </div>
        </div>
    </div>

    <production></production>
  </div>

</template>

<script src="./hero.js"></script>

<style lang="scss">
@import './hero.scss';

</style>
