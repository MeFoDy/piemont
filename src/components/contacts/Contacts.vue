<template>
    <div class="contacts" id="contacts">
        <div class="contacts__wrapper">
            <h2 class="title contacts__title">Наши контакты</h2>
            <div class="contacts__info">
                <div class="contacts__block">
                    <icon name="home"></icon>
                    <p>222202, ул. Центральная, 30 “Б”, д. Динаровка,<br> Озерицко-Слободской с/с, Смолевичский район,<br>Минская область,
                        Республика Беларусь.</p>
                </div>
                <div class="contacts__block">
                    <icon name="phone"></icon>
                    <p>
                        <a class="contacts__link" href="tel:+375296867673">+375 29 686-76-73</a><br>
                        <a class="contacts__link" href="tel:+375298348180">+375 29 834-81-80</a><br>
                    </p>
                </div>
                <div class="contacts__block">
                    <icon name="fax"></icon>
                    <p>Факс: 801776 228 44</p>
                </div>
                <div class="contacts__block">
                    <icon name="user"></icon>
                    <p>УНП 690666542</p>
                </div>
                <div class="contacts__block">
                    <icon name="envelope-o"></icon>
                    <p><a class="contacts__link" href="mailto:office@melatto.com">office@melatto.com</a></p>
                </div>
            </div>
        </div>
        <yandex-map
            :coords="[54.026373, 27.968476]"
            zoom="16"
            :behaviors="['default']"
            :controls="['smallMapDefaultSet']"
            map-type="map">
            <ymap-marker
                marker-type="placemark"
                :coords="[54.026373, 27.968476]"
                hint-content="Офис компании Мелатто"
                :balloon="{header: 'Мелатто', body: 'Офис компании', footer: '<a href=\'tel:+375296867673\'>8 029 686-76-73</a><br><a href=\'tel:+375298348180\'>8 029 834-81-80</a>'}"
                :icon="{content: 'Мелатто'}"
                cluster-name="1"></ymap-marker>
        </yandex-map>
        <!-- <div class="contacts__form">
            <label for="" class="contacts__label">Ваше имя
                <input type="text" class="contacts__input">
            </label>
            <label for="" class="contacts__label">Ваш телефон
                <input type="text" class="contacts__input">
            </label>
            <label for="" class="contacts__label">Ваш e-mail
                <input type="text" class="contacts__input">
            </label>
            <button class="contacts__form-button" type="button">Заказать обратный звонок</button>
        </div> -->
    </div>
</template>

<script src"./contacts.js"></script>

<style lang="scss">
@import './contacts.scss';

</style>
