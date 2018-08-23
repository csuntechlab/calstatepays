<template>
        <div class="row" v-bind:id="'majorCardHasIndex-' + this.index">
            <div class="col-12">
                <div class="csu-card container-fluid">
                    <div class="row">
                        <i class="fas fa-times btn-remove float-right" @click="removeCurrentCard" v-show="isNotFirstCard" title="Close"></i>
                        <i class="fas fa-sync-alt btn-reset float-right" @click="resetCurrentCard" v-show="isEmpty" title="Reset"></i>
                    </div>
                    <div class="row">
                        <h3 v-show="selectedFormWasSubmitted" class="industry-title">{{selectedMajorTitle}}</h3>
                    </div>
                    <div class="row" style="height:75vh" v-bind:id="'majorGraphWrapperIndex-' + this.index">
                        <major-graph-wrapper class="col-12" :majorData="selectedMajorData" :educationLevel="selectedEducationLevel" :windowWidth=windowWidth />
                    </div>
                    <div class="row justify-content-center">
                        <major-legend v-show="selectedFormWasSubmitted" :educationLevel="selectedEducationLevel"/>
                    </div>
                    <div class="row">
                        <major-form :index="index"/>                    
                    </div>
                    <div class="row">
                        <industry-mobile v-show="selectedFormWasSubmitted" :industries="selectedIndustries" :majorId="selectedMajorId"/>
                    </div>
                </div>
            </div>
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
            'formWasSubmitted',
            'majorNameById'
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
        },
        selectedMajorId() {
            return this.majorData(this.index).majorId;
        },
        selectedMajorTitle() {
			if (this.selectedMajorData.length != 0) {
				let currentMajor = this.selectedMajorData.majorId;
				return this.majorNameById(currentMajor);
			}
		}
    },
    methods:{
        ...mapActions([
            'deleteMajorCard',
            'resetMajorCard'
        ]),
        removeCurrentCard(){
            this.deleteMajorCard(this.index);
        },
        resetCurrentCard(){
            this.resetMajorCard(this.index);
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
