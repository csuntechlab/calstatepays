<template>
  <div class="info-wrapper">
      <p class="text-white h4 industry-info">{{ data.percentage }}%</p>
      <p style="text-white h6 industry-info">{{ data.title.toUpperCase() }}</p>
  </div>
</template>

<script>
export default {
  props: ['data'],

}
</script>

