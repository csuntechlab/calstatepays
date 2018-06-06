<template>
    <form class="form--inverted" id="'majorForm-' + form.cardIndex">
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
                fieldOfStudyId:null,
                educationLevel: "allDegrees",
            }
        }
    },
    methods: {
        ...mapActions([
            'fetchIndustryImages',
            'fetchUpdatedMajorsByField',
            'fetchMajorData',
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

                if(field == 'fieldOfStudyId'){
                    this.fetchUpdatedMajorsByField(this.form.fieldOfStudyId);
                }
            } else {
                this.form[field] = null;
            }
        },
        toggleEducationLevel() {
            this.$store.dispatch('toggleEducationLevel', {
                cardIndex: this.form.cardIndex,
                educationLevel: this.form.educationLevel
            })
        }
    },
    computed: {
        ...mapGetters([
            'majors',
            'fieldOfStudies',
            'universities'
        ])
    },
    components: {
        vSelect,        
    }    
}
</script>
