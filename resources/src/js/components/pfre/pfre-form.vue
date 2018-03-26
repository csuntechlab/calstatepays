<template>
    <form class="form--inverted">
        <div class="form__group">
            <div class="row row--condensed">
                <h3 class="text-gray" v-if="form.major">{{ form.major }}</h3>
                <div class="col col-12">
                    <label for="Major">Major:</label>
                    <input 
                    type="text"
                    id="major"
                    :value="form.major"
                    @input="updateForm('major', $event.target.value)">
                </div>
            </div>
            <div class="row row--condensed">
                <div class="col col-12">
                    <label for="age">Age Range:</label>
                    <input 
                    type="text"
                    id="age"
                    :value="form.age"
                    @input="updateForm('age', $event.target.value)">
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
                    <input 
                    type="text"
                    id="earnings"
                    :value="form.earnings"
                    @input="updateForm('earnings', $event.target.value)">
                </div>
            </div>
            <div class="row row--condensed">
                <div class="col col-12">
                    <label for="financialAid">Estimated Annual Financial Aid</label>
                    <input 
                    type="text"
                    id="financialAid"
                    :value="form.financialAid"
                    @input="updateForm('financialAid', $event.target.value)">
                </div>
            </div>
            <div class="row row--condensed">
                <div class="col col-md-8 py-4">
                    <button type="button" class="btn btn-success">Submit</button>
                </div>
            </div>
        </div>
    </form>
</template>
<script>
import { updateForm } from '../../utils/index';
export default {
  data(){
      return {
          form: {
              major: null,
              age: null,
              education: null,
              earnings: null,
              financialAid: null,
          }
      }
  },
  methods: {
      updateForm
  }
}
</script>

