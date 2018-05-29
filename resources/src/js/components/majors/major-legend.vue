<template>
    <div>
        <div v-if="form.educationLevel == 'allDegrees'">
            <h5 class="font-weight-bold pb-2">Graduation Level: </h5>            
            <div class="legend-green m-0"></div><p class="ml-4">Post Bacc Degree</p>
            <div class="legend-gold m-0"></div><p class="ml-4">Bachelor's Degree</p>
            <div class="legend-oxford m-0"></div><p class="ml-4">Some College</p>
        </div>
        <div v-else-if="form.educationLevel == 'postBacc'">
            <h5 class="font-weight-bold pb-2">Percentile: </h5>
            <div class="legend-green-25 m-0"></div><p class="ml-4">25th Percentile</p>
            <div class="legend-green m-0"></div><p class="ml-4">50th Percentile</p>
            <div class="legend-green-75 m-0"></div><p class="ml-4">75th Percentile</p>
        </div>
        <div v-else-if="form.educationLevel == 'bachelors'">
            <h5 class="font-weight-bold pb-2">Percentile: </h5>
            <div class="legend-gold-25 m-0"></div><p class="ml-4">25th Percentile</p>
            <div class="legend-gold m-0"></div><p class="ml-4">50th Percentile</p>
            <div class="legend-gold-75 m-0"></div><p class="ml-4">75th Percentile</p>
        </div>
        <div v-else-if="form.educationLevel == 'someCollege'">
            <h5 class="font-weight-bold pb-2">Percentile: </h5>
            <div class="legend-oxford-25 m-0"></div><p class="ml-4">25th Percentile</p>
            <div class="legend-oxford m-0"></div><p class="ml-4">50th Percentile</p>
            <div class="legend-oxford-75 m-0"></div><p class="ml-4">75th Percentile</p>
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
