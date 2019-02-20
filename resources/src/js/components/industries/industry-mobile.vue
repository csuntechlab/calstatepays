<template>
    <div class="IndustryCarousel">
        <h3 class="IndustryCarousel__MajorTitle">Common Employment Sectors<br> in {{ selectedMajorName }}</h3>
        <p class="IndustryCarousel__MajorSubTitle">Employment 5 Years After Exit</p>
        <p class="IndustryCarousel__NoIndustryMessage" v-if="!empty">No Employment Sector data is available for this major.</p>
        <div v-else v-for="(industry, index) in industries.slice(0,3)" :key="index">
            <industry-carousel-card :industry="industry"/>
        </div>
    </div>
</template>

<script>
import industryCarouselCard from './industry-carousel-card';
import { mapGetters, mapActions } from 'vuex';

    export default {
        props: ['industries', 'majorId', 'empty'],

        components: {
            industryCarouselCard,
        },
        computed: {
            ...mapGetters([
                'majorNameById'
            ]),
            selectedMajorName() {
                if (this.majorId == null) {
                    return ''
                } else {
                    return this.majorNameById(this.majorId);
                }
            }
        }
    }
</script>