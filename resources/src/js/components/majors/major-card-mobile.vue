<template>
    <div class="col col-md-12">
        <card>
            <div class="container-fluid my-0">
                <div class="row m-1 p-0">
                    <major-graph-wrapper v-show="selectedFormWasSubmitted" :majorData="selectedMajorData" :educationLevel="selectedEducationLevel"></major-graph-wrapper>
                </div>
                <div class="row">
                    <major-legend v-show="selectedFormWasSubmitted" :educationLevel="selectedEducationLevel"></major-legend>
                </div>
                <div class="row">
                    <major-form :index="index" class="m-0"></major-form>                    
                </div>
                <div class="row">
                    <div class="col">
                        <industry-mobile :industries="selectedIndustries"></industry-mobile>
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
import industryMobile from "../industries/industry-mobile.vue";
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
        industryMobile,
        majorLegend        
    }
}
</script>
