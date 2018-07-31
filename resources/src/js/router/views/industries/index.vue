<template>
    <div class="row">
      <div class="col-3">
        <industry-form/>
      </div>
      <div class="col-9">
	      <industry-progress/>	
      </div>
    </div>
</template>

<script>
import industryProgress from "../../../components/industries/industry-progress.vue";
import industryForm from "../../../components/industries/industry-form.vue"

export default {
  components: {
    industryProgress,
    industryForm
  }
};
</script>
