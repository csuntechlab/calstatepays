<template>
  <div class="wrapper">
      <div class="col col-md-12">
        <card class="my-4">
          <div class="col col-3">
            <pfre-form></pfre-form>
          </div>
          <div class="col col-10 offset-md-1">
            <img src="img/pfregraph.png" alt="">
          </div>
        </card>
      </div>
  </div>
</template>
<script>
import card from '../../../components/global/card';
import pfreForm from '../../../components/pfre/pfre-form.vue';

export default {
  components: { card, pfreForm }
}
</script>
 

