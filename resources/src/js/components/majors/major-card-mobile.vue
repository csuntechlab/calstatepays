<template>
    <div class="col col-md-12" v-bind:id="'majorCardHasIndex-' + this.index">
        <card class="csu-card">
            <div class="container-fluid my-0 mt-2">
                <div class="row">
                    <div class="col">
                        <social-sharing v-if="selectedFormWasSubmitted" :networks="mobileNetworks" url="sandbox.csun.edu/metalab/test/csumetrola" :title="this.shareDescription"
                            description="Discover Your Earnings After College." :quote="this.shareDescription" hashtags="CalStatePays, ItPaysToGoToCollege"
                            inline-template>
                            <div>
                                <network network="facebook-m" class="csu-card__share csu-card__share-facebook">
                                    <i class="fab fa-facebook fa-2x"></i>
                                </network>
                                <network network="linkedin-m" class="csu-card__share csu-card__share-linkedin">
                                    <i class="fab fa-linkedin fa-2x"></i>
                                </network>
                                <network network="twitter-m" class="csu-card__share csu-card__share-twitter">
                                    <i class="fab fa-twitter-square fa-2x"></i>
                                </network>
                            </div>
                        </social-sharing>
                    </div>
                    <div class="col">
                        <i class="fas fa-times btn-remove float-right" @click="removeCurrentCard" v-show="isNotFirstCard" title="Close"></i>
                        <i class="fas fa-sync-alt btn-reset float-right" @click="resetCurrentCard" v-show="isEmpty" title="Reset"></i>
                    </div>
                </div>
                <div class="row">
                    <h3 v-show="selectedFormWasSubmitted" class="industry-title">{{selectedMajorTitle}}</h3>
                </div>
                <div v-show="selectedFormWasSubmitted" style="height: 400px" class="row m-1 p-0">
                    <div class="col p-0">
                        <major-graph-wrapper :majorData="selectedMajorData" :educationLevel="selectedEducationLevel" :windowWidth=windowWidth></major-graph-wrapper>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col">
                        <major-legend v-show="selectedFormWasSubmitted" :educationLevel="selectedEducationLevel"></major-legend>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <major-form :index="index" class="m-0"></major-form>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <industry-mobile v-show="selectedFormWasSubmitted" :industries="selectedIndustries" :majorId="selectedMajorId"></industry-mobile>
                    </div>
                </div>
            </div>
        </card>
    </div>
</template>
<script>
import majorForm from "./major-form.vue";
import card from "../global/card";
import majorsGraph from "./majors-graph.vue";
import majorGraphWrapper from "./major-graph-wrapper.vue";
import industryMobile from "../industries/industry-mobile.vue";
import majorLegend from "./major-legend.vue";

import { updateForm } from "../../utils/index";
import { mapGetters, mapActions } from "vuex";

export default {
	props: ["index", "windowWidth"],
	data() {
		return {
			mobileNetworks: {
				"facebook-m": {
					sharer:
						"https://www.facebook.com/sharer/sharer.php?u=@url&title=@title&description=@description&quote=@quote",
					type: "direct"
				},
				"linkedin-m": {
					sharer:
						"https://www.linkedin.com/shareArticle?mini=true&url=@url&title=@title&summary=@description",
					type: "direct"
				},
				"twitter-m": {
					sharer:
						"https://twitter.com/intent/tweet?text=@title&url=@url&hashtags=@hashtags@twitteruser",
					type: "direct"
				}
			}
		};
	},
	computed: {
		...mapGetters([
			"universityById",
			"industries",
			"majorData",
			"educationLevel",
			"formWasSubmitted",
			"majorNameById"
		]),
		isEmpty() {
			//Check whether the form field was fired off, toggle carousel on
			if (this.industries(this.index).length === 0) {
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
		selectedMajorId() {
			return this.majorData(this.index).majorId;
		},
		selectedMajorTitle() {
			if (this.selectedMajorData.length != 0) {
				let currentMajor = this.selectedMajorData.majorId;
				return this.majorNameById(currentMajor);
			}
		},
		shareDescription() {
			if (
				this.selectedEducationLevel == "allDegrees" &&
				this.selectedMajorData.bachelors
			)
				return (
					"I discovered that " +
					this.selectedMajorTitle +
					" students from " +
					"CSUN" +
					" make an average of " +
					this.formatDollars(
						this.selectedMajorData.bachelors[5]._50th
					) +
					" five years after graduating!"
				);
			else if (
				this.selectedMajorData[this.selectedEducationLevel] &&
				this.selectedEducationLevel == "someCollege"
			)
				return (
					"I discovered that " +
					this.selectedMajorTitle +
					" students from " +
					"CSUN" +
					" make an average of " +
					this.formatDollars(
						this.selectedMajorData[this.selectedEducationLevel][5]
							._50th
					) +
					" five years after dropping out of college!"
				);
			else if (this.selectedMajorData[this.selectedEducationLevel])
				return (
					"I discovered that " +
					this.selectedMajorTitle +
					" students from " +
					"CSUN" +
					" make an average of " +
					this.formatDollars(
						this.selectedMajorData[this.selectedEducationLevel][5]
							._50th
					) +
					" five years after graduating with a " +
					this.selectedEducationLevel +
					" degree!"
				);
			else return "Discover your earnings after college!";
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
			let dollarAmount = input.toString();
			let hundreds = dollarAmount.substr(-3, 3);
			let thousands = dollarAmount.slice(0, -3);
			return "$" + thousands + "," + hundreds;
		}
	},
	components: {
		majorForm,
		card,
		majorGraphWrapper,
		majorsGraph,
		industryMobile,
		majorLegend
	}
};
</script>