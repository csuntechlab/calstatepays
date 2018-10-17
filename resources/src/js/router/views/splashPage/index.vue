<template>
<div>
<csu-data-img-banner>
      <h3 class="CSUDataImgBanner__dataTitle" slot="title">
        <span>Financial Return on Education</span>
      </h3>
      <p class="CSUDataImgBanner__dataCopy" slot="copy">
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatum asperiores omnis voluptate animi voluptatem nihil, laboriosam mollitia temporibus cumque. Nostrum itaque rem cum minima, dignissimos.
      </p>
    </csu-data-img-banner>
    <sub-nav v-if="isDesktop"/>
    <sub-nav-mobile v-else/>
    <div class="splashPage">       
            Coming soon
    </div> 
</div>   
</template>
<script>
import csuDataImgBanner from "../../../components/global/csu-data-img-banner";
import subNav from "../../../components/global/sub-nav.vue";
import subNavMobile from "../../../components/global/sub-nav-mobile.vue";

export default {
  data() {
      return {
        isDesktop: true
      };
    },
    components:{
          csuDataImgBanner,
          subNav,
          subNavMobile
    },
    methods: {
      getWindowWidth(event) {
				this.windowWidth = document.documentElement.clientWidth;
				this.windowWidth < 992
					? ((this.isDesktop = false), (this.isMobile = true))
					: ((this.isDesktop = true), (this.isMobile = false));
			}
    },
    mounted() {
      this.$nextTick(function () {
				window.addEventListener("resize", this.getWindowWidth);
				this.getWindowWidth();
			});
    },
    beforeDestroy() {
			window.removeEventListener("resize", this.getWindowWidth);
		},
};
</script>

