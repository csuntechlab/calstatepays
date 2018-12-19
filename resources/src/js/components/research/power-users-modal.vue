<template>
    <v-dialog width="800" v-model="dialog" >
    <v-card>
        <v-card-title
        class="headline grey lighten-2  row  no-gutters"
        primary-title
        >
        <h1 v-if="university" class="col-11"> Market Outcomes for  {{university.name}} </h1>
        <i role="button"   @click="closeModal();" class="fa fa-times text-center col-1 "></i>
        </v-card-title>
        <v-card-text>
            <div v-bind:class="{'tableau-loading':tableauIsLoading}">
                <div class="row">
                    <i class="col-3 fa fa-university fa-5x" ></i> 
                    <div class="col-9">
                        <span class="d-block">Earnings by Major + Industries of Employment</span>
                            <button @click="chooseTableauCategory(university.short_name,1)"  type="button" class="power-user-modal-btn btn-success">View Data</button>          
                    </div>
                </div>
                <v-divider></v-divider>
                <div class="row">
                    <div class="col-3">
                        <i class="fa fa-child fa-2x"></i>
                        <i class="fa fa-male fa-5x"></i>
                    </div>
                    <div class="col-9">
                        <span class="d-block">Earnings by Age at Entry + Industries of Employment</span>
                        <button @click="chooseTableauCategory(university.short_name,2)"  type="button" class=" power-user-modal-btn btn-success">View Data</button>          
                    </div>
                </div>            
                <v-divider></v-divider>
                <div class="row">
                    <div class="col-3">
                        <i class="fa fa-male fa-5x brown--text"></i>
                        <i class="fa fa-male fa-5x blue--text"></i>
                    </div>
                    <div class="col-9">
                        <span class="d-block">Earnings by Race + Industries of Employment</span>
                            <button @click="chooseTableauCategory(university.short_name,3)"  type="button" class=" power-user-modal-btn btn-success">View Data</button>          
                    </div>
                </div>
                <v-divider></v-divider>
                <div class="row"> 
                    <div class="col-3">
                        <i class="fa fa-mars fa-5x"></i>
                        <i class="fa fa-venus fa-5x"></i>
                    </div>               
                    <div class="col-9">
                        <span class="d-block">Earnings by Gender + Industries of Employment</span>
                            <button @click="chooseTableauCategory(university.short_name,4)" type="button" class="power-user-modal-btn btn-success">View Data</button>          
                    </div>
                </div >
                <v-divider></v-divider>
                <div class="row">
                    <div class="col-3">
                        <i class="fa fa-check fa-4x text-success"></i>
                        <i class="fa fa-times fa-4x text-danger"></i>
                    </div>
                    <div class="col-9">
                        <span class="d-block">Earnings by Pell Status at Entry + Industries of Employment</span>
                            <button @click="chooseTableauCategory(university.short_name,5)" type="button" class="power-user-modal-btn btn-success">View Data</button>          
                    </div>
                </div>
            </div>
        </v-card-text>
        <v-divider></v-divider>
    </v-card>
    </v-dialog>
</template>
<script>
import {mapGetters,mapActions} from 'vuex';
export default {
    props:['showModal','university'],
    name: 'power-users-modal',
        data(){
            return{
                str:'researchcsun',
            tabl:'CSU7LaborMarketOutcomes-ByMajor/CSU7AggregareEarningsData'
        }
    },
    created() {
        document.addEventListener('keyup', this.onEscKey)
    },
    methods:{
        ...mapActions([
            'setTableauValue'
        ]),
        closeModal:function(){
            this.$emit('closeModal')
        },
        onEscKey(event) {
            if( event.keyCode === 27 ) {
                this.closeModal()
            }
        },
        chooseTableauCategory(university,path_id,callback){
            this.$store.dispatch('setTableauValue', {university:university,path_id:path_id});
        }
    },computed:{
        ...mapGetters([
            "universityById",
            "tableauValue",
            "tableauIsLoading"
        ]),
        dialog:{
            get:function(){
                return this.showModal;
            },
            set:function(){
                this.$emit('closeModal',false)
            }
        },   
    }
    
}
</script>