<template>
  <div class="w-20 h-20 mx-3">
      <img :src="data.image" class="slide__image">
      <h3>{{data.title}}</h3>
      <h4>{{data.percentage}}</h4>
  </div>
</template>

<script>
export default {
  props: ['data'],

}
</script>

<style>

.slide__image {
  width: 10rem;
  height: 10rem;
  display: flex;
}
</style>

