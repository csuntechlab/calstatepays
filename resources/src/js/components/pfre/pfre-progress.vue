<template>
	<div v-if="!this.pfreFormWasSubmitted">
		<h3 class="industry-title text-center p-md-3">Please make your selection</h3>
		<p class="lead pl-md-5 pr-md-5">
			You have the option of either filtering out majors by
			<span class="font-weight-bold">discipline</span> or choosing the
			<span class="font-weight-bold">major</span>
			which resonates the most with you.
		</p>
		<p class="lead pl-md-5 pr-md-5">
			<span class="font-weight-bold">Please Note:</span> Some majors might not have any data available at the moment.
			For more information on how we gathered the data, please read the
			<router-link to="/faq">FAQ</router-link>.
		</p>
	</div>
	<div v-else id="progress-bars">
		<div class="row">
			<div class="col-12">
				<h3 class="csu-card__title">{{this.pfreSelected.majorName}}</h3>
			</div>
			<div class="col-12">
				<span class="h6 pfre__sub-header"><b class="csu-card__tags">Age:</b> {{this.pfreSelected.ageRange}} &bull; </span>
                <span class="h6 pfre__sub-header"><b class="csu-card__tags">Education Level:</b> {{this.pfreSelected.education}} &bull; </span>
                <span class="h6 pfre__sub-header"><b class="csu-card__tags">Earnings:</b> {{this.pfreSelected.earnings}} &bull; </span>
                <span class="h6 pfre__sub-header"><b class="csu-card__tags">Financial Aid:</b> {{this.pfreSelected.financialAid}}</span>
			</div>
		</div>
		<div class="row no-gutters my-3 pfre-bar__wrapper">
			<div class="col-12 col-lg-11 col-xl-11 align-self-center">
				<div class="row no-gutters">
					<span class="col-auto">
						<pfre-info
							infoKey="timeToDegree"
						>The estimated time it would take for you to complete your degree if you choose this major.</pfre-info>
					</span>
					<span class="col">
						<p
							class="float-left pfre__chart-header font-weight-bold mb-0"
							@click="toggleInfo('timeToDegree')"
						>Estimated Time to Completion of Degree</p>
					</span>
				</div>
				<div class="row my-3">
					<div class="col-9 col-sm-10 col-lg-11">
						<div class="row">
							<div class="col-sm-12">
								<v-progress-linear
									class="pfre-bar progress-median"
									:value="(pfreData.years.actual/ pfreData.years.end) * 100"
									height="55"
									color="pfre-year"
									background-color="pfre-bar__background"
								/>
							</div>
						</div>
						<div class="progress-footer">
							<span class="col-4">
								<p class="float-left pfre__chart-text mb-0">{{pfreData.years.start}}</p>
							</span>
							<span class="col-4">
								<p class="text-center pfre__chart-text mb-0">{{pfreData.years.middle}}</p>
							</span>
							<span class="col-4">
								<p class="float-right pfre__chart-text mb-0">{{pfreData.years.end}}</p>
							</span>
						</div>
					</div>
					<div class="col-3 col-sm-2 col-lg-1 px-0 py-4">
						<p class="mb-0 pfre__chart-text pfre-bar__years-text">{{pfreData.years.actual}} yrs</p>
					</div>
				</div>
			</div>
		</div>

		<div class="row no-gutters my-3 pfre-bar__wrapper">
			<div class="col-12 col-lg-11 col-xl-11 align-self-center">
				<div class="row no-gutters">
					<span class="col-auto">
						<pfre-info
							infoKey="earnings"
						>After you successfully complete a degree and find a career, Your estimated earnings would be this.</pfre-info>
					</span>
					<span class="col">
						<p
							class="float-left pfre__chart-header font-weight-bold mb-0"
							@click="toggleInfo('earnings')"
						>Estimated Earnings 5 Years After Exit</p>
					</span>
				</div>
				<div class="row my-3">
					<div class="col-9 col-sm-10 col-lg-11">
						<div class="row">
							<div class="col-sm-12">
								<v-progress-linear
									class="pfre-bar progress-median"
									:value="(pfreData.earnings.actual/pfreData.earnings.maximum) * 100"
									height="55"
									color="pfre-earnings"
									background-color="pfre-bar__background"
								/>
							</div>
						</div>
						<div class="progress-footer">
							<span class="col-4">
								<p
									v-show="smallestScreen"
									class="float-left pfre__chart-text mb-0"
								>{{pfreData.earnings.minimum | currency}}</p>
								<p v-show="!smallestScreen" class="float-left pfre__chart-text mb-0">{{pfreData.earnings.minimum/1000 | currency}}k</p>
							</span>
							<span class="col-4">
								<p
									v-show="smallestScreen"
									class="text-center pfre__chart-text mb-0"
								>{{pfreData.earnings.average | currency}}</p>
								<p v-show="!smallestScreen" class="text-center pfre__chart-text mb-0">{{pfreData.earnings.average/1000 | currency}}k</p>
							</span>
							<span class="col-4">
								<p
									v-show="smallestScreen"
									class="float-right pfre__chart-text mb-0"
								>{{pfreData.earnings.maximum | currency}}</p>
								<p v-show="!smallestScreen" class="text-center pfre__chart-text mb-0">{{pfreData.earnings.maximum/1000 | currency}}k</p>
							</span>
						</div>
					</div>
					<div class="col-3 col-sm-2 col-lg-1 px-0 py-4">
						<p
							class="mb-0 pfre__chart-text pfre-bar__earnings-text"
						>{{pfreData.earnings.actual | currency}}</p>
					</div>
				</div>
			</div>
		</div>
		<div class="row no-gutters my-3 pfre-bar__wrapper">
			<div class="col-12 col-lg-11 col-xl-11 align-self-center">
				<div class="row no-gutters">
					<span class="col-auto">
						<pfre-info infoKey="return">Your estimated financial return on your education investment.</pfre-info>
					</span>
					<span class="col">
						<p
							class="float-left pfre__chart-header font-weight-bold mb-0"
							@click="toggleInfo('return')"
						>FRE - Financial Return on Education</p>
					</span>
				</div>
				<div class="row my-3">
					<div class="col-9 col-sm-10 col-lg-11">
						<div class="row">
							<div class="col-sm-12">
								<v-progress-linear
									class="pfre-bar progress-median"
									:value="((pfreData.returnOnInvestment.actual * 100) / (pfreData.returnOnInvestment.maximum * 100))"
									height="55"
									color="pfre-fre"
									background-color="pfre-bar__background"
								/>
							</div>
						</div>
						<div class="progress-footer">
							<span class="col-4">
								<p class="float-left pfre__chart-text mb-0">{{pfreData.returnOnInvestment.minimum | percentage}}</p>
							</span>
							<span class="col-4">
								<p class="text-center pfre__chart-text mb-0">{{pfreData.returnOnInvestment.average | percentage}}</p>
							</span>
							<span class="col-4">
								<p class="float-right pfre__chart-text mb-0">{{pfreData.returnOnInvestment.maximum | percentage}}</p>
							</span>
						</div>
					</div>
					<div class="col-3 col-sm-2 col-lg-1 px-0 py-4">
						<p
							class="mb-0 pfre__chart-text pfre-bar__return-investment-text"
						>{{pfreData.returnOnInvestment.actual/100 | percentage}}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>


<script>
import { currency, percentage } from "../../filters";
import { mapGetters, mapActions } from "vuex";
import pfreInfo from "./pfre-info.vue";
export default {
	data() {
		return {
			userYears: {
				start: 0,
				middle: 0,
				end: 0,
				actual: 0
			}
		};
	},
	computed: {
		...mapGetters(["pfreData", "pfreFormWasSubmitted", "pfreSelected"]),
		smallestScreen() {
			var width = window.innerWidth;
			return (width > 500);
		}
	},
	methods: {
		...mapActions(["fetchFreData", "toggleInfo"])
	},
	filters: { percentage, currency },
	components: { pfreInfo }
};
</script>