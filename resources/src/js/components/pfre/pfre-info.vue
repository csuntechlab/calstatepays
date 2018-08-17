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
<!-- <div class="d-flex">
  <div class="position-relative row justify-content-md-start mx-2 mb-2">
    <div class="col-11 col-md-2 col-lg-4 col-xl-3 px-0 align-self-center">
      <button class="" type="button" @click="toggleInfo(infoKey)">
        <i class="fas fa-info-circle"></i>
      </button>
    </div>
    <div v-if="pfreShowInfo && pfreInfoKey == infoKey" :class="(infoKey) ? 'pfre-info--show col-11 col-md-10 col-lg-8 col-xl-9 my-2' : 'pfre-info'"> 
      <slot></slot>
    </div>
  </div> -->
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