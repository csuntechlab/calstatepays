<template>
  <div @keyup.enter="showModal= false">
      <button @click="showModal = true" role="button">
                <slot name="change button"></slot>
            </button>
        
<v-dialog  v-model="showModal">

            <v-card  class=" text-xs-center black--text">
                <v-card-title class="headline grey lighten-2 ">
                    Choose Your Campus
                </v-card-title>
                <v-card-text class="campus-modal">
                    <div class="row" >
                        <div class="col-12 col-sm" v-for="(item, index) in universities" :key="index">      
                                <figure  @click="changeCampus(item.university_id);">
                                <img :src= item.url role="button" class="btn">    
                                <figcaption>{{item.name}}</figcaption>                    
                                </figure>
                        </div>
                    </div>
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