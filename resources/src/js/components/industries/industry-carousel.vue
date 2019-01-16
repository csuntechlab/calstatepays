<template>
  <div>
    <h3 class="industry-title h3 pt-4">Common Employment Sectors<br>in {{major}}</h3>
    <p class="h6 text-center pb-3">Employment 5 Years After Exit</p>
    <p v-if="!empty" class="lead pl-5 pr-5">No Employment Sector data is available for this major.</p>
    <carousel v-else :navigationEnabled="true" :perPage=3 class="industry-carousel" :navigationClickTargetSize=20 :paginationEnabled=false>
      <slide  v-for="(industry,index) in industries" :key="index" class="industry-carousel mx-1">
        <industry-carousel-card :industry="industry" class="industry-carousel-card"></industry-carousel-card>
      </slide>
      <slide></slide>
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
  props: ['industries', 'empty', 'major'],

  components: {
    industryCarouselCard,
    Carousel,
    Slide
  }
}
</script>


