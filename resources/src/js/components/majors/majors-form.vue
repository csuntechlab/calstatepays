<template>
    <form class="form--inverted">
        <div class="form__group" v-if="!form.formWasSubmitted">
            <div class="row row--condensed">
                <h5 class="form--title">Choose A Major</h5>
                <div class="col col-12">
                    <label for="Major">Major:</label>
                    <select 
                    name="majors" 
                    id="majors">
                    <option v-for="major in majors" :value="major.majorId">{{ major.major }}</option>
                    </select>
                </div>
            </div>
            <div class="row row--condensed">
                <div class="col col-md-8 py-4">
                    <button type="button" @click.prevent="submitForm" class="btn btn-success">Submit</button>
                </div>
            </div>
        </div>
        <div class="form__group" v-else>
            <p class="h2 text-gray my-5">Applied Math</p>
            <input type="radio" name="allDegrees" id="allDegrees" v-model="form.degree" value="allDegrees">
            <label for="allDegrees">All</label>
            <input type="radio" name="bachelors" id="bachelors" v-model="form.degree" value="bachelors">
            <label for="bachelors">Bachelor's Degree</label>
            <input type="radio" name="postBacc" id="postBacc" v-model="form.degree" value="postBacc">
            <label for="postBacc">Post Bacc Degree</label>
        </div>
    </form>
</template>
<script>
import { updateForm } from '../../utils/index';
import { mapGetters } from 'vuex';
export default {
  data(){
      return {
          form: {
                major: null,
                formWasSubmitted: false,
                degree: '',
          }
      }
  },
  methods: {
        updateForm,
        submitForm(){
            this.form.formWasSubmitted = true;
        }
  },
  computed: {
      ...mapGetters([
          'majors',
      ])
  }
}
</script>

