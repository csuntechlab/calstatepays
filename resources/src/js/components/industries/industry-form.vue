<template>
	<transition name="flip" mode="out-in">
		<div @key="1" v-if="!industryFormWasSubmitted">
			<form class="container-fluid csu-card__form">
				<fieldset class="csu-card__form-sizing">
					<button class="btn btn-flip-card float-right" v-show="industryFormWasSubmittedOnce" @click.prevent="resetIndustries" > <span class="font-weight-bold
						" href="#">Change Degree Level <i v class="fas fa fa-chevron-right"></i></span>
					</button>
					<div  v-if="!industryFormWasSubmitted" v-bind:class="[this.formNotFilled ? 'required-field' : 'required-field--hidden']">
						<i class="fa fa-exclamation-circle"></i> Please select a Major.
					</div>
					<div v-if="!industryFormWasSubmitted===true" class="form-group">
						<label class="font-weight-bold" for="fieldOfStudy">Select a Discipline (Optional)</label>
						<v-select
							label="discipline"
							aria-label="Select Discipline Optional"
							:options="fieldOfStudies"
							@input="updateSelect('fieldOfStudyId', 'id', $event);selected = null"
							class="csu-form-input">
						</v-select>
					</div>
					<div v-if="!industryFormWasSubmitted" class="form-group">
						<label class="font-weight-bold" for="Major" v-bind:style="[!this.form.majorId && this.submittedOnce ? errorLabel : '']">
						Select a Major
						</label>
						<v-select
							label="major"
							aria-label="Select a Major"
							v-model="selected"
							:options="this.form.fieldOfStudyId == null ? majors : selectedMajorsByField"
							@input="updateSelect('majorId', 'majorId', $event)"
							@change="updateSelect('majorId', 'majorId', $event)"
							class="csu-form-input"
                            :loading="disciplineLoad"
							v-bind:class="{ 'border-danger': !this.form.majorId && this.submittedOnce}">
						</v-select>
					</div>
					<div v-if="!industryFormWasSubmitted" class="form-group row">
						<button id="submit-btn" type="button" @click.prevent="submitForm" class="btn btn-success btn-submit">Submit</button>
					</div>
					<!-- <div class="form-group row">
						
					</div> -->
				</fieldset>
			</form>
		</div>	
		<div key="2" v-else>
			<form class="container-fluid csu-card__form">
				<fieldset class="csu-card__form-sizing">
					<div class="row">
                        <div class="col-12 text-right">
						<button
							class="btn btn-flip-card"
							@click.prevent="resetIndustries"
						>
                            Change Major <i v class="fas fa fa-chevron-right"/>
						</button>
                        </div>
					</div>
					
					<p class="text-center h5 majors-header my-5-md my-4">Select a Degree Level</p>
					<button class="btn btn-sm major-btn_postBacc" :id="'postBacc-' + form.cardIndex" @click.prevent="toggleIndustryEducationLevel('post_bacc')" >
						<i class= "major-btn_icon" v-bind:class="{'fa fa-check': industryEducationLevel == 'post_bacc', '':industryEducationLevel != 'post_bacc'}" ></i>
						Post Bacc
					</button>
					<button class="btn btn-sm major-btn_bachelors" :id="'bachelors-' + form.cardIndex" @click.prevent="toggleIndustryEducationLevel('bachelors')">
						<i class="major-btn_icon" v-bind:class="{'fa fa-check': industryEducationLevel == 'bachelors', '':industryEducationLevel != 'bachelors'}" ></i>
						Bachelors
					</button>
					<button class="btn btn-sm major-btn_someCollege" :id="'someCollege-' + form.cardIndex" @click.prevent="toggleIndustryEducationLevel('someCollege')">
						<i class="major-btn_icon" v-bind:class="{'fa fa-check': industryEducationLevel == 'someCollege', '':industryEducationLevel != 'someCollege'}"></i>
						Some College
					</button>
					<!-- <div class="form-group row">
						
					</div> -->
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
	data() {
		return {
			//temp data property to simulate the functionality
			//of the degree selector; should ultimately be removed
			isActive: true,
            disciplineLoad: false,
			form: {
				majorId: null,
				fieldOfStudyId: null,
				formWasSubmitted: false,
				formWasSubmittedOnce: false,
				formEducationLevel: "bachelors",
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
			"fetchIndustryMajorsByField",
			"toggleIndustryFormWasSubmitted",
			"resetIndustryCard",
			"fetchUpdatedMajorsByField",
			"fetchIndustries",
			"toggleIndustryEducationLevel",
			"setIndustryMajor"
			]),
		submitForm() {
			this.formNotFilled = false;
			this.submittedOnce = true;
			if (this.checkForm()) {
				this.toggleIndustryFormWasSubmitted();
                this.fetchIndustries({form: this.form, school: this.selectedUniversity});
                this.$store.dispatch("setIndustryMajor", this.selected);
                this.$store.dispatch("toggleIndustryEducationLevel", this.industryEducationLevel);
                this.selected = null;
                this.submittedOnce = false;
                this.form.majorId = null;
				this.form.fieldOfStudyId = null;
			}
		},
		resetIndustries() {
			this.submittedOnce = false;
			this.resetIndustryCard();
		},
		toggleIndustryEducationLevel(educationInput) {
			this.$store.dispatch("toggleIndustryEducationLevel",educationInput
			);
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
                this.disciplineLoad = true;
				this.fetchIndustryMajorsByField({form: this.form, school: this.selectedUniversity})
                .then(() => {
                    this.disciplineLoad = false;
                });
			}
		},
	},

	
	computed: {
		...mapGetters([
			"majors",
			"universities",
			"industryFormWasSubmitted",
			"industryFormWasSubmittedOnce",
			"industryEducationLevel",
			"industryMajorsByField",
			"selectedUniversity",
			"fieldOfStudies",
		]),
		windowSize() {
			return window.innerWidth;
		},
		selectedMajorsByField() {
			return this.industryMajorsByField;	
		},
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