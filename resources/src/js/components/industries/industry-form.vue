<template>
    <form class="container-fluid csu-card__form">
		<fieldset class="csu-card__form-sizing">
			<div v-if="!form.formWasSubmitted" v-bind:class="[this.formNotFilled ? 'required-field' : 'required-field--hidden']">
				<i class="fa fa-exclamation-circle"></i> Please select a Major.
			</div>
			<div v-if="!form.formWasSubmitted===true" class="form-group">
					<label for="fieldOfStudy">Select a Discipline (Optional)</label>
					<v-select
							label="discipline"
							:options="fieldOfStudies"
							@input="updateSelect('fieldOfStudyId', 'id', $event)"
							@change="updateSelect('fieldOfStudyId', 'id', $event)"
							class="csu-form-input">
					</v-select>
				</div>
			<div v-if="!form.formWasSubmitted" class="form-group">
				<label for="Major" v-bind:style="[!this.form.majorId && this.submittedOnce ? errorLabel : '']">
					Select a Major
				</label>
				<v-select
					label="major"
					v-if="this.form.fieldOfStudyId == null"
					v-model="selected"
					:options="majors"
					@input="updateSelect('majorId', 'majorId', $event)"
					@change="updateSelect('majorId', 'majorId', $event)"
					class="csu-form-input"
					v-bind:class="{ 'border-danger': !this.form.majorId && this.submittedOnce}">
				</v-select>
				<v-select
						label="major"
						v-else
						v-model="selected"
						:options="selectedMajorsByField"
						@input="updateSelect('majorId', 'majorId', $event)"
						@change="updateSelect('majorId', 'majorId', $event)"
						class="csu-form-input"
						v-bind:class="{'border-danger': this.submittedOnce && !this.form.majorId}">
					</v-select>
			</div>
			<div v-if="!form.formWasSubmitted" class="form-group row">
				<button id="submit-btn" type="button" @click="submitForm" class="btn btn-success btn-submit">Submit</button>
			</div>
			<div v-else class="majorBtnWrapper">
				<p v-show="windowSize > 500" class="text-center h3 majors-header my-5-md my-4">Select a Degree Level</p>
				<button class="btn btn-sm major-btn_all" :id="'allDegrees-' + form.cardIndex" @click.prevent="toggleEducationLevel('allDegrees')">
					<i class="major-btn_icon" 
					></i>
					All Levels
				</button>
				<button class="btn btn-sm major-btn_postBacc" :id="'postBacc-' + form.cardIndex" @click.prevent="toggleEducationLevel('postBacc')" >
					<i class= "major-btn_icon" 
					></i>
					Post Bacc
				</button>
				<button class="btn btn-sm major-btn_bachelors" :id="'bachelors-' + form.cardIndex" @click.prevent="toggleEducationLevel('bachelors')">
					<i class="major-btn_icon" 
				></i>
					Bachelors
				</button>
				<button class="btn btn-sm major-btn_someCollege" :id="'someCollege-' + form.cardIndex" @click.prevent="toggleEducationLevel('someCollege')">
					<i class="major-btn_icon" 
					></i>
					Some College
				</button>
			</div>
		</fieldset>
    </form>
</template>
<script>
import vSelect from "vue-select";
import { required } from "vuelidate/lib/validators";
import { updateForm } from "../../utils/index";
import { mapGetters, mapActions } from "vuex";

export default {
	data() {
		return {
			form: {
				majorId: null,
				fieldOfStudyId: null,
				university: null,
				formWasSubmitted: false,
				formEducationLevel: "allDegrees",
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

	mounted() {
		this.form.university = this.selectedUniversity;
		this.form.schoolId = this.selectedUniversity;
	},

	methods: {
		...mapActions([
			"fetchIndustryMajorsByField",
			"toggleFormWasSubmitted",
			"fetchUpdatedMajorsByField",
			"fetchIndustries",]),
		submitForm() {
			this.formNotFilled = false;
			this.submittedOnce = true;
			if (this.checkForm()) {
				document.getElementById("submit-btn").innerHTML = "Resubmit";
				this.fetchIndustries(this.form);
				this.form.formWasSubmitted=true;
			}
		},
		toggleEducationLevel(educationInput) {
			this.$store.dispatch("toggleEducationLevel", {
				educationLevel: educationInput
			});
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
			
				this.fetchIndustryMajorsByField(this.form);
			}
		},
	},

	computed: {
		...mapGetters([
			"majors",
			"universities",
			"industryMajorsByField",
			"selectedUniversity",
			"fieldOfStudies"
		]),
		windowSize() {
			return window.innerWidth;
		},
		selectedMajorsByField() {
			return this.industryMajorsByField;
			
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