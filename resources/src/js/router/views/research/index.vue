<template>
    <div>
        <power-banner/>
        <!-- <power-user-modal/> -->
        <main>
            <div class="container">
                 <v-dialog  v-model="dialog" width="500" persistent>
      <v-card  >
        <v-card-title
          class="headline grey lighten-2 justify-content-between row "
          primary-title
        >
          <b><p class="col-11">Labor Market Out Comes for CSU 7</p></b>
          <i role="button"   @click="dialog = false" class="fa fa-times col-1"></i>
        </v-card-title>

        <v-card-text>
            <div class="d-flex">
                <i class="fa fa-graduation-cap fa-5x"></i> 
                <div>
                    <span class="">Earnings by Major + Industires of Employment</span>
                    <router-link to = "researchcall">
                        <button type="button" class="h-50 btn btn-success">View Data</button>          
                    </router-link>
                </div>
            </div>
        

        <v-divider></v-divider>
       
          <div class="d-flex">
                <div>
                    <i class="fa fa-child fa-2x"></i>
                    <i class="fa fa-male fa-5x"></i>
                </div>
                <!-- <i class="fa fa-graduation-cap fa-5x"></i>  -->
                <div>
                    <span class="d-block">Earnings by Age at Entry + Industires of Employment</span>
                    <router-link to = "researchcall">
                        <button type="button" class="h-50 btn btn-success">View Data</button>          
                    </router-link>
                </div>
            </div>
    
        <v-divider></v-divider>
          <div class="d-flex">
                <i class="fa fa-male fa-5x"></i>
                <i class="fa fa-male fa-5x"></i>

                <div>
                    <span class="d-block">Earnings by Race + Industires of Employment</span>
                    <router-link to = "researchcall">
                        <button type="button" class="h-50 btn btn-success">View Data</button>          
                    </router-link>
                </div>
            </div>

        <v-divider></v-divider>
          <div class="d-flex">
                <i class="fa fa-venus fa-5x"></i>
                <i class="fa fa-mars fa-5x"></i>
                <div>
                    <span class="d-block">Earnings by Gender + Industires of Employment</span>
                    <router-link to = "researchcall">
                        <button type="button" class="h-50 btn btn-success">View Data</button>          
                    </router-link>
                </div>
            </div>

        <v-divider></v-divider>
          <div class="d-flex">
                <i class="fa fa-check fa-5x"></i>
                <i class="fa fa-times fa-5x"></i>
                <div>
                    <span class="d-block">Earnings by Pell Status at Entry + Industires of Employment</span>
                    <router-link to = "researchcall">
                        <button type="button" class="h-50 btn btn-success">View Data</button>          
                    </router-link>
                </div>
            </div>
        </v-card-text>

        <v-divider></v-divider>
      </v-card>
    </v-dialog>
                <div>
                    <div class="col-12">
                        <h2 class="returnToCampusSelection">
                            Select a CSU
                        </h2>
                    </div>
                </div>
                <div class="row justify-content-start justify-content-xl-center">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 py-3">
                            <div id="allcampus" class="campus not-avail" @click="dialog = true">
                                <!-- <p>Data Not Available At This Time</p> -->
                                <h3>Aggregate Data Across the 7 CSUs</h3>
                            </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 py-3">
                            <router-link to="researchcsun">
                                <div id="csun" class="campus">
                                    <h3>California State University Northridge</h3>
                                </div>
                            </router-link>
                        </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 py-3">
                        <div id="csulb" class="campus not-avail">
                            <p>Data Not Available At This Time</p>
                            <h3>California State University Long Beach</h3>
                        </div> 
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 py-3">
                        <div id="csula" class=" campus not-avail">
                            <p>Data Not Available At This Time</p>
                            <h3>California State University Los Angeles</h3>
                        </div>  
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 py-3">
                        <div id="csuf" class=" campus not-avail">
                            <p>Data Not Available At This Time</p>
                            <h3>California State University Fullerton</h3>
                        </div> 
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 py-3">
                        <div id="csudh" class=" campus not-avail">
                            <p>Data Not Available At This Time</p>
                            <h3>California State University Dominguez Hills</h3>
                        </div>  
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 py-3">
                        <div id="csuci" class=" campus not-avail">
                            <p>Data Not Available At This Time</p>
                            <h3>California State University Channel Island</h3>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 py-3">
                        <div id="csup" class=" campus not-avail">
                            <p>Data Not Available At This Time</p>
                            <h3>California State University Pomona</h3>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>
<script>
import powerBanner from '../../../components/research/power-banner'
import powerUsersModal from '../../../components/research/power-banner'
export default {
    data(){
        return{
            dialog  :false
        }
    },
  components: {
      powerBanner,
      powerUsersModal
  }
};
</script>
