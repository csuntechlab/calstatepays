<template>
<div v-if ="pfreShowInfo && pfreInfoKey == infoKey" class="pfre-info__wrapper">
    <div v-if="pfreShowInfo && pfreInfoKey == infoKey" :class="(infoKey) ? 'pfre-info--show' : 'pfre-info'"> 
      <slot ></slot>
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