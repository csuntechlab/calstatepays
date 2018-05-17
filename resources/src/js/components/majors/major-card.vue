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
                                        <select
                                        name="universities"
                                        id="universities"
                                        @input="updateForm('schoolId', $event.target.value)">
                                        <option value="">All Campuses</option>
                                        <option v-for="university in universities" :value="university.id">{{ university.name }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row row--condensed">
                                    <h5 class="form--title">Choose A Major</h5>
                                    <div class="col col-12">
                                        <label for="Major">Major:</label>
                                        <select
                                        name="majors"
                                        id="majors"
                                        @input="updateForm('majorId', $event.target.value)">
                                        <option value="">-- Select a Major --</option>
                                        <option v-for="major in majors" :value="major.majorId">{{ major.major }}</option>
                                        </select>
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
                                <input type="radio" name="someCollege" id="someCollege" v-model="form.educationLevel" value="some_college">
                                <label for="postBacc">Some College</label>
                                <input type="radio" name="bachelors" id="bachelors" v-model="form.educationLevel" value="bachelors">
                                <label for="bachelors">Bachelor's Degree</label>
                                <input type="radio" name="post_bacc" id="post_bacc" v-model="form.educationLevel" value="post_bacc">
                                <label for="postBacc">Post Bacc</label>
                            </div>
                            <!--<button @click.prevent="fetchIndustryImages">click me</button>-->
                        </form>
                    </div>
                    <div class="col col-9">
                        <majors-graph-wrapper :form="form"></majors-graph-wrapper>
                    </div>
                </div>
            </div>
        </card>
    </div>
</template>
<script>

import card from '../global/card';
import majorsGraphWrapper from './majors-graph-wrapper.vue';
import industryCarousel from "../industries/industry-carousel.vue";

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
        card,
        majorsGraphWrapper,
        industryCarousel
    }
}
</script>
