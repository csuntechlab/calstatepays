<template>
  <div>
    <div class="row">
      <h5 class="pagination-centered">Years</h5>
      <v-progress-linear :value="test" height="50" color="light-green" style="border-radius: 50px"></v-progress-linear>
      <div class="progress-footer">
        <span class="float-left">2</span>
        <span class="justify-content-center">2</span>
        <span class="float-right">2</span>
      </div>
    </div>
    <div class="row">
      <h5 class="pagination-centered">Years</h5>      
      <v-progress-linear :value="test" height="50" color="red" style="border-radius: 50px"></v-progress-linear> 
      <div class="progress-footer">
        <span class="float-left">2</span>
        <span class="justify-content-center">2</span>
        <span class="float-right">2</span>
      </div>   
    </div>
    <div class="row">
      <h5 class="pagination-centered">Years</h5>
      <v-progress-linear value="15" height="50" color="light-green" style="border-radius: 50px"></v-progress-linear>
      <div class="progress-footer">
        <span class="float-left">2</span>
        <span class="justify-content-center">2</span>
        <span class="float-right">2</span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      test: 50,
    }
  }
}
</script>

<style>
  .progress-footer {
    /* display: flex; */
    width: 95%;
  }
</style>
