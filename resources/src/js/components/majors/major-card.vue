<template>
    <div class="col col-md-12">
        <card>
            <div class="container-fluid my-0">
                <div class="row p-0">
                    <div class="mt-5">
                        <industry-carousel v-show="isEmpty" :industries="selectedIndustries"></industry-carousel>
                    </div>
                </div>
                <div class="row m-1 p-0">
                    <div class="col col-md-3 col-sm-12 my-3">
                         <major-form :index="index"></major-form>
                    </div>
                    <div class="col col-7">
                        <major-graph-wrapper v-show="selectedFormWasSubmitted" :majorData="selectedMajorData" :educationLevel="selectedEducationLevel"></major-graph-wrapper>
                    </div>
                    <div class="col-2 mt-4 pt-5 pl-0">
                        <major-legend v-show="isEmpty" :educationLevel="selectedEducationLevel"></major-legend>
                    </div>
                </div>
            </div>
        </card>
    </div>
</template>
<script>
import majorForm from './major-form.vue';
import card from '../global/card';
import majorsGraph from './majors-graph.vue';
import majorGraphWrapper from './major-graph-wrapper.vue';
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
            'majorData',
            'educationLevel',
            'formWasSubmitted'
        ]),
        isEmpty(){
            //Check whether the form field was fired off, toggle carousel on
            if(this.industries(this.index).length === 0){
                return false;
            } return true;
        },
        selectedMajorData() {
            return this.majorData(this.index);
        },
        selectedIndustries() {
            return this.industries(this.index);
        },
        selectedEducationLevel() {
            return this.educationLevel(this.index);
        },
        selectedFormWasSubmitted() {
            return this.formWasSubmitted(this.index);
        }
    },
    components: { 
        majorForm,
        card,
        majorGraphWrapper,
        majorsGraph,
        industryCarousel,
        majorLegend        
    }
}
</script>
