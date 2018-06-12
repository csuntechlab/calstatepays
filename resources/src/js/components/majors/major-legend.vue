<template>
    <div>
        <div v-if="educationLevel == 'allDegrees'">
            <h5 v-show="windowSize > 500" class="majors-header">Graduation Level: </h5>  
            <span class="legend-mobile">
               <div class="legend-green m-0"></div><p class="ml-4">Post Bacc Degree</p>
            </span>
            <span class="legend-mobile">
                <div class="legend-gold m-0"></div><p class="ml-4">Bachelor's Degree</p>
            </span>
            <span class="legend-mobile">
               <div class="legend-oxford m-0"></div><p class="ml-4">Some College</p>
            </span>
        </div>
        <div v-else-if="educationLevel == 'someCollege'">
            <h5 class="font-weight-bold pb-2">Percentile: </h5>
            <div class="legend-oxford-75 m-0"></div><p class="ml-4">75th Percentile</p>
            <div class="legend-oxford m-0"></div><p class="ml-4">50th Percentile</p>
            <div class="legend-oxford-25 m-0"></div><p class="ml-4">25th Percentile</p>
        </div>
        <div v-else-if="educationLevel == 'bachelors'">
            <h5 class="font-weight-bold pb-2">Percentile: </h5>
            <div class="legend-gold-75 m-0"></div><p class="ml-4">75th Percentile</p>
            <div class="legend-gold m-0"></div><p class="ml-4">50th Percentile</p>
            <div class="legend-gold-25 m-0"></div><p class="ml-4">25th Percentile</p>
        </div>
        <div v-else-if="educationLevel == 'postBacc'">
            <h5 class="font-weight-bold pb-2">Percentile: </h5>
            <div class="legend-green-75 m-0"></div><p class="ml-4">75th Percentile</p>
            <div class="legend-green m-0"></div><p class="ml-4">50th Percentile</p>
            <div class="legend-green-25 m-0"></div><p class="ml-4">25th Percentile</p>
        </div>
    </div>
</template>
<script>
export default {
    props: ['educationLevel'],
    data() {
        return {
            isAll: true,
        }
    },
    computed: {
        windowSize() {
            return window.innerWidth;
        }
    }
}
</script>
