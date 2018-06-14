<template>
  <div class="progress-wrapper" id="progress-bar" >
    <div class="row no-gutters my-3">
      <div class="col-12 col-lg-8 col-xl-9 align-self-center">
        <h5 class="text-center">Years</h5>
        <v-progress-linear class="pfre-bar progress-median" :value="(pfreData.years.actual/ pfreData.years.end) * 100" height="55" color="pfre-year"></v-progress-linear>
        <div class="progress-footer">
          <span class="col-4">
            <p class="float-left mb-0">{{pfreData.years.start}}</p>  
          </span>
          <span class="col-4">
            <p class="text-center mb-0">{{pfreData.years.middle}}</p>  
          </span>
          <span class="col-4">
            <p class="float-right mb-0">{{pfreData.years.end}}</p>  
          </span>
        </div>
        <div>
          <p class="font-weight-bold mb-0 text-center">Estimated time to degree: {{pfreData.years.actual}}</p>
        </div>
      </div>
      <div class="col-12 col-lg-4 col-xl-3 align-self-md-center">
        <pfre-info infoKey="timeToDegree">The estimated time it would take for you to complete your degree if you choose this major.</pfre-info>
      </div>
    </div>
    <div class="row no-gutters my-3">
      <div class="col-12 col-lg-8 col-xl-9 align-self-center">
        <h5 class="text-center">Earnings</h5>      
        <v-progress-linear class="pfre-bar progress-median" :value="(pfreData.earnings.actual/pfreData.earnings.maximum) * 100" height="55" color="pfre-earnings"></v-progress-linear> 
        <div class="progress-footer">
          <span class="col-4">
            <p class="float-left mb-0">{{pfreData.earnings.minimum | currency}}</p>  
          </span>
          <span class="col-4">
            <p class="text-center mb-0">{{pfreData.earnings.average | currency}}</p>  
          </span>
          <span class="col-4">
            <p class="float-right mb-0">{{pfreData.earnings.maximum | currency}}</p>  
          </span>
        </div> 
        <div>
          <p class="font-weight-bold mb-0 text-center">Estimated Earnings 5 Years After Exit: {{pfreData.earnings.actual | currency}}</p>
        </div>  
      </div>
      <div class="col-12 col-lg-4 col-xl-3 align-self-md-center">
        <pfre-info infoKey="earnings">After you successfully complete a degree and find a career, Your estimated earnings would be this. </pfre-info>
      </div>
    </div>
    <div class="row no-gutters my-3">
      <div class="col-12 col-lg-8 col-xl-9 align-self-center">
        <h5 class="text-center">Return On Investment</h5>
        <v-progress-linear class="pfre-bar progress-median" :value="((pfreData.returnOnInvestment.actual * 100) / (pfreData.returnOnInvestment.maximum * 100))" height="55" color="pfre-fre"></v-progress-linear>
        <div class="progress-footer">
          <span class="col-4">
            <p class="float-left mb-0">{{pfreData.returnOnInvestment.minimum | percentage}}</p>  
          </span>
          <span class="col-4">
            <p class="text-center mb-0">{{pfreData.returnOnInvestment.average | percentage}}</p>  
          </span>
          <span class="col-4">
            <p class="float-right mb-0">{{pfreData.returnOnInvestment.maximum | percentage}}</p>  
          </span>
        </div>   
        <div>
          <p class="font-weight-bold mb-0 text-center">FRE - Financial Return on Education: {{pfreData.returnOnInvestment.actual/100 | percentage}}</p>
        </div>
      </div>
      <div class="col-12 col-lg-4 col-xl-3 align-self-md-center">
        <pfre-info infoKey="return">Your estimated financial return on your education investment.</pfre-info>
      </div>
    </div>
  </div>
</template>

<script>
import {currency, percentage} from '../../filters';
import { mapGetters, mapActions } from 'vuex';
import pfreInfo from './pfre-info.vue';
export default {
  data() {
    return {
      userYears:{
        start: 0,
        middle: 0,
        end: 0,
        actual: 0
      },
    }
  },
  computed: {
     ...mapGetters([
       'pfreData'
    ]),
  },
  methods: {
    ...mapActions([
      'fetchFreData'
    ])
  },
  filters: { percentage, currency },
  components: { pfreInfo }
}
</script>