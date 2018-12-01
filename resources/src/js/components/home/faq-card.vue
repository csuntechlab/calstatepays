<template>
<div class=" faq-card row mx-auto ">
    <div class="col-6 col-sm-5 faq-card--text">
        <p  class="faq-card--text__blue">Have Questions?</p><p>We Have Answers.</p>
        <router-link to="/faq">
            <button class="faq-card--button">Read Our FAQ</button>
        </router-link>
        
    </div>
    <div  class="col-6 col-sm-5 d-sm-flex" >
        <img class="faq-card--image" :src="this.url + '/img/homeimages/faq_graphic.svg'">
    </div>

    <div   class="faq-card--button__mobile col-12 d-sm-none" > 
        <router-link to="/faq">
            Read Our FAQ
        </router-link>
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
