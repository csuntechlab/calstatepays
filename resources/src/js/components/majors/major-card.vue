<template>
	<div class="row mb-3" v-bind:id="'majorCardHasIndex-' + this.index">
		<aside class="col-md-3">
			<major-form class="csu-card__form container-fluid" :index="index" />
		</aside>
		<div class="col-md-9">
			<card class="csu-card container-fluid py-3">
				<div class="row">
					<div class="col-6">
						<social-sharing 
						v-if="selectedFormWasSubmitted && !nullValues" 
						url="sandbox.csun.edu/metalab/test/csumetrola" 
						:title="this.shareDescription"
						description="Discover Your Earnings After College." 
						:quote="this.shareDescription" 
						hashtags="CalStatePays, ItPaysToGoToCollege"
						inline-template>
							<div>
								<network network="facebook" class="csu-card__share csu-card__share-facebook">
									<i class="fab fa-facebook fa-2x"></i>
								</network>
								<network network="linkedin" class="csu-card__share csu-card__share-linkedin">
									<i class="fab fa-linkedin fa-2x"></i>
								</network>
								<network network="twitter" class="csu-card__share csu-card__share-twitter">
									<i class="fab fa-twitter-square fa-2x"></i>
								</network>
							</div>
						</social-sharing>
					</div>
					<div class="col-6">
						<i class="fas fa-times btn-remove float-right" @click="removeCurrentCard" v-show="isNotFirstCard" title="Close"></i>
						<i class="fas fa-sync-alt btn-reset float-right" @click="resetCurrentCard" v-show="selectedFormWasSubmitted" title="Reset"></i>
					</div>
				</div>
				<div class="row">
					<h3 v-show="selectedFormWasSubmitted" class="industry-title">{{selectedMajorTitle}}</h3>
				</div>
					<div v-show="selectedFormWasSubmitted && nullValues" class="row text-center">
						<h3 class="csu-card__no-data"><i class="fas fa-exclamation-circle required-field"/> No data available</h3>
					</div>
				<div v-show="!nullValues">
					<div class="row">
						<div class="col-12">
							<major-graph-wrapper v-bind:id="'majorGraphWrapperIndex-' + this.index" style="height:50vh" :majorData="selectedMajorData"
							 :educationLevel="selectedEducationLevel" :windowWidth="windowWidth"></major-graph-wrapper>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<major-legend v-show="selectedFormWasSubmitted" :educationLevel="selectedEducationLevel"></major-legend>
						</div>
					</div>
				</div>
				<div class="row p-0">
					<div class="mt-4">
						<industry-carousel v-show="isEmpty" :industries="selectedIndustries"></industry-carousel>
					</div>
				</div>
			</card>
		</div>
	</div>
</template>
<script>
import majorForm from "./major-form.vue";
import card from "../global/card";
import majorsGraph from "./majors-graph.vue";
import majorGraphWrapper from "./major-graph-wrapper.vue";
import industryCarousel from "../industries/industry-carousel.vue";
import majorLegend from "./major-legend.vue";

import { updateForm } from "../../utils/index";
import { mapGetters, mapActions } from "vuex";

export default {
	props: ["index", "windowWidth"],
	data() {
		return {
			major: this.majorNameById
		};
	},
	computed: {
		...mapGetters([
			"industries",
			"majorData",
			"educationLevel",
			"formWasSubmitted",
			"majorNameById"
		]),
		isEmpty() {
			//Check whether the form field was fired off, toggle carousel on
			if (
				this.industries(this.index).length === 0 ||
				!this.selectedFormWasSubmitted
			) {
				return false;
			}
			return true;
		},
		isNotFirstCard() {
			if (this.index >= 1) {
				return true;
			}
			return false;
		},
		selectedMajorData() {
			return this.majorData(this.index);
		},
		selectedIndustries() {
			return this.industries(this.index);
		},
		selectedEducationLevel() {
			return this.educationLevel(this.index);
		},
		selectedFormWasSubmitted() {
			return this.formWasSubmitted(this.index);
		},
		selectedMajorTitle() {
			if (this.selectedMajorData.length != 0) {
				let currentMajor = this.selectedMajorData.majorId;
				return this.majorNameById(currentMajor);
			}
		},
		shareDescription() {
			let opening = 'I discovered that ' + this.selectedMajorTitle + ' students from CSUN make an average of ';

			if(this.selectedMajorData.bachelors && this.selectedEducationLevel == 'allDegrees')
				return opening + this.formatDollars(this.selectedMajorData.bachelors[5]._50th) + ' five years after graduating!';

			else if(this.selectedMajorData[this.selectedEducationLevel] && this.selectedEducationLevel == 'someCollege')
				return opening + this.formatDollars(this.selectedMajorData[this.selectedEducationLevel][5]._50th) + ' five years after dropping out of college!';

			else if(this.selectedMajorData[this.selectedEducationLevel])
				return opening + this.formatDollars(this.selectedMajorData[this.selectedEducationLevel][5]._50th) + ' five years after graduating with a ' + this.selectedEducationLevel + ' degree!';

			else
				return 'Discover your earnings after college!'
		},
		nullValues() {
			if (this.selectedEducationLevel != "allDegrees" && this.selectedMajorData)
				return (this.selectedMajorData[this.selectedEducationLevel][2]._25th == null);
			return false;
		}
	},
	methods: {
		...mapActions(["deleteMajorCard", "resetMajorCard"]),
		removeCurrentCard() {
			this.deleteMajorCard(this.index);
		},
		resetCurrentCard() {
			this.resetMajorCard(this.index);
		},
		formatDollars(input) {
			if (this.input) {
				let dollarAmount = input.toString();
				let hundreds = dollarAmount.substr(-3, 3);
				let thousands = dollarAmount.slice(0, -3);
				return "$" + thousands + "," + hundreds;
			}
		}
	},
	components: {
		majorForm,
		card,
		majorGraphWrapper,
		majorsGraph,
		industryCarousel,
		majorLegend
	}
};
</script>