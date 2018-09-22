<template>
  <div @keyup.enter="showModal= false">
      <button @click="showModal = true" role="button">
                <slot name="change button"></slot>
            </button>
        
<v-dialog  v-model="showModal" persistent>

            <v-card  class=" text-xs-center black--text">
                <v-card-title class="headline grey lighten-2 ">
                    Choose Your Campus
                </v-card-title>
                <v-card-text class="campus-modal">
                    <div class="row" >
                        <div class="col-12 col-sm" v-for="(item, index) in universitySeals" :key="index">      
                                <figure  @click="changeCampus(universities[index].id);">
                                <img :src= item.url role="button" class="btn">    
                                <figcaption> {{item.name}}</figcaption>                    
                                </figure>
                        </div>
                        <!-- place holder for all button -->
                        <div class="col-12 col-sm">
                            <figure>
                                <img src=" https://via.placeholder.com/123x112?" role="button" class="btn">    
                                <figcaption>All campuses(Aot Available)</figcaption>                    
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
            universitySeals:[
                {url: window.baseUrl + '/img/csuseals/fullerton_seal.svg',name:'Fullerton'},
                {url: window.baseUrl + '/img/csuseals/long_beach_seal.svg',name:'Long Beach'},
                {url: window.baseUrl + '/img/csuseals/los_angeles_seal.svg',name:'Los Angeles'},
                {url: window.baseUrl + '/img/csuseals/dominguez_seal.svg',name:'Dominguez'},
                {url: window.baseUrl + '/img/csuseals/poly_seal.svg',name:'Pomona'},
                {url :window.baseUrl+ '/img/csuseals/northridge_seal.svg',name:'Northridge'},
                {url: window.baseUrl + '/img/csuseals/channel_islands_seal.svg',name:'Channel Island'},
            ]
        }
    },
    mounted(){
     if(this.modalCheck == false){
          this.showModal = true;
         this.$store.dispatch('setModalCheck',true);


    }

    },
    computed:{
        ...mapGetters([
            'universities',
            'selectedUniversity',
            'selectedDataPage',
            'modalCheck'
        ])
    },
    methods:{
        ...mapActions([
            'setUniversity',
            'setModalCheck'
        ]),
        changeCampus: function(university){

          this.$store.dispatch('setUniversity',university);
          this.showModal = false;
        }
    }

}
</script>
