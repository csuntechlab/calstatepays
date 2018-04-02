<template>
    <div class="wrapper">
        <div class="col col-md-12">
            <card>
                <div class="container-fluid my-0">
                    <div class="row">
                        <div class="mt-5">
                            <industry-carousel></industry-carousel>				
                        </div>
                    </div>
                    <div class="row m-1">
                        <div class="col col-md-3 col-sm-12 my-3">
                            <majors-form></majors-form>
                        </div>
                        <div class="col col-9">
                            <majors-graph-wrapper></majors-graph-wrapper>
                        </div>
                    </div>
                </div>
            </card>
        </div>
  </div>
</template>
<script>
import card from '../global/card';
import majorsForm from './majors-form.vue';
import majorsGraphWrapper from './majors-graph-wrapper.vue';
import industryCarousel from "../industries/industry-carousel.vue";


export default {
    components: { 
        card,
        majorsForm,
        majorsGraphWrapper,
        industryCarousel
    }
}
</script>
