<template>
    <div class="CSUDataImgBanner col-12" v-bind:style="{ backgroundImage: 'linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65)), url(' + CSUImg + CSUNImg + ')', }">
        <div class="container p-0">
           <div class="CSUDataImgBanner__campusInfoWrapper col-12">
                <h2 class="CSUDataImgBanner__campusTitle"> {{ campusName + csunAcronym }}</h2>
                <a class="CSUDataImgBanner__changeCampus" href="#">Change Campus</a>
            </div>
            <div class="CSUDataImgBanner__dataInfoWrapper col-12 col-md-7 col-lg-6">
                <h3 class="CSUDataImgBanner__dataTitle"> <span> {{ dataTitle + fakeTitle }} </span>  </h3>
                <p class="CSUDataImgBanner__dataCopy"> {{ dataCopy + fakeCopy }} </p>
            </div> 
        </div>
    </div>
</template>

<script>
export default {
    name: 'csu-data-img-banner',  
    data() {
        return {
            csunAcronym: 'California State University Northridge',
            CSUNImg: '../img/dataimgbanner/csun.jpg',
            CSUImg: '',

            dataTitle: '',
            dataCopy: '',
            campusName: '',

            fakeTitle: 'Title',
            fakeCopy: ' Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus architecto necessitatibus id quis aliquam laboriosam dignissimos aut veritatis numquam amet, mollitia voluptates laborum magnam ea.',

            industryTitle: 'Top Industries By Major',
            industryCopy: '',
            majorsTitle: 'Major Earnings Over Time',
            majorCopy: '',
            freTitle: 'Financial Return on Investment',
            freCopy: ''
        }
    }
}
</script>