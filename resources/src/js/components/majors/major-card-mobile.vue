<template>
    <div class="col col-md-12">
        <card>
            <div class="row btn-remove">
                <div class="col-12">
                    <button>
                        <i class="fas fa-times" @click="removeCurrentCard" v-show="isNotFirstCard && isEmpty"></i>
                    </button>
                </div>
            </div>
            <div class="container-fluid my-0 mt-2">
                <div v-show="selectedFormWasSubmitted" style="height: 400px" class="row m-1 p-0">
                    <div class="col p-0">
                        <major-graph-wrapper :majorData="selectedMajorData" :educationLevel="selectedEducationLevel" :windowWidth=windowWidth></major-graph-wrapper>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <major-legend v-show="selectedFormWasSubmitted" :educationLevel="selectedEducationLevel"></major-legend>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <major-form :index="index" class="m-0"></major-form>                    
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <industry-mobile v-show="selectedFormWasSubmitted" :industries="selectedIndustries"></industry-mobile>
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
    props: ['index', 'windowWidth'],
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
        },
        selectedFormWasSubmitted() {
            return this.formWasSubmitted(this.index);
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
        industryMobile,
        majorLegend        
    }
}
</script>
