<template>
    <div>
        <div v-if="form.educationLevel == 'allDegrees'">
            <h5 class="font-weight-bold pb-2">Graduation Level: </h5>            
            <div class="legend-oxford m-0"></div><p class="ml-4">Some College</p>
            <div class="legend-gold m-0"></div><p class="ml-4">Bachelor's Degree</p>
            <div class="legend-green m-0"></div><p class="ml-4">Post Bacc Degree</p>
        </div>
        <div v-else>
            <h5 class="font-weight-bold pb-2">Percentile: </h5>
            <div class="legend-green m-0"></div><p class="ml-4">75th Percentile</p>
            <div class="legend-gold m-0"></div><p class="ml-4">50th Percentile</p>
            <div class="legend-oxford m-0"></div><p class="ml-4">25th Percentile</p>
        </div>
    </div>
</template>
<script>
export default {
    props: ['form'],
    data() {
        return {
            isAll: true,
        }
    }
}
</script>
