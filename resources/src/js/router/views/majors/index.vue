<template>
    <div class="wrapper">
        <div class="col col-md-12">
           
            <card class="my-4">
                <div class="container">
                    <div class="row">
                        <div class="col col-8 offset-2 my-4">
                            <industry-carousel></industry-carousel>				
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-md-3 col-sm-12">
                            <majors-form></majors-form>
                        </div>
                        <div class="col col-9">
                        <majors-graph-wrapper></majors-graph-wrapper>
                    </div>
                    </div>
                </div>
                
                
                    
            </card>
            <card-add></card-add>
        </div>
  </div>
</template>
<script>
import card from '../../../components/global/card';
import cardAdd from '../../../components/global/card-add.vue';
import majorsForm from '../../../components/majors/majors-form.vue';
import majorsGraphWrapper from '../../../components/majors/majors-graph-wrapper.vue';
import industryCarousel from "../../../components/industries/industry-carousel.vue";


export default {
    components: { 
        card,
        cardAdd,
        majorsForm,
        majorsGraphWrapper,
        industryCarousel
    }
}
</script>
