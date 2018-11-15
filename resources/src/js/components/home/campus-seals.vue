<template>
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-5 mb-5 home__subheading">
            <h3 class="text-center font-italic"> Endorsed by several CSUs, CalStatePays combines the data of soCal's top public universities
            </h3>
        </div>
        <div class="row no-gutters homepage-seals mt-4">
            <figure  v-for="(item, index) in universitySeals" :key="index" class="col-md col-sm-3 col-3">
                <img :src="item.url" :alt="item.name">
                <figcaption class="text-center" >{{item.name}}</figcaption>
            </figure>
        </div>  
    </div>
</div>

</template>

<script>
export default {
    name: "campus-seals",
    data() {
        return {
            url: "",
            isShowing: false,
            universitySeals:[
                {url: window.baseUrl + '/img/csuseals/long_beach_seal.svg',name:'Long Beach'},
                {url: window.baseUrl + '/img/csuseals/poly_seal.svg',name:'Pomona'},
                {url: window.baseUrl + '/img/csuseals/fullerton_seal.svg',name:'Fullerton'},
                {url :window.baseUrl+ '/img/csuseals/northridge_seal.svg',name:'Northridge'},
                {url: window.baseUrl + '/img/csuseals/dominguez_seal.svg',name:'Dominguez Hills'},
                {url: window.baseUrl + '/img/csuseals/los_angeles_seal.svg',name:'Los Angeles'},
                {url: window.baseUrl + '/img/csuseals/channel_islands_seal.svg',name:'Channel Islands'},                
            ]
        };
    },
}
</script>

