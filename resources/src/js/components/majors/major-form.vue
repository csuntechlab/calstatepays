<template>
	<transition name="flip" mode="out-in">
		<div key="1" v-if="!selectedFormWasSubmitted">
			<form class="container-fluid csu-card__form" v-bind:id="'majorForm-' + form.cardIndex">
				<fieldset class="csu-card__form-sizing">
					<button
						class="btn btn-flip-card float-right"
						v-show="selectedFormWasSubmittedOnce"
						@click.prevent="resetCurrentCard"
					>
						Change Degree Level
						<i class="fas fa fa-chevron-right"></i>
					</button>
					<div
						v-if="!selectedFormWasSubmitted"
						v-bind:class="[this.formNotFilled ? 'required-field' : 'required-field--hidden']"
					>
						<i class="fa fa-exclamation-circle"></i> Please select a Major.
					</div>
					<div class="form-group">
						<label class="font-weight-bold" for="fieldOfStudy">Select a Discipline (Optional)</label>
						<v-select
							label="discipline"
							aria-label="Select Discipline Optional"
							@click.native="this.selected = null"
							:options="fieldOfStudies"
							@input="updateSelect('fieldOfStudyId', 'id', $event)"
							class="csu-form-input"
						></v-select>
					</div>
					<div class="form-group">
						<label
							class="font-weight-bold"
							for="Major"
							v-bind:style="[this.submittedOnce && !this.form.majorId ? errorLabel : '']"
						>Select a Major</label>
						<v-select
                            label="major"
							aria-label="Select Major"
							v-model="selected"
							:options="this.form.fieldOfStudyId == null ? majors : selectedMajorsByField"
							@input="updateSelect('majorId', 'majorId', $event)"
							class="csu-form-input"
                             :loading="selectedMajorDisciplineLoad"
							v-bind:class="{'border-danger': this.submittedOnce && !this.form.majorId}"
						></v-select>
					</div>
					<div class="form-group row">
						<button type="button" @click.prevent="submitForm" class="btn btn-success btn-submit">Submit</button>
					</div>
				</fieldset>
			</form>
		</div>
		<div key="2" v-else>
			<form class="container-fluid csu-card__form" v-bind:id="'majorForm-' + form.cardIndex">
				<fieldset class="csu-card__form-sizing">
					<div class="row">
						<div class="col-12 text-right">
							<button
								v-show="selectedFormWasSubmittedOnce"
								class="btn btn-flip-card"
								@click.prevent="resetCurrentCard"
							>
								Change Major
								<i v class="fas fa fa-chevron-right"/>
							</button>
						</div>
					</div>
					<div class="row">
						<p class="text-center h5 majors-header my-5-md my-4 col-12">Select a Degree Level</p>
					</div>
					<button
						class="btn btn-sm major-btn_all"
						:id="'allDegrees-' + form.cardIndex"
						@click.prevent="toggleEducationLevel('allDegrees')"
						v-bind:class="{'selected-btn_all': this.educationLevel(this.index) == 'allDegrees'}"
					>
						<i
							class="major-btn_icon"
							v-bind:class="{'fa fa-check': this.educationLevel(this.index) == 'allDegrees', '':this.educationLevel(this.index) != 'allDegrees'}"
						></i>
						All Levels
					</button>
					<button
						class="btn btn-sm major-btn_postBacc"
						:id="'postBacc-' + form.cardIndex"
						@click.prevent="toggleEducationLevel('postBacc')"
						v-bind:class="{'selected-btn_postBacc': this.educationLevel(this.index) == 'postBacc'}"
					>
						<i
							class="major-btn_icon"
							v-bind:class="{'fa fa-check': this.educationLevel(this.index) == 'postBacc', '':this.educationLevel(this.index) != 'postBacc'}"
						></i>
						Post Bacc
					</button>
					<button
						class="btn btn-sm major-btn_bachelors"
						:id="'bachelors-' + form.cardIndex"
						@click.prevent="toggleEducationLevel('bachelors')"
						v-bind:class="{'selected-btn_bachelors': this.educationLevel(this.index) == 'bachelors'}"
					>
						<i
							class="major-btn_icon"
							v-bind:class="{'fa fa-check': this.educationLevel(this.index) == 'bachelors', '':this.educationLevel(this.index) != 'bachelors'}"
						></i>
						Bachelors
					</button>
					<button
						class="btn btn-sm major-btn_someCollege"
						:id="'someCollege-' + form.cardIndex"
						@click.prevent="toggleEducationLevel('someCollege')"
						v-bind:class="{'selected-btn_someCollege': this.educationLevel(this.index) == 'someCollege'}"
					>
						<i
							class="major-btn_icon"
							v-bind:class="{'fa fa-check': this.educationLevel(this.index) == 'someCollege', '':this.educationLevel(this.index) != 'someCollege'}"
						></i>
						Some College
					</button>
				</fieldset>
			</form>
		</div>
	</transition>
</template>

<script>
import vSelect from "vue-select";
import { required } from "vuelidate/lib/validators";
import { updateForm } from "../../utils/index";
import { mapGetters, mapActions } from "vuex";

export default {
	props: ["index", "windowWidth"],
	data() {
		return {
            isShowing: false,
			form: {
				cardIndex: this.index,
				majorId: null,
				formWasSubmitted: false,
				fieldOfStudyId: null,
				formEducationLevel: "allDegrees",
				errors: {
					major: null
				},
				isMajorSelected: true
			},
			submittedOnce: false,
			formNotFilled: false,
			selected: null,

			errorLabel: {
				color: "red",
				fontWeight: "bold"
			}
		};
	},
	methods: {
		...mapActions([
			"fetchIndustryImages",
			"fetchIndustries",
			"toggleFormWasSubmitted",
			"fetchUpdatedMajorsByField",
			"fetchMajorData",
			"resetMajorCard"
		]),
		updateForm,
		resetCurrentCard() {
			this.resetMajorCard(this.index);
		},

		submitForm() {
			//Validation
			this.formNotFilled = false;
			this.submittedOnce = true;

			if (this.checkForm()) {
				this.fetchIndustries({form: this.form, school: this.selectedUniversity});
                this.$store.dispatch("setIndustryMajor", this.selected);
                this.$store.dispatch("toggleIndustryEducationLevel", this.industryEducationLevel);
				this.selected = null;
				this.submittedOnce = false;
				this.toggleFormWasSubmitted(this.form.cardIndex);
				this.fetchIndustryImages({
					form: this.form,
					school: this.selectedUniversity
				});
				this.fetchMajorData({
					form: this.form,
					school: this.selectedUniversity
				});
				this.form.majorId = null;
				this.form.fieldOfStudyId = null;
				this.isShowing = !this.isShowing;
			}
		},

		checkForm() {
			if (!this.$v.$invalid) return true;
			else {
				this.formNotFilled = true;
				return false;
			}
		},

		updateSelect(field, dataKey, data) {
			if (data) {
				this.form[field] = data[dataKey];
				this.handleFieldOfStudyMajors(field);
			} else {
				this.form[field] = null;
			}
		},

		handleFieldOfStudyMajors(field) {
			if (field == "fieldOfStudyId") {
				this.fetchUpdatedMajorsByField({
					form: this.form,
					school: this.selectedUniversity
				})
			}
		},
		toggleEducationLevel(educationInput) {
			this.$store.dispatch("toggleEducationLevel", {
				cardIndex: this.form.cardIndex,
				educationLevel: educationInput
			});
		}
	},
	computed: {
		...mapGetters([
			"majors",
			"fieldOfStudies",
			"majorsByField",
			"formWasSubmitted",
			"formWasSubmittedOnce",
			"educationLevel",
            "selectedUniversity",
            "majorDisciplineLoad"
		]),
		selectedMajorsByField() {
			this.selected = null;
			return this.majorsByField(this.index);
		},
		selectedFormWasSubmitted() {
			return this.formWasSubmitted(this.index);
		},
		selectedFormWasSubmittedOnce() {
			return this.formWasSubmittedOnce(this.index);
        },
        selectedMajorDisciplineLoad() {
            return this.majorDisciplineLoad(this.index);
        },
		windowSize() {
			return window.innerWidth;
		}
	},
	validations: {
		form: {
			majorId: { required }
		}
	},
	components: {
		vSelect
	}
};
</script>