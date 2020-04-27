<template>
    <div class="homeSeals">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <h2 class="text-center font-italic">
                        <span class="homepageUniversities__headline"> Endorsed by 7 CSUs,</span>
                        <span class="homepageUniversities__headline"> CalStatePays combines</span>
                        <span class="homepageUniversities__headline"> the data of</span>
                        <span class="homepageUniversities__headline"> SoCal's top public universities</span>
                    </h2>
                </div>
                <div class="row no-gutters">
                    <figure  v-for="(item, index) in universitySeals" :key="index" class="col-md col-sm-3 col-3 homepageUniversities__svg" @click="handleUniversitySealClick(item.admission)">
                        <img :src="item.url" :alt="item.alt">
                        <figcaption class="text-center" >{{item.name}}</figcaption>
                    </figure>
                </div>  
            </div>
        </div>
    </div>
</template>

<script>
import moment from 'moment';
export default {
    name: "campus-seals",
    data() {
        return {
            url: "",
            isShowing: false,
            universitySeals:[
                {url: window.baseUrl + '/img/csuseals/long_beach_seal.svg',name:'Long Beach',alt:'',admission:'http://www.csulb.edu/admissions'},
                {url: window.baseUrl + '/img/csuseals/poly_seal.svg',name:'Pomona',alt:'',admission:'https://www.cpp.edu/admissions/index.shtml'},
                {url: window.baseUrl + '/img/csuseals/fullerton_seal.svg',name:'Fullerton',alt:'',admission:'http://admissions.fullerton.edu/'},
                {url :window.baseUrl+ '/img/csuseals/northridge_seal.svg',name:'Northridge',alt:'',admission:'https://www.csun.edu/admissions-records'},
                {url: window.baseUrl + '/img/csuseals/dominguez_seal.svg',name:'Dominguez Hills',alt:'',admission:'https://www.csudh.edu/records-registration/'},
                {url: window.baseUrl + '/img/csuseals/los_angeles_seal.svg',name:'Los Angeles',alt:'',admission:'http://www.calstatela.edu/admissions'},
                {url: window.baseUrl + '/img/csuseals/channel_islands_seal.svg',name:'Channel Islands',alt:'',admission:'https://www.csuci.edu/admissions/'},                
            ]
        };
    },
    methods: {
        handleUniversitySealClick(admission){
            window.open(admission, '_blank')
        }
    }
}
</script>

