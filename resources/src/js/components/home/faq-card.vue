<template>
<div class="row mx-auto">
    <div class=" f faq-card col-12 col-sm-10 col-lg-8">
        <div class="row">
            <div class="col-6 col-sm-5 faq-card__text">
                <p  class="faq-card__text--blue">Have Questions?</p>
                <p  class="faq-card__text--gray">We Have Answers.</p>
                <router-link to="/faq" class="faq-card__button">
                    Read Our FAQ
                </router-link>
                
            </div>
            <div  class="col-6 col-sm-5 d-sm-flex" >
                <img class="faq-card__image " :src="this.url + '/img/homeimages/faq_graphic.svg'">
            </div>
        </div>

        <div   class="faq-card__button--mobile row d-sm-none" > 
            <router-link to="/faq">
                Read Our FAQ
            </router-link>
        </div>
    </div>
</div>

</template>
<script>
export default {
    computed:{
        url(){
            return window.baseUrl;
        }
    }
}
</script>
