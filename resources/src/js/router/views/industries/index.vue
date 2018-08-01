<template>
  <div class="row wrapper graph-content card-padding">
      <div class="col-lg-3 col-xs-12">
        <industry-form class="my-2 csu-card__form" />
      </div>
      <div class="col-lg-9 col-xs-12">
        <industry-progress class="my-2 card-item industry-card" />
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