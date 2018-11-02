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
    <sub-nav/>
    <div class="splashPage">       
            <p>Coming soon</p>
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

