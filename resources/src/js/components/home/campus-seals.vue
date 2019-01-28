<template>
    <div class="homeSeals">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <h3 class="text-center font-italic">
                        <span class="homepageUniversities__headline"> Endorsed by 7 CSUs,</span>
                        <span class="homepageUniversities__headline"> CalStatePays combines</span>
                        <span class="homepageUniversities__headline"> the data of</span>
                        <span class="homepageUniversities__headline"> SoCal's top public universities</span>
                    </h3>
                </div>
                <div class="row no-gutters">
                    <figure  v-for="(item, index) in universitySeals" :key="index" class="col-md col-sm-3 col-3">
                        <img :src="item.url + '?version=' + getTimeStamp" :alt="item.alt">
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
                {url: window.baseUrl + '/img/csuseals/long_beach_seal.svg',name:'Long Beach',alt:'Cal State Long Beach Seal'},
                {url: window.baseUrl + '/img/csuseals/poly_seal.svg',name:'Pomona',alt:'Cal State Pomona Seal'},
                {url: window.baseUrl + '/img/csuseals/fullerton_seal.svg',name:'Fullerton',alt:'Cal State Fullerton Seal'},
                {url :window.baseUrl+ '/img/csuseals/northridge_seal.svg',name:'Northridge',alt:'Cal State Northridge Seal'},
                {url: window.baseUrl + '/img/csuseals/dominguez_seal.svg',name:'Dominguez Hills',alt:'Cal State Dominguez Hills Seal'},
                {url: window.baseUrl + '/img/csuseals/los_angeles_seal.svg',name:'Los Angeles',alt:'Cal State Los Angeles Seal'},
                {url: window.baseUrl + '/img/csuseals/channel_islands_seal.svg',name:'Channel Islands',alt:'Cal State Channel Islands Seal'},                
            ]
        };
    },
    computed: {
        getTimeStamp() {
            return `${moment().get('year')}${moment().get('hour')}${moment().get('minute')}${moment().get('second')}`;
        }
    }
}
</script>

