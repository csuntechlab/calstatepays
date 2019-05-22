<template>
	<form class="container-fluid csu-card__form">
		<fieldset class="csu-card__form-sizing">
			<div v-if="this.formNotFilled" class="form-group">
				<div v-bind:class="[this.formNotFilled ? 'required-field' : 'required-field--hidden']">
					<i class="fa fa-exclamation-circle"></i> Please fill out all required fields.
				</div>
			</div>
			<div class="form-group">
				<label class="font-weight-bold" for="fieldOfStudy">Select a Discipline (Optional)</label>
				<v-select
					label="discipline"
					aria-label="Select Discipline Optional"
					:options="fieldOfStudies"
					@input="updateGrandfatherSelect('fieldOfStudyId', 'id', $event); selected.majorName = null"
					class="csu-form-input"
				></v-select>
			</div>
			<div class="form-group">
				<label
					class="font-weight-bold"
					for="Major"
					v-bind:style="[this.submitted && !this.form.majorId ? errorLabel : '']"
				>Select a Major</label>
				<v-select
					label="major"
					aria-label="Select a Major"
					v-model="selected.majorName"
					:options="this.form.fieldOfStudyId == null ? majors : pfreMajorsByField"
					@input="updateGrandfatherSelect('majorId', 'majorId', $event)"
					@change="updateGrandfatherSelect('majorId', 'majorId', $event)"
					class="csu-form-input"
					:loading="pfreDisciplineLoad"
					v-bind:class="{'border-danger': this.submitted && !this.form.majorId}"
				></v-select>
			</div>
			<div class="form-group">
				<label
					class="form-group font-weight-bold"
					for="education"
					v-bind:style="[this.submitted && !this.form.education ? errorLabel : '']"
				>Select an Education Level</label>
				<div class="row">
					<div class="col-sm-6 col-lg-12">
						<button
							class="pfre-btn"
							:class="{'pfre-btn--selected': this.form.education == 'FTF', '':this.form.education != 'FTF'}"
							@click.prevent="setEducationLevel('FTF')"
						>First Time Freshman</button>
					</div>
					<div class="col-sm-6 col-lg-12">
						<button
							class="pfre-btn"
							:class="{'pfre-btn--selected': this.form.education == 'FTT', '':this.form.education != 'FTT'}"
							@click.prevent="setEducationLevel('FTT')"
						>First Time Transfer</button>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label
					class="font-weight-bold"
					for="earnings"
					v-bind:style="[this.submitted && !this.form.earnings ? errorLabel : '']"
				>Estimated Annual Earnings In School</label>
				<v-select
					label="earn"
					aria-label="Estimated Annual Earnings In School"
					:options="earningRanges"
					v-model="selected.earnings"
					@input="updateSelect('earnings', $event)"
					@change="updateSelect('earnings', $event)"
					class="csu-form-input"
					v-bind:class="{'border-danger': this.submitted && !this.form.earnings}"
				></v-select>
			</div>
			<div class="form-group">
				<label
					for="financialAid"
					v-bind:style="[this.submitted && !this.form.financialAid ? errorLabel : '']"
					class="font-weight-bold"
				>Estimated Annual Financial Aid</label>
				<v-select
					label="finAid"
					aria-label="Estimated Annual Financial Aid"
					:options="financialAidRanges"
					v-model="selected.financialAid"
					@input="updateSelect('financialAid', $event)"
					@change="updateSelect('financialAid', $event)"
					class="csu-form-input"
					v-bind:class="{'border-danger': this.submitted && !this.form.financialAid}"
				></v-select>
			</div>
			<div class="row row--condensed" id="submit-btn-container">
				<div class="py-2">
					<button
						id="submit-btn"
						type="button"
						class="btn btn-success btn-submit"
						@click="submitForm()"
					>Submit</button>
				</div>
			</div>
		</fieldset>
	</form>
</template>
<script>
import vSelect from "vue-select";
import { updateForm } from "../../utils/index";
import { required } from "vuelidate/lib/validators";
import { mapGetters, mapActions } from "vuex";

export default {
	data() {
		return {
			formNotFilled: false,
			submitted: false,
			selected: {
				majorName: null,
				education: null,
				earnings: null,
				financialAid: null
			},
			form: {
				fieldOfStudyId: null,
				majorId: null,
				education: null,
				earnings: null,
				financialAid: null
			},

			errorLabel: {
				color: "red",
				fontWeight: "bold"
			},

			earningRanges: [
				{ earn: "$0", value: 0 },
				{ earn: "$4,500", value: 4500},
				{ earn: "$10,000", value: 10000 }
			],
			financialAidRanges: [
				{ finAid: "$0", value: 0 },
				{ finAid: "$3,000", value: 3000 },
				{ finAid: "$10,000", value: 10000 },
				]
		};
	},
	methods: {
		...mapActions(["fetchFreData", "fetchPfreMajorsByField"]),
		updateGrandfatherSelect(field, dataKey, data) {
			this.submitted = false;
			if (data) {
				this.form[field] = data[dataKey];
				this.handleFieldOfStudyMajors(field);
			} else {
				this.form[field] = null;
			}
		},
		handleFieldOfStudyMajors(field) {
			if (field == "fieldOfStudyId") {
				this.fetchPfreMajorsByField({
					form: this.form,
					school: this.selectedUniversity
				});
			}
		},
		updateSelect(field, data) {
			if (data) {
				this.form[field] = data.value;
			} else {
				this.form[field] = null;
			}
		},
		setEducationLevel(data) {
			this.form.education = data;
			this.selected.education = data;
		},
		scrollWin() {
			if (window.innerWidth <= 767) {
				var scrollTop;
				var progressBar = document.getElementById(
					"submit-btn-container"
				);
				progressBar.scrollIntoView({
					behavior: "smooth",
					block: "start",
					inline: "end"
				});
			}
		},
		submitForm() {
			this.formNotFilled = false;
			this.submitted = true;
			if (this.checkForm()) {
				this.scrollWin();
				document.getElementById("submit-btn").innerHTML = "Resubmit";
				this.$store.dispatch("submitPfreForm");
				this.$store.dispatch("setPfreSelections", this.selected);
				this.fetchFreData({
					...this.form,
					school: this.selectedUniversity
				});
			}
		},
		checkForm() {
			if (this.$v.$invalid) {
				this.formNotFilled = true;
				return false;
			} else return true;
		}
	},
	computed: {
		...mapGetters([
			"majors",
			"selectedUniversity",
			"fieldOfStudies",
			"selectedUniversity",
			"pfreMajorsByField",
			"pfreDisciplineLoad"
		]),
	},
	validations: {
		form: {
			majorId: { required },
			education: { required },
			earnings: { required },
			financialAid: { required }
		}
	},
	components: {
		vSelect
	}
};
</script>