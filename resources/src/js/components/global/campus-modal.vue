<template>
<div>
    <div @keyup.enter="showModal= false">
        <button @click="showModal = true" role="button">
                <slot name="change button"></slot>
        </button>
        <v-dialog v-model="showModal" persistent aria-modal="true">
            <v-card  class=" text-xs-center black--text" v-if="universities[0]">
                <v-card-title class="headline grey lighten-2 ">
                    Choose Your Campus
                </v-card-title>
                <v-card-text class="campus-modal">
                    <div class="row" >
                        <div class="col-12 col-sm" v-for="(item, index) in universitySeals" :key="index">      
                            <figure v-if="universities[index].opt_in === '1'"  @click="changeCampus(universities[index].short_name);">
                                <img :src= item.url role="button" class="btn opted-in">   
                                <figcaption>{{item.name}}</figcaption>
                            </figure>
                            <figure v-else class="opted-out"> 
                                <img :src= item.url role="button" class="btn">   
                                <figcaption>{{item.name}} <br> <small>(Coming Soon)</small></figcaption>
                            </figure>
                        </div>
                    </div>
                </v-card-text>
            </v-card>
        </v-dialog>
    </div>
</div>  
</template>
<script>
import {  mapActions, mapGetters  } from 'vuex';
export default {
    name: 'campus-modal',
    data(){
        return {
            showModal :false,
            universitySeals:[
                {url: window.baseUrl + '/img/csuseals/fullerton_seal.svg',name:'Fullerton'},
                {url: window.baseUrl + '/img/csuseals/long_beach_seal.svg',name:'Long Beach'},
                {url: window.baseUrl + '/img/csuseals/los_angeles_seal.svg',name:'Los Angeles'},
                {url: window.baseUrl + '/img/csuseals/dominguez_seal.svg',name:'Dominguez'},
                {url: window.baseUrl + '/img/csuseals/poly_seal.svg',name:'Pomona'},
                {url :window.baseUrl+ '/img/csuseals/northridge_seal.svg',name:'Northridge'},
                {url: window.baseUrl + '/img/csuseals/channel_islands_seal.svg',name:'Channel Island'},
                {url: "https://via.placeholder.com/123x112?",
                name: "All Campuses"
                }
            ]
        }
    },
    mounted(){
        this.checkSessionData();
    },
    computed:{
        ...mapGetters([
            'universities',
            'selectedUniversity',
            'selectedDataPage',
            'modalCheck'
        ]),
        
    },
    methods:{
        ...mapActions([
            'setUniversity'
        ]),
        changeCampus: function(university){
        if (this.selectedUniversity != university){
            sessionStorage.setItem("selectedUniversity", university);
            this.$store.dispatch('setUniversity', university);
            this.$store.dispatch('resetMajorState');
            this.$store.dispatch('resetIndustryState');
            this.$store.dispatch('resetFreState');
            this.$store.dispatch('fetchMajors', university);
            this.$store.dispatch('fetchFieldOfStudies', university);
        }
            this.showModal = false;
        },
        checkSessionData() {
            var sessionData = sessionStorage.getItem("selectedUniversity");
            if(sessionData === null){
                this.showModal = true;
            }
            else {
            this.$store.dispatch("setUniversity", sessionData);
            }
        }
    }

}
</script>
