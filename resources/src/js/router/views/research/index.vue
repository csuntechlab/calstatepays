<template>
    <div>
        <power-banner/>
        <main>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="returnToCampusSelection">
                            Select a CSU
                        </h2>
                    </div>
                </div>
                <div class="row justify-content-start justify-content-xl-center">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 py-3">
                        <div id="allcampus" class="campus not-avail">
                            <p>Data Not Available At This Time</p>
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
export default {
  components: {
      powerBanner
  }
};
</script>
