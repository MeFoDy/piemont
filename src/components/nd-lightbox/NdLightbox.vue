<template>
    <div>
        <div class="nd-lightbox-gallery" :class="album_class">
            <a :href="image.src" v-for="image,key in images">
                <img :src="image.thumb" alt="" :title="image.title" :class="image_class" />
            </a>
        </div>
    </div>
</template>

<script src="./lightbox.js"></script>

<style lang="scss">
@import './lightbox.scss';

</style>
