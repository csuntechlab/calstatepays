<template>
  <div>
    <csu-data-img-banner>
      <h2 class="CSUDataImgBanner__dataTitle" slot="title">
        <span>Top Industries by Major</span>
      </h2>
      <p class="CSUDataImgBanner__dataCopy" slot="copy">
        Different majors lead to jobs in different industries. Select a major and find out where CSU students work, and what they earn, five years after they leave.
      </p>
    </csu-data-img-banner>
    <sub-nav/>
    <div class="graphContent">
      <div class="container">
        <div class="row pt-md-2">
          <aside class="col-lg-3 col-12">
            <industry-form />
          </aside>
          <div class="col-lg-9 col-12">
            <industry-progress class="bar-graph-card mt-md-3 mt-lg-0"/>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import csuDataImgBanner from '../../../components/global/csu-data-img-banner';
import subNav from "../../../components/global/sub-nav.vue";
import industryProgress from "../../../components/industries/industry-progress.vue";
import industryForm from "../../../components/industries/industry-form.vue"
export default {
    data(){
      return {
        loadingCheck: false
      }
    },
    components: {
      csuDataImgBanner,
      industryProgress,
      industryForm,
      subNav
    }
  };
</script>