<template>
    <header class="CSUDataImgBanner" v-bind:style="{ backgroundImage: 'linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65)), url(' + CSUNImg + ')', }">
        <div class="container">
            <div class="row justify-content-start">
                <div class="CSUDataImgBanner__campusInfoWrapper col-12">
                    <h1 class="CSUDataImgBanner__campusTitle"> {{getCampusName}}</h1>
                    <div data-app>
                        <campus-modal>
                            <span slot="change button" class="CSUDataImgBanner__changeCampus font-weight-bold" href="#">Change Campus</span>
                        </campus-modal>
                    </div>
                </div>
                <div class="CSUDataImgBanner__dataInfoWrapper col-12 col-md-10 col-lg-8 col-xl-6">
                    <slot name="title"></slot>
                    <slot name="copy"></slot>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
import {mapGetters} from 'vuex';
import campusModal from './campus-modal.vue';
export default {
    computed: {
        ...mapGetters([
            'selectedUniversity',
            'universities'
            ]),
        getCampusName() {
            var selectedUniversity = this.selectedUniversity;

            var currentName = "";
            this.universities.forEach(university => {
                if(selectedUniversity===(university.short_name)) {
                    currentName = university.university_name;
                }
            });
            return currentName;
        }
        
    }, 
    data() {
        return {
            CSUNImg: window.baseUrl + '/img/campusbanners/csun.jpg',
            CSUImg: '',
        }
    },
    components: {campusModal}
}

</script>