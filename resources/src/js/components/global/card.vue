<template>
  <div class="card col col-md-10 offset-md-1 d-flex flex-row">
    <slot></slot>
  </div>
</template>
<script>
import pfreForm from '../pfre/pfre-form.vue';
export default {
  components: { pfreForm },
}
</script>
