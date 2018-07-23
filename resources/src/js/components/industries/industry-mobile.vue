<template>
    <div>
        <h5 class="majors-header">Common Employment Sectors for</h5>
        <h5 class="majors-header">{{ selectedMajorName }}</h5>
        <div v-for="(industry, index) in industries.slice(0,3)" :key="index"> 
            <industry-carousel-card :industry="industry"></industry-carousel-card>
        </div>
    </div>
</template>

<script>
import industryCarouselCard from './industry-carousel-card';
import { mapGetters, mapActions } from 'vuex';

    export default {
        props: ['industries', 'majorId'],

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