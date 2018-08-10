<template>
    <form class="form--inverted form--degreeLevel container mb-4 mb-0-md">
        <div class="form__group csu-card__form-sizing">
                <div v-bind:class="[this.formNotFilled ? 'required-field' : 'required-field--hidden']">
                   <i class="fas fa-exclamation-circle"></i> Please select a Campus and Major.
                </div>
            <div class="row row--condensed mt-3">
                <div class="col col-12">
                    <label for="campus" v-bind:style="[!this.form.university && this.submittedOnce ? errorLabel : '']">
						Select a Campus</label>
                    <v-select
                        label="name"
                        :options="universities"
                        @input="updateSelect('university', 'id', $event)" 
                        @change="updateSelect('university', 'id', $event)"
                        class="csu-form-input-major"
                        v-bind:class="{ 'border-danger': !this.form.university && this.submittedOnce}">
                    </v-select>
                </div>
            </div>
            <div class="row row--condensed mt-3">
                <div class="col col-12">
                    <label for="Major" v-bind:style="[!this.form.majorId && this.submittedOnce ? errorLabel : '']">
						Select a Major</label>
                    <v-select
                        label="major"
                        v-model="selected"
                        :options="majors"
                        @input="updateSelect('majorId', 'majorId', $event)"
                        @change="updateSelect('majorId', 'majorId', $event)"
                        class="csu-form-input-major"
                        v-bind:class="{ 'border-danger': !this.form.majorId && this.submittedOnce}">
                    </v-select>
                </div>
            </div>
            <div class="row row--condensed">
                <div class="py-4">
                    <button id="submit-btn" type="button" @click="submitForm" class="btn btn-success btn-submit">Submit</button>
                </div>
            </div>
        </div>
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

	methods: {
		...mapActions(["fetchUpdatedMajorsByField", "fetchIndustries"]),

		submitForm() {
			this.formNotFilled = false;
			this.submittedOnce = true;
			if (this.checkForm()) {
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
			} else {
				this.form[field] = null;
			}
		}
	},

	computed: {
		...mapGetters(["majors", "universities", "majorsByField"])
	},

	validations: {
		form: {
			majorId: { required },
			university: { required }
		}
	},
	components: {
		vSelect
	}
};
</script>