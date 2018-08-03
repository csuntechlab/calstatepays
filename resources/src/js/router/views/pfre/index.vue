<template>
  <div class="row wrapper graph-content card-padding">
      <div  class="col col-12 col-md-4 col-lg-3 pr-md-0 pr-lg-3">
        <card class="container row">
            <div>
            <pfre-form></pfre-form>
            </div> 
         </card>
      </div>
      <div class="col col-12 col-md-8 col-lg-9">
         <card class="container row">
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
 

