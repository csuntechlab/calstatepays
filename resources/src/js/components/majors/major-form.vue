<template>
    <form class="form--inverted" id="'majorForm-' + form.cardIndex">
        <div class="form__group" v-if="!selectedFormWasSubmitted">
            <div class="row row--condensed">
                <h5 class="form--title">Choose A Campus</h5>
                <div class="col col-12">
                    <label for="campus">Campus:</label>
                    <label for="campus" v-show="this.$v.$error">(Required)</label>
                    <v-select 
                        label="name" 
                        :options="universities"
                        @input="updateSelect('schoolId', 'id', $event)" 
                        @change="updateSelect('schoolId', 'id', $event)">
                    </v-select>
                </div>
            </div>
            <div class="row row--condensed">
                <h5 class="form--title">Choose a Discipline</h5>
                <div class="col col-12">
                    <label for="fieldOfStudy">Discipline:</label>
                    <v-select
                            label="discipline"
                            :options="fieldOfStudies"
                            @input="updateSelect('fieldOfStudyId', 'id', $event)"
                            @change="updateSelect('fieldOfStudyId', 'id', $event)">
                    </v-select>
                </div>
            </div>
            <div class="row row--condensed">
                <h5 class="form--title">Choose A Major</h5>
                <div class="col col-12">
                    <label for="Major">Major:</label>
                    <label for="Major" v-show="this.$v.$error">(Required)</label>
                    <v-select
                        label="major"
                        v-if="this.form.fieldOfStudyId == null"
                        :options="majors"
                        @input="updateSelect('majorId', 'majorId', $event)"
                        @change="updateSelect('majorId', 'majorId', $event)">
                    </v-select>
                    <v-select
                            label="major"
                            v-else
                            :options="selectedMajorsByField"
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
            <p class="h3 majors-header my-5">Select a Degree Level</p>
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
            },
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
            this.$v.$touch();
            if(!this.$v.$invalid) {
                this.toggleFormWasSubmitted(this.form.cardIndex);
                this.fetchIndustryImages(this.form);
                this.fetchMajorData(this.form);
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
            return this.majorsByField(this.index);
        },
        selectedFormWasSubmitted(){
            return this.formWasSubmitted(this.index);
        }
    },
    validations: {
        form: {
            majorId: { required },
            schoolId: { required }
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
    created() {
        console.log(this.$v)                
    }
}
</script>
