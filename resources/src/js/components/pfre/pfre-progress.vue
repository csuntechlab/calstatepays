<template>
  <div>
    <div class="row">
      <h5 class="pagination-centered">Years</h5>
      <v-progress-linear class="pfre-bar" :value="(pfreData.years.actual/pfreData.years.end) * 100" height="45" color="light-green"></v-progress-linear>
      <div class="progress-footer col-12">
        <span class="col-4">
          <p class="float-left">{{pfreData.years.start}}</p>  
        </span>
        <span class="col-4">
          <p class="text-center">{{pfreData.years.middle}}</p>  
        </span>
        <span class="col-4">
          <p class="float-right">{{pfreData.years.end}}</p>  
        </span>
      </div>
      <div>
        <p class="font-weight-bold mb-0">Estimated time to degree: {{pfreData.years.actual}}</p>
      </div>
    </div>
    <div class="row">
      <h5 class="pagination-centered">Earnings</h5>      
      <v-progress-linear class="pfre-bar" :value="(pfreData.earnings.actual/pfreData.earnings.maximum) * 100" height="45" color="green"></v-progress-linear> 
      <div class="progress-footer">
        <span class="col-4">
          <p class="float-left">{{pfreData.earnings.minimum | currency}}</p>  
        </span>
        <span class="col-4">
          <p class="text-center">{{pfreData.earnings.average | currency}}</p>  
        </span>
        <span class="col-4">
          <p class="float-right">{{pfreData.earnings.maximum | currency}}</p>  
        </span>
      </div> 
      <div>
        <p class="font-weight-bold mb-0">Estimated Earnings 5 Years After Exit: {{pfreData.earnings.actual | currency}}</p>
      </div>  
    </div>
    <div class="row">
      <h5 class="pagination-centered">Return On Investment</h5>
      <v-progress-linear class="pfre-bar" :value="((pfreData.returnOnInvestment.actual * 100) / (pfreData.returnOnInvestment.maximum * 100)) * 100" height="45" color="light-green"></v-progress-linear>
      <div class="progress-footer">
        <span class="col-4">
          <p class="float-left">{{pfreData.returnOnInvestment.minimum | percentage}}</p>  
        </span>
        <span class="col-4">
          <p class="text-center">{{pfreData.returnOnInvestment.average | percentage}}</p>  
        </span>
        <span class="col-4">
          <p class="float-right">{{pfreData.returnOnInvestment.maximum | percentage}}</p>  
        </span>
      </div>   
      <div>
        <p class="font-weight-bold mb-0">FRE - Financial Return on Education: {{pfreData.returnOnInvestment.actual | percentage}}</p>
      </div>
    </div>
  </div>
</template>

<script>
import {currency, percentage} from '../../filters';
import { mapGetters, mapActions } from 'vuex';

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
      'fetchMockData'
    ])
  },
  filters: { percentage, currency }
}
</script>