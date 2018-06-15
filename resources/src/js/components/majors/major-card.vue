<template>
    <div class="col col-md-12">
        <card>
            <button class="btn-remove">
                <!--<button v-on:click="removeCurrentCard" v-show="isNotFirstCard && isEmpty" class="btn btn-danger btn-sm btn-outline-danger">Remove</button>-->
                <i class="fas fa-times" @click="removeCurrentCard" v-show="isNotFirstCard && isEmpty"></i>
            </button>
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
                        <major-graph-wrapper :majorData="selectedMajorData" :educationLevel="selectedEducationLevel"></major-graph-wrapper>
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
            'educationLevel'
        ]),
        isEmpty(){
            //Check whether the form field was fired off, toggle carousel on
            if(this.industries(this.index).length === 0){
                return false;
            } return true;
        },
        isNotFirstCard(){
            if(this.index >= 1){
                return true;
            } return false;
        },
        selectedMajorData() {
            return this.majorData(this.index);
        },
        selectedIndustries() {
            return this.industries(this.index);
        },
        selectedEducationLevel() {
            return this.educationLevel(this.index);
        }
    },
    methods:{
        ...mapActions([
            'deleteMajorCard'
        ]),
        removeCurrentCard(){
            this.deleteMajorCard(this.index);
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
