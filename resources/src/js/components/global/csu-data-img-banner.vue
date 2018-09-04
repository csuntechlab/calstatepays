<template>
    <header class="CSUDataImgBanner" v-bind:style="{ backgroundImage: 'linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65)), url(' + CSUNImg + ')', }">
        <div class="container">
            <div class="row justify-content-start">
                <div class="CSUDataImgBanner__campusInfoWrapper col-12">
                    <h2 class="CSUDataImgBanner__campusTitle"> {{ csunAcronym }}</h2>
                    <a class="CSUDataImgBanner__changeCampus" href="#">Change Campus</a>
                </div>
                <div class="CSUDataImgBanner__dataInfoWrapper col-12 col-md-8">
                    <slot name="title"></slot>
                    <slot name="copy"></slot>
                </div>
            </div>
        </div>
    </header>
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