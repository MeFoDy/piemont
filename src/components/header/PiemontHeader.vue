<template>
    <header class="header">
        <div class="header__logo">
            <router-link to="/" class="header__logo-link">
                <img src="/static/images/80x80.gif" alt="Piemont">
            </router-link>
        </div>
        <input type="checkbox" id="header__nav-toggler" class="header__nav-toggler-input">
        <label for="header__nav-toggler" class="header__nav-toggler" v-on:click="toggleNavigation"></label>
        <nav class="header__nav" v-touch:swipe.right="hideNavigation">
            <ul class="header__nav-items">
                <li class="header__nav-item">
                    <router-link to="/main" class="header__nav-link">Главная</router-link>
                </li>
                <li class="header__nav-item">
                    <router-link to="/about" class="header__nav-link">О компании</router-link>
                </li>
                <li class="header__nav-item">
                    <router-link to="/production" class="header__nav-link">Продукция</router-link>
                </li>
                <li class="header__nav-item">
                    <router-link to="/delivery" class="header__nav-link">Доставка</router-link>
                </li>
                <li class="header__nav-item">
                    <router-link to="/contacts" class="header__nav-link">Контакты</router-link>
                </li>
            </ul>
        </nav>
    </header>
</template>

<script src="./header.js"></script>

<style lang="scss">
    @import './header.scss';

</style>
