<template>
    <form class="form--inverted">
            <div class="fre-major-title">
                <h3 class="text-gray" v-if="form.majorId">{{ form.majorId }}</h3>
            </div>
            <div class="form__group">
            <div class="row row--condensed">    
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
                <div class="col col-12">
                    <label for="age">Age Range:</label>
                    <v-select 
                        label="age" 
                        :options="ageRanges"
                        @input="updateSelect('age', 'age', $event)" 
                        @change="updateSelect('age', 'age', $event)">
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
                    value="freshman"
                    @input="updateForm('education', $event.target.value)">
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
                    value="transfer"
                    @input="updateForm('education', $event.target.value)">
                </div>  
                <div class="col col-3"></div>
            </div>
            <div class="row row--condensed">
                <div class="col col-12">
                    <label for="earnings">Estimated Annual Earnings During School</label>
                    <v-select 
                        label="earnings" 
                        :options="earningRanges"
                        @input="updateSelect('earnings', 'earnings', $event)" 
                        @change="updateSelect('earnings', 'earnings', $event)">
                    </v-select>
                </div>
            </div>
            <div class="row row--condensed">
                <div class="col col-12">
                    <label for="financialAid">Estimated Annual Financial Aid</label>
                    <v-select 
                        label="fincialAid" 
                        :options="financialAidRanges"
                        @input="updateSelect('financialAid', 'financialAid', $event)" 
                        @change="updateSelect('financialAid', 'financialAid', $event)">
                    </v-select>
                </div>
            </div>
            <div class="row row--condensed">
                <div class="py-4">
                    <button type="button" class="btn btn-success" @click="fetchMockData()">Submit</button>
                </div>
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
        },
        ageRanges: ['18-19', '20-24', '24-26', '26 +'],
        financialAidRanges: ['0', '0 - 20,000', '30,000 - 45,000', '45,000 - 60,000', '60,000 +'],
        earningRanges: ['0', '0 - 5,000', '5,000 - 15,000', '15,000']
      }
    },
    methods: {
        ...mapActions([
            'fetchMockData'
        ]),
        updateSelect(field, dataKey, data) {
            if(data) {
                this.form[field] = data[dataKey];
            } else {
                this.form[field] = null;
            }
        },
        updateForm
    },
    computed: {
        ...mapGetters([
            'majors'
        ])
    },
    components: {
        vSelect
    }
}
</script>

