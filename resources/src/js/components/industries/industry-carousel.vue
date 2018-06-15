<template>
  <div>
    <h4 class="industry-title">Industry By Employment</h4>
    <carousel :navigationEnabled="true" :perPage=3 class="industry-carousel" :navigationClickTargetSize=20>
      <slide  v-for="(industry,index) in industries" :key="index" class="industry-carousel mx-1">
        <industry-carousel-card :industry="industry" class="industry-carousel-card"></industry-carousel-card>
      </slide>
    </carousel>
    <br>
    <br>
  </div>
</template>

<script>
import { Carousel, Slide } from 'vue-carousel';
import industryCarouselCard from './industry-carousel-card';
import { mapGetters, mapActions } from 'vuex';

export default {
  props: ['industries'],

  components: {
    industryCarouselCard,
    Carousel,
    Slide
  }
}
</script>


