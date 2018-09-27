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
    <div class="graphContent">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-12">
              <pfre-form/>
          </div>
          <div class="col-lg-9 col-12">
            <card class="csu-card py-3">
              <div class="container-fluid">
              <div class="row-fluid">
              <pfre-progress/>
              </div>
            </div>
          </card>
          </div>
      </div>
    </div>
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