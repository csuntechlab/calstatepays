<template>
  <div class="IndustryCarousel">
    <h3 class="IndustryCarousel__MajorTitle">Common Employment Sectors<br>in {{major}}</h3>
    <p class="IndustryCarousel__MajorSubTitle">Employment 5 Years After Exit</p>
    <p v-if="!empty" class="IndustryCarousel__NoIndustryMessage">No Employment Sector data is available for this major.</p>
    <carousel v-else :navigationEnabled="true" :perPage=3 class="IndustryCarousel__VueCarousel" :paginationEnabled=true>
      <slide  v-for="(industry,index) in industries" :key="index">
        <industry-carousel-card :industry="industry" class="IndustryCarousel__VueCarouselSlide"/>
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
  props: ['industries', 'empty', 'major'],

  components: {
    industryCarouselCard,
    Carousel,
    Slide
  }
}
</script>


