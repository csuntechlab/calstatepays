<template>
  <div class="row wrapper graph-content card-padding">
      <div class="col-12">
        <card class="container row align-items-center">
          <div class="text-center col-12">
            <h2 class="pfre__heading">Financial Return on Education</h2>
          </div>
          <div class="container-fluid p-0">
            <div class="row">
              <div class="col-12 col-md-4 col-lg-3 align-self-center">
                <pfre-form></pfre-form>
              </div>
              <div class="col-12 col-md-8 col-lg-9 align-self-center">
                <pfre-progress></pfre-progress>
              </div>
            </div>
          </div>  
        </card>
      </div>
  </div>
</template>
<script>
import card from '../../../components/global/card';
import pfreForm from '../../../components/pfre/pfre-form.vue';
import pfreInfo from '../../../components/pfre/pfre-info.vue';
import pfreProgress from '../../../components/pfre/pfre-progress.vue';
import { mapGetters } from 'vuex';

export default {
  components: { 
    card, 
    pfreForm, 
    pfreInfo, 
    pfreProgress
  }
}
</script>
 

