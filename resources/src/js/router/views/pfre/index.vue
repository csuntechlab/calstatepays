<template>
  <div class="row wrapper graph-content card-padding">
    <csu-data-img-banner>
      <h3 class="CSUDataImgBanner__dataTitle" slot="title">
        <span>Financial Return on Education</span>
      </h3>
      <p class="CSUDataImgBanner__dataCopy" slot="copy">
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatum asperiores omnis voluptate animi voluptatem nihil, laboriosam
        mollitia temporibus cumque. Nostrum itaque rem cum minima, dignissimos pariatur delectus ad maiores eius?
      </p>
    </csu-data-img-banner>
    <sub-nav/>
    <div class="col col-12 col-md-4 col-lg-3 pr-md-0 pr-lg-3">
      <card class="container row csu-card__form">
        <div>
          <pfre-form></pfre-form>
        </div>
      </card>
    </div>
    <div class="col col-12 col-md-8 col-lg-9">
      <card class="container row csu-card">
        <div class="container-fluid p-0">
          <div class="row-fluid">
            <pfre-progress></pfre-progress>
          </div>
        </div>
      </card>
    </div>
  </div>
</template>
<script>
  import csuDataImgBanner from "../../../components/global/csu-data-img-banner";
  import subNav from "../../../components/global/sub-nav.vue";
  import card from "../../../components/global/card";
  import pfreForm from "../../../components/pfre/pfre-form.vue";
  import pfreInfo from "../../../components/pfre/pfre-info.vue";
  import pfreProgress from "../../../components/pfre/pfre-progress.vue";
  import { mapGetters } from "vuex";

  export default {
    components: {
      csuDataImgBanner,
      card,
      pfreForm,
      pfreInfo,
      pfreProgress,
      subNav
    }
  };
</script>