<template>
  <div class="info-wrapper">
      <p class="text-white h4 industry-info">{{ industry.percentage }}%</p>
      <p v-if="industry" style="text-white h6 industry-info">{{ industry.title }}</p>
  </div>
</template>

<script>
export default {
  props: ['industry'],

}
</script>

