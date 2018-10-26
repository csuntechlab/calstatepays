<template>
    <form class="container-fluid csu-card__form">
		<fieldset class="csu-card__form-sizing">
			<div v-bind:class="[this.formNotFilled ? 'required-field' : 'required-field--hidden']">
				<i class="fa fa-exclamation-circle"></i> Please select a Major.
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
			<div class="form-group row">
				<button id="submit-btn" type="button" @click="submitForm" class="btn btn-success btn-submit">Submit</button>
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
				university: null
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
			"fetchUpdatedMajorsByField",
			"fetchIndustries",]),
		submitForm() {
			this.formNotFilled = false;
			this.submittedOnce = true;
			if (this.checkForm()) {
				this.$emit('triggerLoadingScreen', true);
				document.getElementById("submit-btn").innerHTML = "Resubmit";
				this.fetchIndustries(this.form);
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