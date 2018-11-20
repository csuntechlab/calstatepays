<template>
    <div>
        <div class="row IndustryLegend">
            <div v-if="industryMajor !== null" class="col-12">
                <h3>{{industryMajor}}</h3>
            </div>
            <div class="col-md-3 offset-md-3 col-sm-6">
                <div class="IndustryLegend__LegendPercentage"/>PERCENTAGE
            </div>
            <div class="col-sm-6">
                <div class="IndustryLegend__LegendSalary"/>AVERAGE EARNINGS
            </div>
        </div>
        <div v-for="(industry,index) in industriesByMajor" :key="index">
            <div v-if="industry.percentage > 0 || industry.industryWage != null" class="row IndustryProgressBarWrapper">
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
                        <div v-if="industry.percentage > 0 && industry != null" class="col-2 pl-0">
                            <p class="IndustryProgressBarWrapper__PercentageText">
                                {{industry.percentage}}%
                            </p>
                        </div>
                        <div v-else-if="industry.percentage > 0" class="col-2 pl-0">
                            <p class="IndustryProgressBarWrapper__PercentageText">
                                N/A
                            </p>
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col-10">
                            <v-progress-linear class="IndustryProgressBarWrapper__ProgressBarBase" :value="industry.industryWage/1500" height="25" color="IndustryProgressBarWrapper__SalaryBar" background-color="IndustryProgressBarWrapper__PercentageBar--Background"/>
                        </div>
                        <div v-if="industry.industryWage != null" class="col-2 pl-0">
                            <p class="IndustryProgressBarWrapper__SalaryText">
                                ${{formatDollars(industry.industryWage)}}
                            </p>
                        </div>
                        <div v-else-if="industry.industryWage === null" class="col-2 pl-0">
                            <p class="IndustryProgressBarWrapper__SalaryText">
                                N/A
                            </p>
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
            "industryMajor"
        ]),

	}
};
</script>