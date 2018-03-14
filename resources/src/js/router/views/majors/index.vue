<template>
    <div class="wrapper">
        <div class="col col-md-12">
            <card class="my-4">
                <div class="col col-md-3 col-sm-12">
                    <majors-form></majors-form>
                </div>
                <div class="col col-9">
                    <majors-graph></majors-graph>
                </div>
            </card>
        </div>
  </div>
</template>
<script>
import card from '../../../components/global/card';
import majorsForm from '../../../components/majors/majors-form.vue';
import majorsGraph from '../../../components/majors/majors-graph.vue';
export default {
    components: { 
        card,
        majorsForm,
        majorsGraph
    }
}
</script>
