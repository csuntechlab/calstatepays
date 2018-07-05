<template>
    <form class="form--inverted form--degreeLevel mb-4 mb-0-md" v-bind:id="'majorForm-' + form.cardIndex">
        <div class="form__group" v-if="!selectedFormWasSubmitted">
            <div class="row row--condensed mt-3">
                <h5 class="form--title">Choose A <abbr title="California State University">CSU</abbr></h5>
                <div class="col col-12">
                    <label for="campus">Campus:</label>
                    <label for="campus" v-show="this.form.errors.university"><span style="font-weight:bold; color:red">Required *</span></label>
                    <v-select 
                        label="name"
                        :options="universities"
                        @input="updateSelect('schoolId', 'id', $event)" 
                        @change="updateSelect('schoolId', 'id', $event)"
                        class="csu-form-input-major"
                        v-bind:class="{ 'border-danger': !this.form.schoolId && this.form.submitCount}">
                    </v-select>
                </div>
            </div>
            <div class="row row--condensed mt-3">
                <h5 class="form--title">Choose a Discipline</h5>
                <div class="col col-12">
                    <label for="fieldOfStudy">Discipline:</label>
                    <v-select
                            label="discipline"
                            :options="fieldOfStudies"
                            @input="updateSelect('fieldOfStudyId', 'id', $event)"
                            @change="updateSelect('fieldOfStudyId', 'id', $event)"
                            class="csu-form-input">
                    </v-select>
                </div>
            </div>
            <div class="row row--condensed mt-3">
                <h5 class="form--title">Choose A Major</h5>
                <div class="col col-12">
                    <label for="Major">Major:</label>
                    <label for="Major" v-show="this.form.errors.major"><span style="font-weight:bold; color:red">Required *</span></label>
                    <v-select
                        label="major"
                        v-if="this.form.fieldOfStudyId == null"
                        v-model="selected"
                        :options="majors"
                        @input="updateSelect('majorId', 'majorId', $event)"
                        @change="updateSelect('majorId', 'majorId', $event)"
                        class="csu-form-input-major"
                        v-bind:class="{ 'border-danger': !this.form.majorId && this.form.submitCount }">
                    </v-select>
                    <v-select
                        label="major"
                        v-else
                        v-model="selected"
                        :options="selectedMajorsByField"
                        @input="updateSelect('majorId', 'majorId', $event)"
                        @change="updateSelect('majorId', 'majorId', $event)"
                        class="csu-form-input-major">
                    </v-select>
                </div>
            </div>
            <div class="row row--condensed">
                <div class="py-4">
                    <button type="button" @click="submitForm" class="btn btn-success btn-submit">Submit</button>
                </div>
            </div>
        </div>
        <div class="form__group" v-else>
            <p v-show="windowSize > 500" class="h3 majors-header my-5-md my-4">Select a Degree Level</p>
            <input type="radio" name="allDegrees" :id="'allDegrees-' + form.cardIndex" v-model="form.educationLevel" @change="toggleEducationLevel()" checked value="allDegrees">
            <label :for="'allDegrees-' + form.cardIndex">All</label>
            <input type="radio" name="postBacc" :id="'postBacc-' + form.cardIndex" v-model="form.educationLevel" @change="toggleEducationLevel()" value="postBacc">
            <label :for="'postBacc-' + form.cardIndex">Post Bacc</label>
            <input type="radio" name="bachelors" :id="'bachelors-' + form.cardIndex" v-model="form.educationLevel" @change="toggleEducationLevel()" value="bachelors">
            <label :for="'bachelors-' + form.cardIndex">Bachelor's Degree</label>
            <input type="radio" name="someCollege" :id="'someCollege-' + form.cardIndex" v-model="form.educationLevel" @change="toggleEducationLevel()" value="someCollege">
            <label :for="'someCollege-' + form.cardIndex">Some College</label>
        </div>
    </form>
</template>

<script>
import vSelect from 'vue-select';
import { required } from 'vuelidate/lib/validators';
import { updateForm } from '../../utils/index';
import { mapGetters, mapActions } from 'vuex';

export default {
    props: ['index'],
    data(){
      return {
          form: {
                cardIndex: this.index,
                majorId: null,
                formWasSubmitted: false,
                schoolId: null,
                fieldOfStudyId: null,
                educationLevel: "allDegrees",
                errors: {
                    "major": null,
                    "university": null
                },
                submitCount: 0,
                isUnivSelected: true,
                isMajorSelected: true
            },
            selected: null,
        }

    },
    methods: {
        ...mapActions([
            'fetchIndustryImages',
            'toggleFormWasSubmitted',
            'fetchUpdatedMajorsByField',
            'fetchMajorData',
        ]),
        updateForm,
        submitForm(){
            this.form.submitCount += 1;
            if(this.checkForm()) {
                this.toggleFormWasSubmitted(this.form.cardIndex);
                this.fetchIndustryImages(this.form);
                this.fetchMajorData(this.form);
            }
        },
        checkForm(){
            if(this.form.schoolId && this.form.majorId){
                return true;
            }
            this.checkFieldsHaveErrors()
        },
        checkFieldsHaveErrors(){
            if(!this.form.schoolId){
                this.form.errors.university = 'Campus Required';
                this.form.isUnivSelected = false;
            } else {
                this.form.isUnivSelected = true;
                this.form.errors.university = false;
            }
            if(!this.form.majorId){
                this.form.errors.major = 'Major Required';
                this.form.isMajorSelected = false;
            } else {
                this.form.isMajorSelected = true;
                this.form.errors.major = false;
            }
        },
        updateSelect(field, dataKey, data) {
            if(data) {
                this.form[field] = data[dataKey];
                this.handleFieldOfStudyMajors(field);
            } else {
                this.form[field] = null;
            }
        },
        handleFieldOfStudyMajors(field){
            if(field == 'fieldOfStudyId'){
                this.fetchUpdatedMajorsByField(this.form);
            }
        },
        toggleEducationLevel() {
            this.$store.dispatch('toggleEducationLevel', {
                cardIndex: this.form.cardIndex,
                educationLevel: this.form.educationLevel
            })
        },
    },
    computed: {
        ...mapGetters([
            'majors',
            'fieldOfStudies',
            'universities',
            'majorsByField',
            'formWasSubmitted',
        ]),
        selectedMajorsByField(){
            this.selected = null;
            return this.majorsByField(this.index);
        },
        removeMajorsByField(){
            return this.majorsByField(null);
        },
        selectedFormWasSubmitted(){
            return this.formWasSubmitted(this.index);
        },
        windowSize() {
            return window.innerWidth;
        }
    },
    validations: {
        form: {
            majorId: { required },
            schoolId: { required }
        }
    },
    components: {
        vSelect,        
    },
}
</script>
