<template>
    <header class="CSUDataImgBanner" v-bind:style="{ backgroundImage: 'linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65)), url(' + CSUNImg + ')', }">
        <div class="container">
            <div class="row justify-content-start">
                <div class="CSUDataImgBanner__campusInfoWrapper col-12">
                    <h2 class="CSUDataImgBanner__campusTitle"> {{getUnitName}}</h2>
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
import {mapGetters} from 'vuex';
export default {
    created: function(){
    },
    computed: {
        ...mapGetters([
            'selectedUniversity',
            'universities'
            ]),
        getUnitName() {
            var universityId = parseInt(this.selectedUniversity)
            var currentName = ""
            this.universities.forEach(university => {
                if(universityId===parseInt(university.id)) {
                    currentName = university.name
                }
            });
            return currentName;
        }
        
    }, 
    data() {
        return {
            CSUNImg: window.baseUrl + '/img/dataimgbanner/csun.jpg',
            CSUImg: '',
        }
    }
}
</script>