<template>
    <div>
      <sub-nav/>
	    <industry-carousel></industry-carousel>				
    </div>
</template>

<script>
import subNav from "../../../components/global/sub-nav.vue"
import industryCarousel from "../../../components/industries/industry-carousel.vue";

export default {
  data() {
    return {
    };
  },

  components: {
    industryCarousel,
    subNav
  }
};
</script>
