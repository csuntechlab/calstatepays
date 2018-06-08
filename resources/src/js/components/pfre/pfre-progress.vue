<template>
  <div class="progress-wrapper">
    <div class="row">
      <div class="col-9">
        <h5 class="text-center">Years</h5>
        <v-progress-linear class="pfre-bar progress-median" :value="(pfreData.years.actual/ pfreData.years.end) * 100" height="45" color="pfre-year"></v-progress-linear>
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
      <div class="col-3">
        <pfre-info infoKey="timeToDegree">Information regarding Time to Degree Displayed Here.</pfre-info>
      </div>
    </div>
    <div class="row">
      <div class="col-9">
        <h5 class="text-center">Earnings</h5>      
        <v-progress-linear class="pfre-bar progress-median" :value="(pfreData.earnings.actual/pfreData.earnings.maximum) * 100" height="45" color="pfre-earnings"></v-progress-linear> 
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
      <div class="col-3">
        <pfre-info infoKey="earnings">You're gonna make so much money, like so much.</pfre-info>
      </div>
    </div>
    <div class="row">
      <div class="col-9">
        <h5 class="text-center">Return On Investment</h5>
        <v-progress-linear class="pfre-bar progress-median" :value="((pfreData.returnOnInvestment.actual * 100) / (pfreData.returnOnInvestment.maximum * 100)) * 100" height="45" color="pfre-fre"></v-progress-linear>
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
          <p class="font-weight-bold mb-0 text-center">FRE - Financial Return on Education: {{pfreData.returnOnInvestment.actual | percentage}}</p>
        </div>
      </div>
      <div class="col-3">
        <pfre-info infoKey="return">Tell your Financial Advisor he's no longer needed.</pfre-info>
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