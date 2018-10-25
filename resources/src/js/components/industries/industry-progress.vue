<template>
    <div>
        <div class="row industry-card__legend">
            <div class="col-sm-3"></div>
            <div class="col-sm-4">
                <div class="industry-card__legend-percentage"/>PERCENTAGE
            </div>
            <div class="col-sm-5">
                <div class="industry-card__legend-salary"/>AVERAGE EARNINGS
            </div>
        </div>
        <div v-for="(industry,index) in industriesByMajor" :key="index ">
            <div v-if="industry.percentage != null || industry.industryWage != null" class="row industry-card__row">
                <div class="col-sm-3">{{industry.title}}</div>
                <div class="col-sm-9">
                    <div class="row industry-bar__padding">
                        <div class="col-10">
                            <v-progress-linear class="industry-bar" :value="industry.percentage" height="25" color="industry-bar__percentage" background-color="industry-bar__background"/>
                        </div>
                        <div v-if="industry.percentage > 0 && industry != null" class="col-2 industry-bar__percentage-text">{{industry.percentage}}%</div>
                        <div v-else-if="industry.percentage === null" class="col-2 industry-bar__percentage-text">N/A</div>
                        <div v-else class="col-2 industry-bar__percentage-text">&#60;1%</div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <v-progress-linear class="industry-bar" :value="industry.industryWage/1500" height="25" color="industry-bar__salary" background-color="industry-bar__background"/>
                        </div>
                        <div v-if="industry.industryWage > 0 && industry != null" class="col-2 industry-bar__salary-text">${{formatDollars(industry.industryWage)}}</div>
                        <div v-else-if="industry.industryWage === null" class="col-2 industry-bar__salary-text">N/A</div>
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
		...mapGetters(["industriesByMajor"])
	}
};
</script>