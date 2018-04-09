<template>
  <div>
    <div class="row">
      <h5 class="pagination-centered">Years</h5>
      <v-progress-linear class="pfre-bar" :value="(years.actual/years.end) * 100" height="50" color="light-green"></v-progress-linear>
      <div class="progress-footer col-12">
        <span class="col-4">
          <p class="float-left">{{years.start}}</p>  
        </span>
        <span class="col-4">
          <p class="text-center">{{years.middle}}</p>  
        </span>
        <span class="col-4">
          <p class="float-right">{{years.end}}</p>  
        </span>
      </div>
      <div>
        <p class="font-weight-bold">Estimated time to degree: {{years.actual}}</p>
      </div>
    </div>
    <div class="row">
      <h5 class="pagination-centered">Earnings</h5>      
      <v-progress-linear class="pfre-bar" :value="(earnings.actual/earnings.maximum) * 100" height="50" color="red"></v-progress-linear> 
      <div class="progress-footer">
        <span class="col-4">
          <p class="float-left">{{earnings.minimum | currency}}</p>  
        </span>
        <span class="col-4">
          <p class="text-center">{{earnings.average | currency}}</p>  
        </span>
        <span class="col-4">
          <p class="float-right">{{earnings.maximum | currency}}</p>  
        </span>
      </div> 
      <div>
        <p class="font-weight-bold">Estimated Earnings 5 Years After Exit: {{earnings.actual | currency}}</p>
      </div>  
    </div>
    <div class="row">
      <h5 class="pagination-centered">Return On Investment</h5>
      <v-progress-linear class="pfre-bar" value="15" height="50" color="light-green"></v-progress-linear>
      <div class="progress-footer">
        <span class="col-4">
          <p class="float-left">{{returnOnInvestment.minimum | percentage}}</p>  
        </span>
        <span class="col-4">
          <p class="text-center">{{returnOnInvestment.average | percentage}}</p>  
        </span>
        <span class="col-4">
          <p class="float-right">{{returnOnInvestment.maximum | percentage}}</p>  
        </span>
      </div>   
      <div>
        <p class="font-weight-bold">FRE - Financial Return on Education: {{returnOnInvestment.actual | percentage}}</p>
      </div>
    </div>
  </div>
</template>

<script>
import {currency, percentage} from '../../filters';
import { mapGetters } from 'vuex';

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
       'years',
       'earnings',
       'returnOnInvestment'
    ]),
  },
  filters: {percentage, currency}
}
</script>