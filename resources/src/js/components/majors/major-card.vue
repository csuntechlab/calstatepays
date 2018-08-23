<template>
    <div class="row" v-bind:id="'majorCardHasIndex-' + this.index">
			<aside class="col-md-3">
				<major-form class="csu-card__form" :index="index"/>
			</aside>
			<div class="col-md-9">
				<card class="csu-card container-fluid">
					<div class="row">
						<div class="col-12">
							<i class="fas fa-times btn-remove float-right" @click="removeCurrentCard" v-show="isNotFirstCard" title="Close"></i>
							<i class="fas fa-sync-alt btn-reset float-right" @click="resetCurrentCard" v-show="isEmpty" title="Reset"></i>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<h3 v-show="selectedFormWasSubmitted" class="industry-title">{{selectedMajorTitle}}</h3>
						</div>
					</div>
					<div class="row">
						<div class="col-12" style="height:50vh" v-bind:id="'majorGraphWrapperIndex-' + this.index">
							<major-graph-wrapper :majorData="selectedMajorData" :educationLevel="selectedEducationLevel" :windowWidth="windowWidth"/>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<major-legend v-show="selectedFormWasSubmitted" :educationLevel="selectedEducationLevel"/>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<industry-carousel v-show="isEmpty" :industries="selectedIndustries"/>
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
			if (
				this.industries(this.index).length === 0 ||
				this.formWasSubmitted(this.index) == false
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
		}
	},
	methods: {
		...mapActions(["deleteMajorCard", "resetMajorCard"]),
		removeCurrentCard() {
			this.deleteMajorCard(this.index);
		},
		resetCurrentCard() {
			this.resetMajorCard(this.index);
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
