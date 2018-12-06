 <template>
    <div>
        <power-banner/>
        <power-users-modal :showModal=displayModal :university=university  v-on:closeModal="closeModal($event)"></power-users-modal>
        <main>
            <div class="container">
                <div>
                    <div class="col-12">
                        <h2 class="returnToCampusSelection">
                            Select a CSU
                        </h2>
                    </div>
                </div>
                <div class="row justify-content-start justify-content-xl-center">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 py-3">
                            <div id="allcampus" class="campus not-avail" @click="displayModal = true; id=0;">
                                <h3>Aggregate Data Across the 7 CSUs</h3>
                            </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 py-3">
                                <div id="csun" class="campus" @click="displayModal = true ; id=70  ;">
                                    <h3>California State University Northridge</h3>
                                </div>
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
import powerUsersModal from '../../../components/research/power-users-modal'
import {mapGetters} from 'vuex';
export default {
    data(){
        return{
            displayModal:false,
            // universityName:'',
            universityLink:'',
            selectedUniversity:'',
            id:0
        }
    },methods:{
        closeModal(){
            this.displayModal = false;
        }
    },computed:{
        ...mapGetters(['universityById']),
        university(){
            return this.universityById(this.id)
        }
    },
    
  components: {
      powerBanner,
      powerUsersModal
  }
};
</script>
