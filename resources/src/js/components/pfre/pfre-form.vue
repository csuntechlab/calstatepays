<template>
    <form class="form--inverted">
            <div class="fre-major-title">
                <h3 class="text-gray" v-if="form.majorId">{{ selectedMajorName }}</h3>
            </div>
            <div class="form__group">
            <div class="row row--condensed">    
                <div class="col col-12">
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
                <div class="col col-9">
                    <label for="education">Education Level:</label>
                    <label class="label--radio" for="education">First Time Freshman:</label>
                    <input 
                    class="mx-2 mt-1"
                    type="radio"
                    id="freshman"
                    v-model="form.education"
                    value="FTF"
                    @input="updateSelect('education', $event.target)">
                </div>  
                <div class="col col-3"></div>
            </div>
            <div class="row row--condensed">
                <div class="col col-9">
                    <label class="label--radio" for="education">First Time Transfer:</label>
                    <input 
                    class="mx-2 mt-1"
                    type="radio"
                    id="transfer"
                    v-model="form.education"
                    value="FTT"
                    @input="updateSelect('education', $event.target)">
                </div>  
                <div class="col col-3"></div>
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
            <div class="row row--condensed">
                <div class="py-4">
                    <button type="button" class="btn btn-success" @click="fetchFreData(form)">Submit</button>
                </div>
        </div>
    </form>
</template>
<script>
import vSelect from 'vue-select';
import { updateForm } from '../../utils/index';
import { mapGetters, mapActions } from 'vuex';

export default {
  data(){
      return {
        form: {
            majorId: null,
            age: null,
            education: null,
            earnings: null,
            financialAid: null,
            //drop down for university hasn't been created yet
            university: 1153
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
    components: {
        vSelect
    }
}
</script>

