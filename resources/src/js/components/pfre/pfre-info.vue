<template>
  <div class="row justify-content-md-start mx-2">
    <div class="col-11 col-md-2 col-lg-4 col-xl-3 px-0 align-self-center">
      <button class="btn-info" type="button" @click="toggleInfo(infoKey)">
        <i class="fa fa-question"></i>
      </button>
    </div>
    <div v-if="pfreShowInfo && pfreInfoKey == infoKey" :class="(infoKey) ? 'pfre-info--show col-11 col-md-10 col-lg-8 col-xl-9 my-2' : 'pfre-info'"> 
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
