<template>
	<div class="row mb-3" v-bind:id="'majorCardHasIndex-' + this.index">
		<aside class="col-md-3">
			<major-form :windowWidth="windowWidth" :index="index" />
		</aside>
		<div class="col-md-9">
			<card v-if="selectedFormWasSubmittedOnce" class="csu-card container-fluid py-3">
				<div class="row">
					<div class="col-6">
						<social-sharing 
						v-if="selectedFormWasSubmittedOnce && !nullValues" 
						:url="this.url"
						:title="this.shareDescription"
						description="Discover Your Earnings After College." 
						:quote="this.shareDescription" 
						hashtags="CalStatePays, ItPaysToGoToCollege"
						inline-template>
							<div>
								<network network="facebook" class="csu-card__share csu-card__share-facebook">
									<i class="fa fa-facebook-official fa-2x"></i>
								</network>
								<network network="linkedin" class="csu-card__share csu-card__share-linkedin">
									<i class="fa fa-linkedin-square fa-2x"></i>
								</network>
								<network network="twitter" class="csu-card__share csu-card__share-twitter">
									<i class="fa fa-twitter-square fa-2x"></i>
								</network>
							</div>
						</social-sharing>
					</div>
					<div class="col-6">
						<i class="fa fa-times fa-2x btn-remove float-right" @click="removeCurrentCard" v-show="isNotFirstCard" title="Close"></i>
					</div>
				</div>
				<div class="row">
					<h3  class="industry-title">{{selectedMajorTitle}}</h3>
				</div>
					<div v-show="selectedFormWasSubmittedOnce && nullValues" class="row text-center">
						<h3 class="csu-card__no-data"><i class="fa fa-exclamation-circle required-field"/> No data available</h3>
					</div>
				<div v-show="!nullValues">
					<div class="row">
						<div class="col-12">
							<major-graph-wrapper v-bind:id="'majorGraphWrapperIndex-' + this.index" :majorData="selectedMajorData"
							:educationLevel="selectedEducationLevel" :windowWidth="windowWidth"></major-graph-wrapper>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<major-legend v-show="selectedFormWasSubmittedOnce" :educationLevel="selectedEducationLevel"></major-legend>
						</div>
					</div>
				</div>
				<div class="row p-0">
					<div class="mt-4">
						<industry-carousel v-show="isEmpty" :industries="selectedIndustries"></industry-carousel>
					</div>
				</div>
			</card>
			<div v-else class="csu-card container-fluid py-3">
				<h3 class="text-center p-md-4">Please make your selection</h3>
				<p class="lead pl-md-5 pr-md-5">
					You have the option of either filtering out majors by <span class="font-weight-bold">discipline</span> or choosing the <span class="font-weight-bold">major</span>
					which resonates the most with you.
				</p>
				<p class="lead pl-md-5 pr-md-5">
					<span class="font-weight-bold">Please Note:</span> Some majors might not have any data available at the moment.
					For more information on how we gathered the data, please read the <router-link to="/faq">FAQ</router-link>.
				</p>
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
	data() {
		return {
		    url: window.baseUrl,
			major: this.majorNameById
		};
	},
	computed: {
		...mapGetters([
			"industries",
			"majorData",
			"educationLevel",
			"formWasSubmitted",
			"formWasSubmittedOnce",
			"majorNameById",
			"majors",
			"universities",
			"selectedUniversity"
		]),
		isEmpty() {
			//Check whether the form field was fired off, toggle carousel on
			if (
				this.industries(this.index).length === 0 ||
				!this.selectedFormWasSubmittedOnce
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
		selectedFormWasSubmittedOnce(){
			return this.formWasSubmittedOnce(this.index);
		},
		selectedMajorTitle() {
			if (this.selectedMajorData.length != 0) {
				let currentMajor = this.selectedMajorData.majorId;
				return this.majorNameById(currentMajor);
			}
		},
		shareDescription() {
			let universityFullName = this.retrieveUniversityFullName(this.universities, this.selectedUniversity);

			let opening = 'I discovered that ' + this.selectedMajorTitle + ' students from '+ universityFullName+' make an average of ';

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
			var yearsOut = [2,5,10,15]
            if (this.selectedEducationLevel != "allDegrees" && this.selectedMajorData) {
                for(var i=0; i< yearsOut.length; i++){
                    if(this.selectedMajorData[this.selectedEducationLevel][yearsOut[i]]._25th != null){
                        return false
                    }else if(this.selectedMajorData[this.selectedEducationLevel][yearsOut[i]]._50th != null){
                        return false
                    }else if(this.selectedMajorData[this.selectedEducationLevel][yearsOut[i]]._25th != null){
                        return false
                    }
                }
                return true;
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
		},
		formatDollars(input) {
			if (input) {
				let dollarAmount = input.toString();
				let hundreds = dollarAmount.substr(-3, 3);
				let thousands = dollarAmount.slice(0, -3);
				return "$" + thousands + "," + hundreds;
			}
		},
		// used for the social sharing
		retrieveUniversityFullName(universityArray,selectedUniv){
			for(var i = 0; i < universityArray.length; i++){
				if(universityArray[i].short_name === selectedUniv) return universityArray[i].name;
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
	},
	updated() {
	}
};
</script>