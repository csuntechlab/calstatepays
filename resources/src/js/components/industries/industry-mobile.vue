<template>
    <div>
        <h5>Top Industries</h5>
        <div v-for="(industry, index) in industries.slice(0,3)" :key="index"> 
            <industry-carousel-card :industry="industry"></industry-carousel-card>
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