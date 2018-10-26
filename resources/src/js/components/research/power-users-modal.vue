<template>
    <v-dialog  v-model="dialog" width="500" persistent>
      <v-card  >
        <v-card-title
          class="headline grey lighten-2 justify-content-between"
          primary-title
        >
          <b>Labor Market Out Comes for CSU 7</b> <i role="button"   @click="dialog = false" class="fa fa-times "></i>
        </v-card-title>

        <v-card-text>
            <div class="d-flex">
                <i class="fa fa-graduation-cap fa-5x"></i> 
                <div>
                    <span class="d-block">Earnings by Major + Industires of Employment</span>
                    <router-link to = "researchcall">
                        <button type="button" class="h-50 btn btn-success">Success</button>          
                    </router-link>
                </div>
            </div>
        

        <v-divider></v-divider>
       
          <div class="d-flex">
                <i class="fa fa-child fa-2x"></i>
                <i class="fa fa-male fa-3x"></i>
                <!-- <i class="fa fa-graduation-cap fa-5x"></i>  -->
                <div>
                    <span class="d-block">Earnings by Age at Entry + Industires of Employment</span>
                    <router-link to = "researchcall">
                        <button type="button" class="h-50 btn btn-success">Success</button>          
                    </router-link>
                </div>
            </div>
    
        <v-divider></v-divider>
          <div class="d-flex">
                <i class="fa fa-graduation-cap fa-5x"></i> 
                <div>
                    <span class="d-block">Earnings by Race + Industires of Employment</span>
                    <router-link to = "researchcall">
                        <button type="button" class="h-50 btn btn-success">Success</button>          
                    </router-link>
                </div>
            </div>

        <v-divider></v-divider>
          <div class="d-flex">
                <i class="fa fa-graduation-cap fa-5x"></i> 
                <div>
                    <span class="d-block">Earnings by Gender + Industires of Employment</span>
                    <router-link to = "researchcall">
                        <button type="button" class="h-50 btn btn-success">Success</button>          
                    </router-link>
                </div>
            </div>

        <v-divider></v-divider>
          <div class="d-flex">
                <i class="fa fa-graduation-cap fa-5x"></i> 
                <div>
                    <span class="d-block">Earnings by Pell Status at Entry + Industires of Employment</span>
                    <router-link to = "researchcall">
                        <button type="button" class="h-50 btn btn-success">Success</button>          
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
    name: 'power-users-modal',
     data(){
        return{
            dialog  :false
        }
    },
}
</script>
