<template>
    <div v-bind:class="['full-viewport', isLoading && 'visible']">
        <div class="container">
            <div class="icecream">
                <div class="colors"></div>
            </div>
            <div class="stick"></div>
        </div>
    </div>
</template>

<script src="./spinner.js"></script>

<style lang="scss" scoped>
@import './spinner.scss';

</style>
