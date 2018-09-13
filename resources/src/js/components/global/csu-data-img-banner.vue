<template>
    <div  class="CSUDataImgBanner col-12" v-bind:style="{ backgroundImage: 'linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65)), url(' + CSUNImg + ')', }">
        <div class="container p-0">
           <div class="CSUDataImgBanner__campusInfoWrapper col-12">
                <h2 class="CSUDataImgBanner__campusTitle"> {{ csunAcronym }}</h2>
                    <div data-app>
                        <campus-modal>
                            <span slot="change button" class="CSUDataImgBanner__changeCampus" href="#">Change Campus</span>
                         </campus-modal>
                    </div>
            </div>
            <!-- <campus-modal><span slot="change"></span></campus-modal> -->
            <div class="CSUDataImgBanner__dataInfoWrapper col-12 col-md-7 col-lg-6">
                <slot name="title"></slot>
                <slot name="copy"></slot>
            </div> 
        </div>
    </div>
</template>

<script>
import campusModal from './campus-modal.vue';
export default {
    name: 'csu-data-img-banner',  
    data() {
        return {
            csunAcronym: 'California State University Northridge',
            CSUNImg: window.baseUrl + '/img/dataimgbanner/csun.jpg',
            CSUImg: '',
        }
    },
    components: {campusModal}
}

</script>