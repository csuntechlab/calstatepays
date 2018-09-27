<template>
    <div>
       <header class="align-items-center researchMainBanner ">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="text-center home__heading">
                            We Gathered Data Across 7 CSUs in the Metro LA Area
                        </h1>
                    </div>
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
                <div class="row text-center">
                    <div class="col-12">
                        <button class="btn btn-success">
                        All Campuses
                        </button>
                    </div>
                </div>     
            </div>      
        </header>
        <main class="row">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <router-link to="research" class="returnToCampusSelection">
                            <h2>
                                <i class="fas fa-arrow-left"></i> Return to CSU Campus Selection
                            </h2>
                        </router-link>
                    </div>
                </div>
                <div class="row">
                    <div class='tableauPlaceholder' id='viz1531346960828' style='position: relative'>
                        <noscript>
                            <a href='https://www.sandbox.csun.edu/metalab/csumetrola#/'>
                                <img alt='Labor Market Outcomes for CSUN StudentsPost Education Earnings Data and Industries of Employment After Exit ' src='https://public.tableau.com/static/images/Ca/CalStatePays-CSUNEarningsOverTimeandIndustriesofEmployment/CSUNLaborMarketOutcomes/1_rss.png' style='border: none' />
                            </a>
                        </noscript>
                        <object class='tableauViz'  style='display:none;'><param name='host_url' value='https%3A%2F%2Fpublic.tableau.com%2F' />
                            <param name='embed_code_version' value='3' />
                            <param name='site_root' value='' />
                            <param name='name' value='CalStatePays-CSUNEarningsOverTimeandIndustriesofEmployment/CSUNLaborMarketOutcomes' />
                            <param name='tabs' value='no' />
                            <param name='toolbar' value='yes' />
                            <param name='static_image' value='https://public.tableau.com/static/images/Ca/CalStatePays-CSUNEarningsOverTimeandIndustriesofEmployment/CSUNLaborMarketOutcomes/1.png' />
                            <param name='animate_transition' value='yes' />
                            <param name='display_static_image' value='yes' />
                            <param name='display_spinner' value='yes' />
                            <param name='display_overlay' value='yes' />
                            <param name='display_count' value='yes' />
                            <param name='filter' value='publish=yes' />
                        </object>
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
    },
    mounted() {
        var divElement = document.getElementById('viz1531346960828');
        var vizElement = divElement.getElementsByTagName('object')[0];
        vizElement.style.width='1016px';
        vizElement.style.height='991px';
        var scriptElement = document.createElement('script');
        scriptElement.src = 'https://public.tableau.com/javascripts/api/viz_v1.js';
        vizElement.parentNode.insertBefore(scriptElement, vizElement);
    }
}
</script>
