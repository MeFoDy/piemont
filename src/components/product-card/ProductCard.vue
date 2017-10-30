<template>
    <div class="product-card">
        <div class="product-card__title">{{item.name}}</div>
        <div class="product-card__description">{{item.description}}</div>
        <img v-bind:src="imagesBase + item.image_path" v-bind:alt="item.name" class="product-card__image">
    </div>
</template>

<script src="./product-card.js"></script>

<style lang="scss">
@import './product-card.scss';

</style>
