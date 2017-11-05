<template>
    <div v-bind:class="['basket', isVisible && 'visible']">
        <p class="basket__info">
            В корзине {{itemsCount}} на сумму <br>
            <b>{{itemsPrice}} BYN</b>
        </p>
        <button class="basket__button" v-on:click="openModal">Оформить заказ</button>

        <sweet-modal title="Оформление заказа" ref="modal">
            <h4>Выбранные десерты:</h4>
            <ol class="basket__items-list">
                <li v-for="(item,i) in user.products" v-bind:key="i">
                    «{{item.displayName}}» <span class="basket__item-info">{{item.count}} {{item.unit}} × {{item.price}} BYN = <b>{{item.total}} BYN</b></span>
                </li>
            </ol>
            <p><b>К оплате:</b> {{total}} BYN*</p>
            <p class="basket__popup-note">указанная сумма к оплате является приблизительной, реальная сумма рассчитывается по массе расфасованного продукта (фасовка — 800–950 грамм)</p>
            <p class="basket__popup-note">при заказе от 3 кг — скидка 7%</p>
            <hr>
            <div class="basket__input-group">
                <label>Ваше имя*:</label>
                <input v-model="user.name">
            </div>
            <div class="basket__input-group">
                <label>Ваш телефон*:</label>
                <input v-model="user.phone" v-mask="'+375 99 999-99-99'">
            </div>
            <div class="basket__input-group">
                <label>Ваш адрес:</label>
                <textarea v-model="user.address"></textarea>
            </div>
            <div class="basket__input-group">
                <label>Комментарий к заказу:</label>
                <textarea v-model="user.comment"></textarea>
            </div>
            <div class="basket__popup-controls">
                <button type="button" :disabled="!isValid || isInProcess" class="basket__accept-button basket__button" v-on:click="acceptOrder">
                    <icon name="refresh" spin v-if="isInProcess"></icon> Заказать
                </button>
                <button type="button" class="basket__clear-button basket__button" v-on:click="clearBasket">Очистить корзину</button>
            </div>
        </sweet-modal>

        <sweet-modal icon="success" ref="successModal" v-on:close="clearBasket">
            Спасибо, Ваш заказ принят!<br>
            Скоро по указанному телефону<br>{{user.phone}}<br> с Вами свяжется менеджер.
        </sweet-modal>

        <sweet-modal icon="warning" ref="warningModal">
            При обработке заказа произошла ошибка.<br>
            Попробуйте повторить отправку заказа или свяжитесь с нами по телефонам, указанным на странице <router-link to="/contacts">Контакты</router-link>.
        </sweet-modal>
    </div>
</template>

<script src="./basket.js"></script>

<style lang="scss">
@import "./basket.scss";
</style>
