<template>
    <div>
        <div class="row industry-card__legend">
            <div class="col-3">INDUSTRY</div>
            <div class="col-3">
                <div class="industry-card__legend-percentage"/>PERCENTAGE
            </div>
            <div class="col-6">
                <div class="industry-card__legend-salary"/>AVERAGE EARNINGS
            </div>
        </div>
        <div v-for="(industry,index) in industriesByMajor" :key="index" >
            <div v-if="industry.industryWage != null" class="row industry-card__row">
                <div class="col-3">{{industry.title}}</div>
                <div class="col-9">
                    <div class="row industry-bar__padding">
                        <span class="col-10">
                            <v-progress-linear class="industry-bar" :value="industry.percentage" height="25" color="industry-bar__percentage" background-color="industry-bar__background"/>
                        </span>
                        <div v-if="industry.percentage > 0" class="col-2 industry-bar__percentage-text">{{industry.percentage}}%</div>
                        <div v-else class="col-2 industry-bar__percentage-text">&#60;1%</div>
                    </div>
                    <div class="row">
                        <span class="col-10">
                            <v-progress-linear class="industry-bar" :value="industry.industryWage/1500" height="25" color="industry-bar__salary" background-color="industry-bar__background"/>
                        </span>
                        <div class="col-2 industry-bar__salary-text">${{formatDollars(industry.industryWage)}}</div>
                    </div>
                </div>
            </div>
            <div v-else-if="industry.industryWage === null && industry.percentage === null" class="row industry-card__row noData">
                <div class="col-3">{{industry.title}}</div>
                <div class="col-9">
                <div class="row industry-bar__padding">
                        <span class="col-10">
                            <v-progress-linear class="industry-bar" height="25" color="industry-bar__percentage" background-color="industry-bar__background"/>
                        </span>
                        <div v-if="industry.percentage === null" class="col-2 industry-bar__percentage-text">N/A</div>
                    </div>
                    <div v-if="industry.industryWage === null" class="row">
                        <span class="col-10">
                            <v-progress-linear class="industry-bar" height="25" color="industry-bar__salary" background-color="industry-bar__background"/>
                        </span>
                        <div class="col-2 industry-bar__salary-text">N/A</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="border-top:1px gray solid;">
            <a @click="toggleIndustryVisibility()"><p>Only View Available Data</p></a>
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
        },
        toggleIndustryVisibility(){
            var targetNoData = document.querySelectorAll('div.row.industry-card__row.noData');
            if(targetNoData.length > 0) {
                for (var i=0; i < targetNoData.length; i++) {
                    // console.log(targetNoData[i]);
                    targetNoData[i].classList.toggle("d-none");
                }
            }
        }
	},
	computed: {
		...mapGetters(["industriesByMajor"])
	}
};
</script>

