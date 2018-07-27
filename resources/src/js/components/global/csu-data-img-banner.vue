<template>
    <div class="CSUDataImgBanner" v-bind:style="{ backgroundImage: 'linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url(' + CSUImg + ')', }">
        <h2 class="CSUDataImgBanner__campusTitle"> {{ campusName }}</h2>
        <div class="CSUDataImgBanner__dataInfoWrapper">
            <h3 class="CSUDataImgBanner__dataTitle"> <span> {{ industryTitle }} </span>  </h3>
            <p class="CSUDataImgBanner__dataCopy"> {{ fakeCopy }} </p>
        </div>
    </div>
</template>

<script>
export default {
    name: 'csu-data-img-banner',  
    data() {
        return {
            fakeCopy: ' Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus architecto necessitatibus id quis aliquam laboriosam dignissimos aut veritatis numquam amet, mollitia voluptates laborum magnam ea vero eaque nemo ipsum. Facere.',
            industryTitle: 'Top Industries By Major',
            freTitle: 'Financial Return on Investment',
            campusName: 'California State University Northridge',
            CSUImg: '../img/dataimgbanner/csun.jpg'
        }
    }
  
}
</script>