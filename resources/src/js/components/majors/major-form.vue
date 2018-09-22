<template>
    <form v-bind:id="'majorForm-' + form.cardIndex">
		<fieldset class="csu-card__form-sizing">
			<div v-if="!selectedFormWasSubmitted">
					<div v-if="!selectedFormWasSubmitted" class="form-group" v-bind:class="[this.formNotFilled ? 'required-field' : 'required-field--hidden']">
						<i class="fas fa-exclamation-circle"></i> Please select a Campus and Major.
					</div>
				<div class="form-group">
					<label for="campus" v-bind:style="[this.submittedOnce && !this.form.schoolId? errorLabel : '']">
						Select a Campus</label>
					<v-select
						label="name"
						:options="universities"
						@input="updateSelect('schoolId', 'id', $event)" 
						@change="updateSelect('schoolId', 'id', $event)"
						class="csu-form-input-major"
						v-bind:class="{'border-danger': this.submittedOnce && !this.form.schoolId}">
					</v-select>
				</div>
				<div class="form-group">
					<label for="fieldOfStudy">Select a Discipline (Optional)</label>
					<v-select
							label="discipline"
							:options="fieldOfStudies"
							@input="updateSelect('fieldOfStudyId', 'id', $event)"
							@change="updateSelect('fieldOfStudyId', 'id', $event)"
							class="csu-form-input">
					</v-select>
				</div>
				<div class="form-group">
					<label for="Major" v-bind:style="[this.submittedOnce && !this.form.majorId ? errorLabel : '']">
						Select a Major</label>
					<v-select
						label="major"
						v-if="this.form.fieldOfStudyId == null"
						v-model="selected"
						:options="majors"
						@input="updateSelect('majorId', 'majorId', $event)"
						@change="updateSelect('majorId', 'majorId', $event)"
						class="csu-form-input-major"
						v-bind:class="{'border-danger': this.submittedOnce && !this.form.majorId}">
					</v-select>
					<v-select
						label="major"
						v-else
						v-model="selected"
						:options="selectedMajorsByField"
						@input="updateSelect('majorId', 'majorId', $event)"
						@change="updateSelect('majorId', 'majorId', $event)"
						class="csu-form-input-major">
					</v-select>
				</div>
				<div class="form-group row">
					<button type="button" @click="submitForm" class="btn btn-success btn-submit">Submit</button>
				</div>
			</div>
			<div v-else class="majorBtnWrapper">
				<p v-show="windowSize > 500" class="text-center h3 majors-header my-5-md my-4">Select a Degree Level</p>
				<button class="btn btn-sm major-btn_all" :id="'allDegrees-' + form.cardIndex" @click.prevent="toggleEducationLevel('allDegrees')" v-bind:class="{'selected-btn_all': this.educationLevel(this.index) == 'allDegrees'}">
					<i class="major-btn_icon" 
					v-bind:class="{'fas fa-check-circle': this.educationLevel(this.index) == 'allDegrees', 'far fa-circle':this.educationLevel(this.index) != 'allDegrees'}"></i>
					All Levels
				</button>
				<button class="btn btn-sm major-btn_postBacc" :id="'postBacc-' + form.cardIndex" @click.prevent="toggleEducationLevel('postBacc')" v-bind:class="{'selected-btn_postBacc': this.educationLevel(this.index) == 'postBacc'}">
					<i class= "major-btn_icon" 
					v-bind:class="{'fas fa-check-circle': this.educationLevel(this.index) == 'postBacc', 'far fa-circle':this.educationLevel(this.index) != 'postBacc'}"></i>
					Post Bacc
				</button>
				<button class="btn btn-sm major-btn_bachelors" :id="'bachelors-' + form.cardIndex" @click.prevent="toggleEducationLevel('bachelors')" v-bind:class="{'selected-btn_bachelors': this.educationLevel(this.index) == 'bachelors'}">
					<i class="major-btn_icon" 
					v-bind:class="{'fas fa-check-circle': this.educationLevel(this.index) == 'bachelors', 'far fa-circle':this.educationLevel(this.index) != 'bachelors'}"></i>
					Bachelors
				</button>
				<button class="btn btn-sm major-btn_someCollege" :id="'someCollege-' + form.cardIndex" @click.prevent="toggleEducationLevel('someCollege')" v-bind:class="{'selected-btn_someCollege': this.educationLevel(this.index) == 'someCollege'}">
					<i class="major-btn_icon" 
					v-bind:class="{'fas fa-check-circle': this.educationLevel(this.index) == 'someCollege', 'far fa-circle':this.educationLevel(this.index) != 'someCollege'}"></i>
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
	props: ["index"],
	data() {
		return {
			form: {
				cardIndex: this.index,
				majorId: null,
				formWasSubmitted: false,
				schoolId: null,
				fieldOfStudyId: null,
				formEducationLevel: "allDegrees",
				errors: {
					major: null,
					university: null
				},
				isUnivSelected: true,
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
			"toggleFormWasSubmitted",
			"fetchUpdatedMajorsByField",
			"fetchMajorData"
		]),
		updateForm,

		submitForm() {
			this.formNotFilled = false;
			this.submittedOnce = true;
			if (this.checkForm()) {
				this.toggleFormWasSubmitted(this.form.cardIndex);
				this.fetchIndustryImages(this.form);
				this.$store.dispatch("setUniversity", this.form.schoolId);
				this.fetchMajorData(this.form);
				this.form.majorId = null;
				this.form.schoolId = null;
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
				this.fetchUpdatedMajorsByField(this.form);
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
			"universities",
			"majorsByField",
			"formWasSubmitted",
			"educationLevel"
		]),
		selectedMajorsByField() {
			this.selected = null;
			return this.majorsByField(this.index);
		},
		removeMajorsByField() {
			return this.majorsByField(null);
		},
		selectedFormWasSubmitted() {
			return this.formWasSubmitted(this.index);
		},
		windowSize() {
			return window.innerWidth;
		}
	},
	validations: {
		form: {
			majorId: { required },
			schoolId: { required }
		}
	},
	components: {
		vSelect
	}
};
</script>
