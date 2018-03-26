<template>
  <div class="info">
      <h4 style="color: white">{{data.title}}</h4>
      <h4 style="color: white">{{data.percentage}}%</h4>
  </div>
</template>

<script>
export default {
  props: ['data'],

}
</script>

<style>
.info {
  color: white;
  margin-top: 20%;
}
</style>

