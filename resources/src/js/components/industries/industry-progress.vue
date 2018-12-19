<template>
    <div>
        <div v-if="industryIsLoading" class="form-group row">
            <v-progress-circular class="loading-icon"
                    :size="100"
                    :width="10"
                    indeterminate
            ></v-progress-circular>
        </div>
        <div v-else>
            <div v-if="industryMajor == null || industriesByMajor == null">
                <h3 class="industry-title text-center p-md-3">Please make your selection</h3>
                <p class="lead pl-md-5 pr-md-5">
                    You have the option of either filtering out majors by <span class="font-weight-bold">discipline</span> or choosing the <span class="font-weight-bold">major</span>
                    which resonates the most with you.
                </p>
                <p class="lead pl-md-5 pr-md-5">
                    <span class="font-weight-bold">Please Note:</span> Some majors might not have any data available at the moment.
                    For more information on how we gathered the data, please read the <router-link to="/faq">FAQ</router-link>.
                </p>
            </div>
            <div v-else>
                <div class="row IndustryLegend">
                    <div v-if="industryMajor !== null" class="col-12">
                        <h3>{{industryMajor}}</h3>
                    </div>
                    <div v-if="industriesByMajor.length > 0" class="col-12">
                        <p class="h6">Employment 5 Years After Exit</p>
                    </div>
                    <div v-if="industriesByMajor.length > 0" class="col-sm-12 col-md-4 offset-md-3">
                        <span class="IndustryLegend__LegendPercentage"></span>Percentage of Students Employed
                    </div>
                    <div v-if="industriesByMajor.length > 0" class="col-sm-12 col-md-5">
                        <span class="IndustryLegend__LegendSalary"></span>Average Earnings
                    </div>
                    <div v-if="industriesByMajor.length === 0" class="col-12">
                        <p class="lead pl-md-5 pr-md-5" >No data is available for this selected Degree Level.</p>
                        <p class="lead pl-md-5 pr-md-5">Please see the <router-link to="/faq">FAQ</router-link> section for more information on
                            how we collected the data.</p>
                    </div>
                </div>
                <div v-for="(industry, index) in industriesByMajor" :key="index">
                    <div class="row IndustryProgressBarWrapper">
                        <div class="col-sm-3">
                            <h3 class="IndustryProgressBarWrapper__IndustryTitle py-2">
                                {{industry.title}}
                            </h3>
                        </div>
                        <div class="col-sm-9">
                            <div class="row py-2">
                                <div class="col-10">
                                    <v-progress-linear class="IndustryProgressBarWrapper__ProgressBarBase" :value="industry.percentage" height="25" color="IndustryProgressBarWrapper__PercentageBar" background-color="IndustryProgressBarWrapper__PercentageBar--Background"/>
                                </div>
                                <div class="col-2 pl-0">
                                    <p class="IndustryProgressBarWrapper__PercentageText">
                                        {{industry.percentage}}%
                                    </p>
                                </div>
                            </div>
                            <div class="row py-2">
                                <div class="col-10">
                                    <v-progress-linear class="IndustryProgressBarWrapper__ProgressBarBase" :value="industry.industryWage/1500" height="25" color="IndustryProgressBarWrapper__SalaryBar" background-color="IndustryProgressBarWrapper__PercentageBar--Background"/>
                                </div>
                                <div class="col-2 pl-0">
                                    <p class="IndustryProgressBarWrapper__SalaryText">
                                        ${{formatDollars(industry.industryWage)}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import { mapGetters } from "vuex";
    export default {
        methods: {
            formatDollars(input) {
                let dollarAmount = input.toString();
                let hundreds = dollarAmount.substr(-3,3);
                let thousands = dollarAmount.slice(0,-3);
                return thousands + ',' + hundreds;
            }
        },
        computed: {
            ...mapGetters([
                "industriesByMajor",
                "industryMajor",
                "industryIsLoading"
            ])
    }
    };
</script>