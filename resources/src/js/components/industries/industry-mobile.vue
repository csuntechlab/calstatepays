<template>
    <div>
        <h5 class="majors-header">Common Employment Sectors<br> in {{ selectedMajorName }}</h5>
        <p class="h6 text-center pb-3">Employment 5 Years After Exit</p>
        <p class="lead pl-5 pr-5" v-if="!empty">No Employment Sector data is available for this major.</p>
        <div v-else v-for="(industry, index) in industries.slice(0,3)" :key="index">
            <industry-carousel-card :industry="industry"></industry-carousel-card>
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