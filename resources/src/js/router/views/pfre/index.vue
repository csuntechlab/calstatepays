<template>
  <div class="wrapper">
      <div class="col col-md-12">
        <card>
          <div class="col col-3">
            <pfre-form></pfre-form>
          </div>
          <div class="col col-6">
            <pfre-progress></pfre-progress>
          </div>
        </card>
      </div>
  </div>
</template>
<script>
import card from '../../../components/global/card';
import pfreForm from '../../../components/pfre/pfre-form.vue';
import pfreProgress from '../../../components/pfre/pfre-progress.vue';
import { mapGetters } from 'vuex';

export default {
  components: { card, pfreForm, pfreProgress }
}
</script>
 

