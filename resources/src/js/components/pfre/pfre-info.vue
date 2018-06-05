<template>
  <div class="row">
    <div class="col-11 col-md-6">
      <button class="btn-info" type="button" @click="toggleInfo(infoKey)">
        <i class="fa fa-question"></i>
      </button>
    </div>
    <div v-if="pfreShowInfo && pfreInfoKey == infoKey" :class="(infoKey) ? 'pfre-info--show col-10' : 'pfre-info'"> 
      <slot></slot>
    </div>
  </div>
</template>
<script>

import { mapActions, mapGetters } from 'vuex';
export default {
  props: ['infoKey'],
  methods: {
    ...mapActions([
      'toggleInfo'
    ]),
  },
  computed: {
    ...mapGetters([
      'pfreShowInfo',
      'pfreInfoKey'
    ])
  }
}
</script>
