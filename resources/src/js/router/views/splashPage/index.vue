<template>
<div>
  <csu-data-img-banner>
    <h3 class="CSUDataImgBanner__dataTitle" slot="title">
      <span>Financial Return on Education</span>
    </h3>
    <p class="CSUDataImgBanner__dataCopy" slot="copy">
      Education costs money and takes time. In return, it increases earnings after graduation. Financial return is an interest-rate-like number describing the monetary rewards to education that you can compare to financial investments.
    </p>
  </csu-data-img-banner>
    <sub-nav/>
    <div class="splashPage graphContent row align-items-center">
      <div class="col">
        <p>Coming soon</p>
      </div>
    </div> 
</div>   
</template>
<script>
import csuDataImgBanner from "../../../components/global/csu-data-img-banner";
import subNav from "../../../components/global/sub-nav.vue";
export default {
    components:{
      csuDataImgBanner,
      subNav,
    },
};
</script>

