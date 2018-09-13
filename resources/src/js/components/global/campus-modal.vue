<template>
  <div>
      <button @click="showModal = true" role="button">
                <slot name="change button"></slot>
            </button>

        <v-dialog v-model="showModal" persistent scrollable>

            <v-card  class=" text-xs-center mt-5 black--text">
                <v-card-title class="headline grey lighten-2 ">
                    Choose Your Campus
                </v-card-title>
                <v-card-text class="campus-modal">
                    <v-layout row wrap>
                        <v-flex xs v-for="(item, index) in universities" :key="index">      
                            <v-btn class="h-75" @click="changeCampus(item.university_id);">
                            <img :src= item.url >
                            </v-btn>     
                            <figcaption>{{item.name}}</figcaption>                    
                        </v-flex>
                    </v-layout>
            </v-card-text>
        </v-card> 
        </v-dialog>
       
  </div>
</template>
<script>
import {  mapActions, mapGetters  } from 'vuex';
export default {
    name: 'campus-modal',
    data(){
        return {
            showModal :false,
            str:this.$store.selectedUniversity,
            universities:[
                {url: window.baseUrl + '/img/csuseals/channel_islands_seal.svg',university_id:'039803',name:"Channel Island"},
                {url: window.baseUrl + '/img/csuseals/dominguez_seal.svg',university_id:'001141',name:'Dominguez Hills'},
                {url: window.baseUrl + '/img/csuseals/fullerton_seal.svg',university_id:'001137',name:'Fullerton'},
                {url: window.baseUrl + '/img/csuseals/long_beach_seal.svg',university_id:'001139',name:'Long Beach'},
                {url: window.baseUrl + '/img/csuseals/los_angeles_seal.svg',university_id:'001140',name:'Los Angeles'},
                {url :window.baseUrl+ '/img/csuseals/northridge_seal.svg',university_id:'70',name:'Northridge'},
                {url: window.baseUrl + '/img/csuseals/poly_seal.svg',university_id:'001144',name:'Pomona'}
            ]
        }
    },
    mounted(){
        if(this.selectedUniversity == null){
            this.showModal = true;
        }

    },
    computed:{
        ...mapGetters([
            'selectedUniversity',
            'selectedDataPage'
        ])
    },
    methods:{
        ...mapActions([
            'setUniversity'
        ]),
        changeCampus: function(university){

          this.$store.dispatch('setUniversity',university);
          this.showModal = false;
        }
    }

}
</script>
// C:\Users\zanee\docker\CSU-Metro-LA\public>
// C:\Users\zanee\docker\CSU-Metro-LA  \resources\src\js\components\global\campus-modal.vue