<template>
    <div>
       <power-banner/>
        <main class="row">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <router-link to="research" class="returnToCampusSelection">
                            <h2>
                                <i class="fa fa-arrow-left"></i> Return to CSU Campus Selection
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
import powerBanner from '../../../components/research/power-banner'
export default {
    data () {
        return {
            url: ''
        }
    },
    components: {
        powerBanner
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
