<template>
    <div class="CSUDataImgBanner col-12" v-bind:style="{ backgroundImage: 'linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65)), url(' + CSUNImg + ')', }">
        <div class="container p-0">
           <div class="CSUDataImgBanner__campusInfoWrapper col-12">
                <h2 class="CSUDataImgBanner__campusTitle"> {{ csunAcronym }}</h2>
                <a class="CSUDataImgBanner__changeCampus" href="#">Change Campus</a>
            </div>
            <div class="CSUDataImgBanner__dataInfoWrapper col-12 col-md-7 col-lg-6">
                <slot name="title"></slot>
                <slot name="copy"></slot>
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
            CSUNImg: window.baseUrl + '/img/dataimgbanner/csun.jpg',
            CSUImg: '',
        }
    }
}
</script>