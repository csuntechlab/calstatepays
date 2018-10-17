<template>
  <div>
    <csu-data-img-banner>
      <h3 class="CSUDataImgBanner__dataTitle" slot="title">
        <span>Top Industries by Major</span>
      </h3>
      <p class="CSUDataImgBanner__dataCopy" slot="copy">
        Integer enim est, accumsan eget lobortis eget, pulvinar nec mauris. Nunc nec neque laoreet, consectetur odio et, fringilla
        metus. Etiam eu massa nec lacus hendrerit hendrerit sit amet quis quam.
      </p>
    </csu-data-img-banner>
    <sub-nav v-if="isDesktop"/>
    <sub-nav-mobile v-else/>
    <div class="graphContent">
      <div class="container">
        <div class="row">
          <aside class="col-lg-3 col-12">
            <industry-form/>
          </aside>
          <div class="col-lg-9 col-12">
            <industry-progress class="card-item industry-card"/>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import csuDataImgBanner from '../../../components/global/csu-data-img-banner';
import subNav from "../../../components/global/sub-nav.vue";
import subNavMobile from "../../../components/global/sub-nav-mobile.vue";
import industryProgress from "../../../components/industries/industry-progress.vue";
import industryForm from "../../../components/industries/industry-form.vue"

export default {
    data() {
      return {
        isDesktop: true
      };
    },
    components: {
      csuDataImgBanner,
      industryProgress,
      industryForm,
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