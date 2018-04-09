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
          <p class="float-left">{{earnings.minimum}}</p>  
        </span>
        <span class="col-4">
          <p class="text-center">{{earnings.average}}</p>  
        </span>
        <span class="col-4">
          <p class="float-right">{{earnings.maximum}}</p>  
        </span>
      </div> 
      <div>
        <p class="font-weight-bold">Estimated Earnings 5 Years After Exit: {{earnings.actual}}</p>
      </div>  
    </div>
    <div class="row">
      <h5 class="pagination-centered">Return On Investment</h5>
      <v-progress-linear class="pfre-bar" value="15" height="50" color="light-green"></v-progress-linear>
      <div class="progress-footer">
        <span class="col-4">
          <p class="float-left">{{returnOnInvestment.minimum}}</p>  
        </span>
        <span class="col-4">
          <p class="text-center">{{returnOnInvestment.average}}</p>  
        </span>
        <span class="col-4">
          <p class="float-right">{{returnOnInvestment.maximum}}</p>  
        </span>
      </div>   
      <div>
        <p class="font-weight-bold">FRE - Financial Return on Education: {{returnOnInvestment.actual}}</p>
      </div>
    </div>
  </div>
</template>

<script>
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
  }
}
</script>

<style>
  .pfre-bar {
    border-radius: 50px;
    margin: 0;
  }
  .progress-footer {
    display: flex;
    width: 95%;
  }
  .center {
   margin: 0 auto !important;
   float: none !important;
}
</style>
