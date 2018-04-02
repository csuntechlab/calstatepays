<template>
  <div class="container">
    <carousel :navigationEnabled="true" :perPage=3 class="industry-carousel">
      <slide  v-for="(industry,index) in industries" :key="index" class="industry-carousel mx-2" v-bind:style="{ backgroundImage: 'url(' + industry.image + ')' }">
        <industry-carousel-card :data="industry"></industry-carousel-card> 
      </slide>
    </carousel>
    <br>
  </div>
</template>

<script>
import { Carousel, Slide } from 'vue-carousel';
import industryCarouselCard from './industry-carousel-card';

export default {
  data() {
    return {
      industries: [
        {
          title: "Tech",
          percentage: 50,
          rank: 1,
          image: "https://i.gyazo.com/86f0d4d90da4d7495d3c2c7303aeee5c.jpg"
        },
        {
          title: "Retail",
          percentage: 25,
          rank: 2,
          image: "https://i.gyazo.com/86f0d4d90da4d7495d3c2c7303aeee5c.jpg"
        },
        {
          title: "Med",
          percentage: 20,
          rank: 3,
          image: "https://i.gyazo.com/86f0d4d90da4d7495d3c2c7303aeee5c.jpg"
        },
        {
          title: "Chem",
          percentage: 5,
          rank: 4,
          image: "https://i.gyazo.com/86f0d4d90da4d7495d3c2c7303aeee5c.jpg"
        },
        {
          title: "Plumbing",
          percentage: 5,
          rank: 4,
          image: "https://i.gyazo.com/86f0d4d90da4d7495d3c2c7303aeee5c.jpg"
        },
        {
          title: "Water",
          percentage: 5,
          rank: 4,
          image: "https://i.gyazo.com/86f0d4d90da4d7495d3c2c7303aeee5c.jpg"
        },
        {
          title: "Food",
          percentage: 5,
          rank: 4,
          image: "https://i.gyazo.com/86f0d4d90da4d7495d3c2c7303aeee5c.jpg"
        },
        {
          title: "Electric",
          percentage: 5,
          rank: 4,
          image: "https://i.gyazo.com/86f0d4d90da4d7495d3c2c7303aeee5c.jpg"
        },
        {
          title: "Air",
          percentage: 5,
          rank: 4,
          image: "https://i.gyazo.com/86f0d4d90da4d7495d3c2c7303aeee5c.jpg"
        }
      ]
    }
  },
  components: {
    industryCarouselCard,
    Carousel,
    Slide
  }
}
</script>

<style>
.industry-carousel {
  background-position: center;
  background-size: contain;
  height: 10em;
}
</style>
