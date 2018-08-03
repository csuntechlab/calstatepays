<template>
    <div>
      <sub-nav/>
	    <industry-carousel></industry-carousel>				
    </div>
</template>

<script>
import csuDataImgBanner from '../../../components/global/csu-data-img-banner';
import subNav from "../../../components/global/sub-nav.vue"
import industryCarousel from "../../../components/industries/industry-carousel.vue";

export default {
  data() {
    return {
    };
  },

  components: {
    csuDataImgBanner,
    industryCarousel,
    subNav
  }
};
</script>
