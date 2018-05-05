<template>
  <div>
    <carousel :navigationEnabled="true" :perPage=3 class="industry-carousel" :navigationClickTargetSize=20>
      <slide  v-for="(industry,index) in selectedIndustries" :key="index" class="industry-carousel mx-1" v-bind:style="{ backgroundImage: 'url(' + industry.image + ')' }">
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
  props: ['form'],
  computed: {
    ...mapGetters([ 'industries']),
    selectedIndustries(){
      if(this.form.majorId){
        return this.industries.filter((industry) => industry.majorId == this.form.majorId);
      }
      return []
    }
  },

  methods: {
      ...mapActions([
          'fetchIndustryImages'
      ]),
  },
  components: {
    industryCarouselCard,
    Carousel,
    Slide
  }
}
</script>


