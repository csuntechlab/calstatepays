<template>
  <div class="industry-filter">
    <div class="info-wrapper" v-bind:style="{ backgroundImage: 'linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(' + industry.image + ')', borderRadius: '1rem', backgroundSize: 'cover' }">
        <p class="text-white h4 industry-info">{{ industry.percentage }}%</p>
        <h4 v-if="industry" class="text-white h6">{{ industry.title }}</h4>
    </div>
  </div>
</template>

<script>
export default {
  props: ['industry'],

}
</script>

