<template>
	<div>
		<div v-if="pfreIsLoading" class="row">
			<v-progress-circular class="loading-icon" :size="100" :width="10" indeterminate></v-progress-circular>
		</div>
		<div v-else>
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
						<h3 class="pfre-info__majorTitle">
							{{this.pfreSelected.majorName}}
						</h3>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<ul class="pfre-info__listGroup">
							<li class="pfre-info__listElement">
								<b class="csu-card__tags">Education Level:</b>
								<!-- {{this.pfreSelected.education}} -->
								First Time Freshmen
							</li>
							<li class="pfre-info__listElement">
								<b class="csu-card__tags">Earnings:</b>
								{{this.pfreSelected.earnings}}
							</li>
							<li class="pfre-info__listElement">
								<b class="csu-card__tags">Financial Aid:</b>
								{{this.pfreSelected.financialAid}}
							</li>
						</ul>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-12">
						<h4 class="pfre-info__title">Annual Finacial Return on Your Education</h4>
						<p class="pfre-info__percentage">
							<!-- {{pfreData.returnOnInvestment.actual/100 | percentage}} -->
							7.5%
						</p>
						<p class="pfre-info__infoCopy">
							This percentage reflects a return on the investment you make on a bachelor’s education. This calculated by accounting for your earnings potential and your cost of getting that education. Over your professional career, you will get and annual return on your education. You can compare this return with other investment you make.
						</p>
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
		...mapGetters([
			"pfreData",
			"pfreFormWasSubmitted",
			"pfreSelected",
			"pfreIsLoading"
		]),
		smallestScreen() {
			var width = window.innerWidth;
			return width > 500;
		}
	},
	methods: {
		...mapActions(["fetchFreData", "toggleInfo"])
	},
	filters: { percentage, currency },
	components: { pfreInfo }
};
</script>