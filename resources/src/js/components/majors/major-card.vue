<template>
    <div class="col col-md-12" v-bind:id="'majorCardHasIndex-' + this.index">
		<div class="row">
			
			<div class="col-md-3">
				<card class="csu-card__form">
					<major-form :index="index"></major-form>
				</card>
			</div>
			<div class="col-md-9">
				<card class="csu-card">
					<div class="container-fluid my-0">
						<div class="row">
							<div class="col">
								<i class="fas fa-times btn-remove float-right" @click="removeCurrentCard" v-show="isNotFirstCard" title="Close"></i>
								<i class="fas fa-sync-alt btn-reset float-right" @click="resetCurrentCard" v-show="isEmpty" title="Reset"></i>
							</div>
						</div>
						<div class="row">
							<h3 v-show="selectedFormWasSubmitted" class="industry-title">{{selectedMajorTitle}}</h3>
						</div>
						<div class="row mx-1 p-0">
							<div class="col">
								<major-graph-wrapper v-show="selectedFormWasSubmitted" :majorData="selectedMajorData" :educationLevel="selectedEducationLevel" :windowWidth="windowWidth"></major-graph-wrapper>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<major-legend v-show="selectedFormWasSubmitted" :educationLevel="selectedEducationLevel"></major-legend>
							</div>
                		</div>
						<div class="row p-0">
							<div class="mt-4">
								<industry-carousel v-show="isEmpty" :industries="selectedIndustries"></industry-carousel>
							</div>
						</div>
					</div>
				</card>
			</div>

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
