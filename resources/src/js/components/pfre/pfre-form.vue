<template>
    <form class="form--inverted">
            <div class="fre-major-title">
                <h3 class="text-gray" v-if="form.majorId">{{ selectedMajorName }}</h3>
            </div>
            <div class="form__group">
            <div class="row row--condensed">    
                <div class="col col-12">
                    <div v-if="formNotFilled" class="required-field">
                        Please fill out all fields.
                    </div>
                    <label for="Major">Major:</label>
                    <v-select
                        label="major" 
                        :options="majors"
                        @input="updateGrandfatherSelect('majorId', 'majorId', $event)" 
                        @change="updateGrandfatherSelect('majorId', 'majorId', $event)"
                        class="csu-form-input-major">
                    </v-select>
                </div>
            </div>
            <div class="row row--condensed">
                <div class="col col-12">
                    <label for="age">Age Range:</label>
                    <v-select 
                        label="age" 
                        :options="ageRanges"
                        @input="updateSelect('age', $event)" 
                        class="csu-form-input">
                    </v-select>
                </div>
            </div>
            <div class="row row--condensed">
                <div class="col-12 col-9 col-md-12">
                    <label for="education">Education Level:</label>
                    <label class="label--radio" for="freshman">First Time Freshman:</label>
                    <input 
                    class="mx-2 mt-1"
                    for="freshman"
                    type="radio"
                    id="freshman"
                    v-model="form.education"
                    value="FTF"
                    @input="updateSelect('education', $event.target)">
                </div>
            </div>
            <div class="row row--condensed">
                <div class="col-12 col-9 col-md-12">
                    <label class="label--radio" for="transfer">First Time Transfer:</label>
                    <input 
                    class="mx-2 mt-1"
                    for="transfer"
                    type="radio"
                    id="transfer"
                    v-model="form.education"
                    value="FTT"
                    @input="updateSelect('education', $event.target)">
                </div>
            </div>
            <div class="row row--condensed">
                <div class="col col-12">
                    <label for="earnings">Estimated Annual Earnings During School</label>
                    <v-select 
                        label="earn" 
                        :options="earningRanges"
                        @input="updateSelect('earnings', $event)" 
                        @change="updateSelect('earnings', $event)"
                        class="csu-form-input">
                    </v-select>
                </div>
            </div>
            <div class="row row--condensed">
                <div class="col col-12">
                    <label for="financialAid">Estimated Annual Financial Aid</label>
                    <v-select 
                        label="finAid" 
                        :options="financialAidRanges"
                        @input="updateSelect('financialAid', $event)" 
                        @change="updateSelect('financialAid', $event)"
                        class="csu-form-input">
                    </v-select>
                </div>
            </div>
            </div>
            <div class="row row--condensed" id="submit-btn-container">
                <div class="pt-2 pb-4 pt-md-2 pb-md-2">
                        <button id="submit_button" type="button" class="btn btn-success btn-submit" @click="checkFormIsFilled(), scrollWin()">Submit</button>
                </div>
        </div>
    </form>
</template>
<script>
import vSelect from 'vue-select';
import { updateForm } from '../../utils/index';
import { required } from 'vuelidate/lib/validators';
import { mapGetters, mapActions } from 'vuex';

export default {
  data(){
      return {
        formNotFilled: false,
        form: {
            majorId: null,
            age: null,
            education: null,
            earnings: null,
            financialAid: null,
            university: 1153,
        },
        ageRanges: [{age:'18-19', value: 1},{age:'20-24', value: 2}, {age:'24-26', value: 3}, {age:'26 +', value: 4}],
        earningRanges: [{earn:'0', value: 1}, {earn:'0 - 20,000', value: 2}, {earn:'30,000 - 45,000', value: 3}, {earn:'45,000 - 60,000', value: 4}, {earn:'60,000 +', value: 5}],
        financialAidRanges: [{finAid:'0', value: 1}, {finAid:'0 - 5,000', value: 2}, {finAid:'5,000 - 15,000', value: 3}, {finAid:'15,000 +', value: 4}]
      }
    },
    methods: {
        ...mapActions([
            'fetchFreData'
        ]),
        updateGrandfatherSelect(field, dataKey, data) {
            if(data) {
                this.form[field] = data[dataKey];
            } else {
                this.form[field] = null;
            }
        },
        updateSelect(field, data) {
             if(data) {
                this.form[field] = data.value;
            } else {
                this.form[field] = null;
            }
        },
        scrollWin() {
            if (window.innerWidth <= 767){
                var scrollTop;
                var progressBar = document.getElementById("submit-btn-container");
                progressBar.scrollIntoView({
                    behavior: "smooth",
                    block: "start",
                    inline: "end"
                });
            }
        },
        checkFormIsFilled(){
            this.formNotFilled = false;
            if(this.$v.$invalid)
                this.formNotFilled = true;
            else
                this.fetchFreData(this.form);
        },
        submitToResubmit() {
            document.getElementById("submit_button").innerHTML = "Resubmit";
        }
    },
    computed: {
        ...mapGetters([
            'majors',
            'majorNameById'
        ]),
        selectedMajorName() {
            if(this.form.majorId == null) {
                return ''
            }
            else {
                return this.majorNameById(this.form.majorId)
            }
        }
    },
    validations: {
        form: {
            majorId: { required },
            age: {required},
            education: {required},
            earnings: {required},
            financialAid: {required},
            university: {required},
        }
    },
    components: {
        vSelect
    }
}
</script>

