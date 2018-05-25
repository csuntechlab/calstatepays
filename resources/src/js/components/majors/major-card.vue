<template>
    <div class="col col-md-12">
        <card>
            <div class="container-fluid my-0">
                <div class="row p-0">
                    <div class="mt-5">
                        <industry-carousel :industries="selectedIndustries"></industry-carousel>				
                    </div>
                </div>
                <div class="row m-1 p-0">
                    <div class="col col-md-3 col-sm-12 my-3">
                         <major-form :index="index"></major-form>
                    </div>
                    <div class="col col-7">
                        <majors-graph-wrapper></majors-graph-wrapper>
                    </div>
                    <div class="col-2 mt-4 pt-5 pl-0">
                        <major-legend></major-legend>
                    </div>
                </div>
            </div>
        </card>
    </div>
</template>
<script>
import majorForm from './major-form.vue';
import card from '../global/card';
import majorsGraphWrapper from './majors-graph-wrapper.vue';
import industryCarousel from "../industries/industry-carousel.vue";
import majorLegend from './major-legend.vue';


import { updateForm } from '../../utils/index';
import { mapGetters, mapActions } from 'vuex';

export default {
    props: ['index'],
    computed: {
        ...mapGetters([
            'universityById',
            'industries',
        ]),
        selectedIndustries() {
            return this.industries(this.index);
        }
    },
    components: { 
        majorForm,
        card,
        majorsGraphWrapper,
        industryCarousel,
        majorLegend        
    }
}
</script>
