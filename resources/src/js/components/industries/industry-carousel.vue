<template>
  <div>
    <carousel :navigationEnabled="true" :perPage=3 class="industry-carousel" :navigationClickTargetSize=20>
      <slide  v-for="(industry,index) in industries" :key="index" class="industry-carousel mx-1" v-bind:style="{ backgroundImage: 'url(' + industry.image + ')' }">
        <industry-carousel-card :data="industry" class="industry-carousel-card"></industry-carousel-card> 
      </slide>
    </carousel>
    <br>
  </div>
</template>

<script>
import { Carousel, Slide } from 'vue-carousel';
import industryCarouselCard from './industry-carousel-card';
import { mapGetters } from 'vuex';

export default {
  data() {
    return {
      industries: [
        {
          title: "Food",
          percentage: 50,
          rank: 1,
          image: "https://i.gyazo.com/86f0d4d90da4d7495d3c2c7303aeee5c.jpg"
        },
        {
          title: "Education",
          percentage: 25,
          rank: 2,
          image: "https://i.gyazo.com/8424987981d698cbb018287201ea2fc8.jpg"
        },
        {
          title: "Medicine",
          percentage: 20,
          rank: 3,
          image: "https://i.gyazo.com/5c726f14961f864bf8857676c4a29e63.jpg"
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

  computed: {
    ...mapGetters([ 'industries'])
  },

  components: {
    industryCarouselCard,
    Carousel,
    Slide
  }
}
</script>


