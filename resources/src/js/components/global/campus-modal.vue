<template>
<div>
    <div @keyup.enter="showModal= false">
        <button class="btn-change-campus" @click="showModal = true" role="button">
                <slot name="change button"></slot>
        </button>
        <v-dialog v-model="showModal" persistent aria-modal="true">
            <v-card  class=" text-xs-center black--text" v-if="universities[0]">
                <v-card-title class="headline grey lighten-2 ">
                    Choose a Campus
                </v-card-title>
                <v-card-text class="campus-modal">
                    <form v-on:submit.prevent="onSubmit()">
                        <div class="row" >
                            <div class="col-12 col-sm" v-for="(item, index) in universitySeals" :key="index">
                                <!-- @click="changeCampus(universities[index].short_name);" -->
                                <div v-if="universities[index].opt_in === 1">
                                    <input type="radio" name="campuses" :id="universities[index].short_name" :data-shortname="universities[index].short_name">  
                                    <label :for="universities[index].short_name">    
                                        <figure>
                                            <img :src="item.url" role="button" class="btn opted-in">   
                                            <figcaption>{{item.name}}</figcaption>
                                        </figure>
                                    </label>
                                </div>
                                <div v-else class="opted-out"> 
                                    <figure> 
                                        <img :src= item.url role="button" class="btn">   
                                        <figcaption>{{item.name}} <br> <small>(Coming Soon)</small></figcaption>
                                    </figure>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="campus-modal__error" id="campus-modal__error">
                                * Select a campus to proceed
                            </div>
                            <div v-if="anIndustryIsSelected">
                                <span class="btn btn-secondary" @click="showModal = false">Cancel</span>
                            </div>                            
                            <div>
                                <button type="submit" class="btn btn-primary">Select Campus</button>
                            </div>
                        </div>
                    </form>
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
            anIndustryIsSelected: false,
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
                name: "CSU7"
                }
            ]
        }
    },
    mounted(){
        this.$nextTick(function () {
            this.checkSessionData();
            this.onClickOutsideModal();
        })
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
        onClickOutsideModal: function() {
            var self = this;
            document.addEventListener('click', function (event) {
                if( event.target.classList.contains("v-overlay") ) {
                    if(self.anIndustryIsSelected == true) {
                        self.showModal = false;
                    } else {
                        self.onSubmit();
                    }
                }
            }, false);
        },
        onSubmit: function(){
            var radioBtns = document.querySelectorAll("[name='campuses']")
            var validationMsg = document.getElementById("campus-modal__error");

            for(var i = 0; i < radioBtns.length; i++) {
                if( radioBtns[i].checked ) {
                    this.changeCampus(radioBtns[i].id);
                    validationMsg.classList.remove("active");
                    return
                } else {
                    validationMsg.classList.add("active");
                }
            }
        },
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
            this.anIndustryIsSelected = true;
        },
        checkSessionData() {
            var sessionData = sessionStorage.getItem("selectedUniversity");
            if(sessionData === null){
                this.showModal = true;
                this.anIndustryIsSelected = false;
            }
            else {
                this.$store.dispatch("setUniversity", sessionData);
                this.anIndustryIsSelected = true;
            }
        }
    }
}
</script>
