<template>
    <form class="form--inverted">
        <div class="form__group">
            <div class="row row--condensed">
                <h5 class="form--title">Choose A Major</h5>
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
                <div class="col col-md-8 py-4">
                    <button type="button" class="btn btn-success">Submit</button>
                </div>
            </div>
        </div>
    </form>
</template>
<script>
import { updateForm } from '../../utils/index';
import ECharts from 'vue-echarts/components/ECharts';
export default {
  data(){
      return {
          form: {
              major: null,
          }
      }
  },
  methods: {
      updateForm
  },
}
</script>

