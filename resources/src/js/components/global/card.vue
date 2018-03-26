<template>
  <div class="card col col-md-10 offset-md-1 d-flex flex-row">
      <div class="col col-3">
        <pfre-form></pfre-form>
      </div>
      <div class="col col-10 mx-4">
        <img src="img/pfregraph.png" alt="">
      </div>
  </div>
</template>
<script>
import pfreForm from '../pfre/pfre-form.vue';
export default {
  components: { pfreForm },
}
</script>
