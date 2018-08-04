<template>
  <div class="row wrapper graph-content card-padding">
    <csu-data-img-banner>
      <h3 class="CSUDataImgBanner__dataTitle" slot="title">
        <span>Industries</span>
      </h3>
      <p class="CSUDataImgBanner__dataCopy" slot="copy">
        Integer enim est, accumsan eget lobortis eget, pulvinar nec mauris. Nunc nec neque laoreet, consectetur odio et, fringilla
        metus. Etiam eu massa nec lacus hendrerit hendrerit sit amet quis quam.
      </p>
    </csu-data-img-banner>
    <sub-nav/>
    <div class="col-lg-3 col-xs-12">
      <industry-form class="my-2 csu-card__form" />
    </div>
    <div class="col-lg-9 col-xs-12 mb-5">
      <industry-progress class="my-2 card-item industry-card" />
    </div>
  </div>
</template>

<script>
  import csuDataImgBanner from '../../../components/global/csu-data-img-banner';
  import subNav from "../../../components/global/sub-nav.vue"
  import industryProgress from "../../../components/industries/industry-progress.vue";
  import industryForm from "../../../components/industries/industry-form.vue"

  export default {
    components: {
      csuDataImgBanner,
      industryProgress,
      industryForm,
      subNav
    }
  };
</script>