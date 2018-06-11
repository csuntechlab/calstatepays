<template>
    <div>
        <div v-for="(industry, index) in industries.slice(0,3)" :key="index"> 
            <industry-carousel-card :industry="industry" class="industry-carousel-card__mobile" v-bind:style="{ backgroundImage: 'url(' + industry.image + ')' }"></industry-carousel-card>
        </div>
    </div>
</template>

<script>
import industryCarouselCard from './industry-carousel-card';
    export default {
        props: ['industries'],

        components: {
            industryCarouselCard,
        }
    }
</script>