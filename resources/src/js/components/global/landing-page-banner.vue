<template>
    <div class='landing-page-carousel__slide'>
        <slot name="header" class="landing-page-banner__header">
            Banner Header
        </slot>
        <slot class="landing-page-carousel__text">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vitae lacus dolor. Etiam accumsan rhoncus ultrices. Mauris
            nec efficitur quam.
        </slot>
    </div>
</template>