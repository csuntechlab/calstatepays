<template>
    <div class="col col-md-12">
        <card>
            <div class="container-fluid my-0">
                <div class="row p-0">
                    <div class="mt-5">
                        <industry-carousel :form="form"></industry-carousel>				
                    </div>
                </div>
                <div class="row m-1 p-0">
                    <div class="col col-md-3 col-sm-12 my-3">
                         <form class="form--inverted">
                            <div class="form__group" v-if="!form.formWasSubmitted">
                                <div class="row row--condensed">
                                    <h5 class="form--title">Choose A Campus</h5>
                                    <div class="col col-12">
                                        <label for="campus">Campus:</label>
                                        <v-select 
                                            label="name" 
                                            :options="universities"
                                            @input="updateSelect('schoolId', 'id', $event)" 
                                            @change="updateSelect('schoolId', 'id', $event)">
                                        </v-select>
                                    </div>
                                </div>
                                <div class="row row--condensed">
                                    <h5 class="form--title">Choose A Major</h5>
                                    <div class="col col-12">
                                        <label for="Major">Major:</label>
                                        <v-select 
                                            label="major" 
                                            :options="majors"
                                            @input="updateSelect('majorId', 'majorId', $event)" 
                                            @change="updateSelect('majorId', 'majorId', $event)">
                                        </v-select>
                                    </div>
                                </div>
                                <div class="row row--condensed">
                                    <div class="col col-md-8 py-4">
                                        <button type="button" @click="submitForm" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form__group" v-else>
                                <p class="h2 text-gray my-5">Applied Math</p>
                                <input type="radio" name="allDegrees" id="allDegrees" v-model="form.educationLevel" checked value="allDegrees">
                                <label for="allDegrees">All</label>
                                <input type="radio" name="someCollege" id="someCollege" v-model="form.educationLevel" value="someCollege">
                                <label for="postBacc">Some College</label>
                                <input type="radio" name="bachelors" id="bachelors" v-model="form.educationLevel" value="bachelors">
                                <label for="bachelors">Bachelor's Degree</label>
                                <input type="radio" name="postBacc" id="postBacc" v-model="form.educationLevel" value="postBacc">
                                <label for="postBacc">Post Bacc</label>
                            </div>
                        </form>
                    </div>
                    <div class="col col-7">
                        <majors-graph-wrapper :form="form"></majors-graph-wrapper>
                    </div>
                    <div class="col-2 mt-4 pt-5 pl-0">
                        <major-legend :form="form"></major-legend>
                    </div>
                </div>
            </div>
        </card>
    </div>
</template>
<script>

import vSelect from 'vue-select';
import card from '../global/card';
import majorsGraphWrapper from './majors-graph-wrapper.vue';
import industryCarousel from "../industries/industry-carousel.vue";
import majorLegend from './major-legend.vue';


import { updateForm } from '../../utils/index';
import { mapGetters, mapActions } from 'vuex';

export default {
    data(){
      return {
          form: {
                majorId: null,
                formWasSubmitted: false,
                schoolId: null,
                educationLevel: "allDegrees",
            }
        }
    },
    methods: {
        ...mapActions([
            'fetchIndustryImages',
            'fetchMajorData'
        ]),
        updateForm,
        submitForm(){
            this.form.formWasSubmitted = true;
            this.fetchIndustryImages(this.form);
            this.fetchMajorData(this.form);
        },
        updateSelect(field, dataKey, data) {
            if(data) {
                this.form[field] = data[dataKey];
            } else {
                this.form[field] = null;
            }
        }
    },
    computed: {
        ...mapGetters([
            'majors',
            'universities',
            'universityById',
        ]),
        campus(){
            if(this.form.schoolId){
                return this.universityById(this.form.schoolId);
            }
            return null;
        },
    },
    components: { 
        vSelect,
        card,
        majorsGraphWrapper,
        industryCarousel,
        majorLegend        
    }
}
</script>
