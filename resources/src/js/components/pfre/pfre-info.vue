<template>
<div v-if ="pfreShowInfo && pfreInfoKey == infoKey" class="pfre-info__wrapper">
    <div class=""> 
      <button class="" type="button" @click="toggleInfo(infoKey);">
        <i class="fas fa-info-circle"></i>
      </button>
    </div>
    <div v-if="pfreShowInfo && pfreInfoKey == infoKey" :class="(infoKey) ? 'pfre-info--show' : 'pfre-info'"> 
      <slot></slot>
    </div>

  </div>
     <div v-else class="">
       <div class="">
        <button class="" type="button" @click="toggleInfo(infoKey)">
          <i class="fas fa-info-circle"></i>
        </button>
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

</script>


     
</template>