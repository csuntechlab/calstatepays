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
    <sub-nav/>
    <div class="graphContent">
      <div class="container">
        <div class="row">
          <aside class="col-lg-3 col-12">
            <industry-form v-on:triggerLoadingScreen="triggerLoadingScreen($event)" />
          </aside>
          <div class="col-lg-9 col-12">
            <industry-progress :loadingCheck="loadingCheck" class="card-item industry-card"/>
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
    },
    methods: {
      triggerLoadingScreen(event){
      if (event===true){
        console.log(this.loadingCheck);
        this.loadingCheck = true;
      }
      else{
        this.loadingCheck = false; 
      }
      }
      
    }
  };
</script>