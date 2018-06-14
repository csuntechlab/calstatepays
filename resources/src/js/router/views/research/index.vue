<template>
    <div>
        <div class="row">
            <header id="research-main-banner" class="row">
                <div class="col align-self-center">
                    <div class="row">
                        <h1 class="text-center home__heading">
                            We Gathered Data Across 7 CSUs in the Metro LA Area
                        </h1>
                    </div>
                    <div class="row mt-2 csu-wrapper">
                        <figure class="col-md col-sm-4 col-4 text-center">
                            <img :src="this.url + '/img/csuseals/long_beach_seal.svg'" alt="CSU Long Beach Seal">
                            <figcaption>Long Beach</figcaption>
                        </figure>
                        <figure class="col-md col-sm-4 col-4 text-center">
                            <img :src="this.url + '/img/csuseals/poly_seal.svg'" alt="CSU Pomona Seal">
                            <figcaption>Pomona</figcaption>
                        </figure>
                        <figure class="col-md col-sm-4 col-4 text-center">
                            <img :src="this.url + '/img/csuseals/dominguez_seal.svg'" alt="CSU Dominguez Hills Seal">
                            <figcaption>Dominguez Hills</figcaption>
                        </figure>
                        <figure class="col-md col-sm-4 col-4 text-center">
                            <img :src="this.url + '/img/csuseals/northridge_seal.svg'" alt="CSU Northridge Seal">
                            <figcaption>Northridge</figcaption>
                        </figure>
                        <figure class="col-md col-sm-4 col-4 text-center">
                            <img :src="this.url + '/img/csuseals/channel_islands_seal.svg'" alt="CSU Channel Islands Seal">
                            <figcaption>Channel Islands</figcaption>
                        </figure>
                        <figure class="col-md col-sm-4 col-4 text-center">
                            <img :src="this.url + '/img/csuseals/fulleton_seal.svg'" alt="CSU Fullerton Seal">
                            <figcaption>Fullerton</figcaption>
                        </figure>
                        <figure class="col-md col-sm-4 col-4 text-center">
                            <img :src="this.url + '/img/csuseals/los_angeles_seal.svg'" alt="CSU Los Angeles Seal">
                            <figcaption>Los Angeles</figcaption>
                        </figure>
                    </div>
                    <div class="row">
                        <button class="btn btn-success mb-3">
        -                   All Campuses
        -               </button>
                    </div>
                </div>
            </header>
        </div>
        
        <main class="campuses-container">
            <div class="row justify-content-start justify-content-xl-center">
                <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 py-3">
                    <div id="csun" class=" campus">
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
        </main>
    </div>
</template>
<script>
export default {
    data () {
        return {
            url: ''
        }
    },
    created () {
        this.url = window.baseUrl;
    }
}
</script>
