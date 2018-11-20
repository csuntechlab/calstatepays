<template>
    <v-dialog width="800" v-model="dialog" >
      <v-card  >
        <v-card-title
          class="headline grey lighten-2  row  no-gutters"
          primary-title
        >
          <h1 class="col-11"> Market Outcomes for  {{universityName}} </h1>
          <i role="button"   @click="closeModal();" class="fa fa-times text-center col-1 "></i>
        </v-card-title>
        <v-card-text>
            <div class="row">
                <i class="col-3 fa fa-university fa-5x" ></i> 
               <div class="col-9">
                    <span class="d-block">Earnings by Major + Industries of Employment</span>
                    <router-link  :to="{name:'all' ,params:{tableauValue:tableauValue.byMajor}}">
                        <button @click="apple()" type="button" class="power-user-modal-btn btn-success">View Data</button>          
                    </router-link>
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
                    <router-link :to="{name:'all' ,params:{tableauValue:tableauValue.byAge}}">
                    <button type="button" class=" power-user-modal-btn btn-success">View Data</button>          
                    </router-link>
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
                    <router-link :to="{name:'all' ,params:{tableauValue:tableauValue.byRace}}">
                        <button type="button" class=" power-user-modal-btn btn-success">View Data</button>          
                    </router-link>
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
                    <router-link :to="{name:'all' ,params:{tableauValue:tableauValue.byGender}}">
                        <button type="button" class="power-user-modal-btn btn-success">View Data</button>          
                    </router-link>
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
                    <router-link :to="{name:'all' ,params:{tableauValue:tableauValue.byPellStatus}}">
                        <button type="button" class="power-user-modal-btn btn-success">View Data</button>          
                    </router-link>
                </div>
            </div>
        </v-card-text>
        <v-divider></v-divider>
      </v-card>
    </v-dialog>
</template>
<script>
import {mapGetters} from 'vuex';
export default {
    props:['showModal','selectedUniversity','universityName'],
    name: 'power-users-modal',
     data(){
        return{
            str:'researchcsun',
            tabl:'CSU7LaborMarketOutcomes-ByMajor/CSU7AggregareEarningsData'
        }
    },methods:{
        closeModal:function(){
            this.$emit('closeModal')
        },
        apple(){
            console.log(22222)
        }
    },computed:{
        ...mapGetters([
            "universityById"
        ]),
        dialog:{
            get:function(){
                return this.showModal;
            },
            set:function(){
                this.$emit('closeModal',false)
            }
        },
        tableauValue(){
            if(this.selectedUniversity == 'csu7'){
                return {
                    byMajor:'CSU7LaborMarketOutcomes-ByMajor/CSU7AggregareEarningsData',
                    byAge:'',
                    byRace:'CSU7byRaceNOV142018/Story1',
                    byGender:'CSU7byGenderNOV132018/CSU7byGender',
                    byPellStatus:''
            }
            }
            else if(this.selectedUniversity =='northridge'){
                return {
                    byMajor:'CSUNLaborMarketOutcomes-ByMajor/CSUNbyMajor',
                    byAge:'',
                    byRace:'',
                    byGender:'',
                    byPellStatus:''
                }
            }else{
                return {
                    byMajor:'',
                    byAge:'',
                    byRace:'',
                    byGender:'',
                    byPellStatus:''
                }
            }
        }   
    }
    
}
</script>