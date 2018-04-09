<template>
  <div class="wrapper">
      <div class="col col-md-12">
        <card class="my-4">
          <div class="col col-3">
            <pfre-form></pfre-form>
          </div>
          <div class="col col-10 offset-md-1">
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
  computed: {
    ...mapGetters([
      'progressPercentage'
    ]),
  },
  components: { card, pfreForm, pfreProgress }
}
</script>
 

