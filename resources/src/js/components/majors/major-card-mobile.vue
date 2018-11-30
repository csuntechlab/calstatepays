<template>
	<div class="row mb-3" v-bind:id="'majorCardHasIndex-' + this.index">
		<div class="col-12">
			<div class="csu-card">
				<div class="container-fluid py-3">
					<div class="row">
						<div class="col">
							<i class="fa fa-times fa-2x btn-remove " @click="removeCurrentCard" v-show="isNotFirstCard" title="Close"></i>
							<i class="fa fa-refresh fa-2x btn-reset" @click="resetCurrentCard" v-show="selectedFormWasSubmitted" title="Reset"></i>
						</div>
						<div class="col-11">
							<!-- <i class="fa fa-refresh fa-2x btn-reset float-left" @click="resetCurrentCard" v-show="selectedFormWasSubmitted" title="Reset"></i> -->
							<social-sharing 
							v-if="selectedFormWasSubmitted" 
							:networks="mobileNetworks" 
							url="sandbox.csun.edu/metalab/test/csumetrola"
							:title="this.shareDescription" 
							description="Discover Your Earnings After College." 
							:quote="this.shareDescription"
							hashtags="CalStatePays, ItPaysToGoToCollege" 
							inline-template>
							<div>
								<network network="twitter" class="csu-card__share csu-card__share-twitter float-right">
									<i class="fa fa-twitter-square"></i>
									Tweet
								</network>
								<network network="linkedin" class="csu-card__share csu-card__share-linkedin float-right">
									<i class="fa fa-linkedin-square"></i>
									Share
								</network>
								<network network="facebook" class="csu-card__share csu-card__share-facebook float-right">
									<i class="fa fa-facebook-official"></i>
									Share
								</network>
							</div>
							</social-sharing>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<h3 v-show="selectedFormWasSubmitted" class="industry-title pt-2">{{selectedMajorTitle}}</h3>
						</div>
					</div>
					<div class="col">
							<major-legend v-show="selectedFormWasSubmitted" :educationLevel="selectedEducationLevel" />
					</div>
					<div v-show="this.selectedFormWasSubmitted && nullValues">
						<div class="row text-center">
							<h3 class="csu-card__no-data--mobile"><i class="fa fa-exclamation-circle required-field"/> No data available</h3>
						</div>
					</div>
					<div v-show="!nullValues">
						<div class="row" v-show="selectedFormWasSubmitted" style="height: 400px">
							<div class="col-12">
								<major-graph-wrapper v-bind:id="'majorGraphWrapperIndex-' + this.index" :majorData="selectedMajorData" :educationLevel="selectedEducationLevel" :windowWidth=windowWidth />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<major-form :index="index" />
						</div>
					</div>
						<div class="row">
							<div class="col-12">
								<industry-mobile v-show="isEmpty" :industries="selectedIndustries" :majorId="selectedMajorId" />
							</div>
						</div>
				</div>
			</div>
		</div>
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
				"formWasSubmittedOnce",
				"majorNameById",
				"universities",
				"selectedUniversity"
			]),
			isEmpty() {
				//Check whether the form field was fired off, toggle carousel on
				if (!this.selectedFormWasSubmittedOnce || this.industries(this.index).length === 0) {
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
			selectedFormWasSubmittedOnce() {
				return this.formWasSubmittedOnce(this.index);
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
				let universityFullName = this.retrieveUniversityFullName(this.universities, this.selectedUniversity);

				if(universityFullName === 'CSU7')
					universityFullName = 'the CSU7';

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
			industryMobile,
			majorLegend
		}
	};
</script>