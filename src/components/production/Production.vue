<template>
     <div class="production" id="production">
        <div class="production__wrapper">
            <h2 class="title production__title">Продукция</h2>
            <div v-for="(category, i) in categories"
                :key="i"
                v-bind:class="['production__block']">
                <h3 class="production__subtitle">{{category.name}}</h3>
                <p class="production__description">{{category.description}}</p>
                <div class="production__items">
                    <product-card v-for="(product, j) in category.products" :key="j" :item="product"></product-card>
                </div>
            </div>
        </div>
    </div>
</template>

<script src="./production.js"></script>

<style lang="scss">
@import './production.scss';

</style>
