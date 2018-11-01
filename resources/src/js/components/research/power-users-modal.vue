<template>
    <v-dialog width="800" v-model="dialog" >
      <v-card  >
        <v-card-title
          class="headline grey lighten-2 justify-content-between /flex-column-reverse /flex-md-row"
          primary-title
        >
          <h1> Market Out Comes for  {{universityName}} </h1>
          <i role="button"   @click="closeModal();" class="fa fa-times d-block     "></i>
        </v-card-title>
        <v-card-text>
            <div class="row">
                <i class="col-3 fa fa-university fa-5x" ></i> 
               <div class="col-9">
                    <span class="d-block">Earnings by Major + Industires of Employment</span>
                    <router-link :to="universityLink">
                        <button type="button" class="power-user-modal-btn btn-success">View Data</button>          
                    </router-link>
                </div>
            </div>
            <v-divider></v-divider>
            <div class="row"> <!--display flex/ jsutify content evenly? -->
                <div class="col-3">
                    <i class="fa fa-child fa-2x"></i>
                    <i class="fa fa-male fa-5x"></i>
                </div>
                <div class="col-9">
                    <span class="d-block">Earnings by Age at Entry + Industires of Employment</span>
                    <router-link :to="universityLink">
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
                    <span class="d-block">Earnings by Race + Industires of Employment</span>
                    <router-link :to="universityLink">
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
                    <span class="d-block">Earnings by Gender + Industires of Employment</span>
                    <router-link :to="universityLink">
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
                    <span class="d-block">Earnings by Pell Status at Entry + Industires of Employment</span>
                    <router-link :to="universityLink">
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
    props:['showModal','universityName','universityLink'],
    name: 'power-users-modal',
     data(){
        return{
            str:'researchcsun'
        }
    },methods:{
        closeModal:function(){
            this.$emit('closeModal')
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
    }
}
</script>
