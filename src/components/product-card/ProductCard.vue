<template>
    <div v-bind:class="['product-card', hasInStore ? '' : 'inactive']">
        <div class="product-card__title">{{item.name}} <span class="product-card__price">{{item.price}} BYN / {{item.unit}}</span></div>
        <div class="product-card__controls">
            <button type="button"
                    :disabled="minusDisabled"
                    class="product-card__btn product-card__btn-minus"
                    v-on:click="decrementCount">
                    <icon name="minus"></icon>
            </button>
            <input v-model="count" type="number" min="0" class="product-card__count-input" v-on:change="validate">
            <button type="button"
                    :disabled="plusDisabled"
                    class="product-card__btn product-card__btn-plus"
                    v-on:click="incrementCount">
                <icon name="plus"></icon>
            </button>
            <span v-bind:class="['product-card__order-info', (minusDisabled && hasInStore) ? 'not-visible' : '']">
                <span v-if="!hasInStore">Нет на складе</span>
                <span v-if="hasInStore">{{count}}{{item.unit}}: <b>{{total}} BYN</b></span>
            </span>
            <button type="button"
                    class="product-card__btn product-card__btn-add"
                    v-on:click="syncToBasket"
                    :disabled="!hasInStore">{{ isInBasket ? "Удалить" : "В корзину"}}</button>
        </div>
        <div class="product-card__description">{{item.description}}</div>
        <img v-bind:src="imagesBase + item.image_path"
             v-bind:srcset="imagesBase + item.image_path + ' 1x, ' + imagesBase + item.image_path.replace('.', '@2x.') + ' 2x'"
             v-bind:alt="item.name"
             class="product-card__image">
    </div>
</template>

<script src="./product-card.js"></script>

<style lang="scss">
@import './product-card.scss';

</style>
