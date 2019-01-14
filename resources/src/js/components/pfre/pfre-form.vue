<template>
    <form class="container-fluid csu-card__form">
        <fieldset class="csu-card__form-sizing">
            <div class="form-group">
                <div v-bind:class="[this.formNotFilled ? 'required-field' : 'required-field--hidden']">
                    <i class="fa fa-exclamation-circle"></i> Please fill out all fields.
                </div>
            </div>
            <div class="form-group">
					<label class="font-weight-bold" for="fieldOfStudy">Select a Discipline (Optional)</label>
					<v-select
						label="discipline"
						:options="fieldOfStudies"
						@input="updateGrandfatherSelect('fieldOfStudyId', 'id', $event);
                        selected = null"
						class="csu-form-input">
					</v-select>
			</div>
            <div class="form-group">
                <label for="Major" v-bind:style="[this.submitted && !this.form.majorId ? errorLabel : '']">
                    Select a Major
                </label>
                <v-select
                    label="major"
					v-if="this.form.fieldOfStudyId == null"
                    :options="majors"
                    @input="updateGrandfatherSelect('majorId', 'majorId', $event)"
                    @change="updateGrandfatherSelect('majorId', 'majorId', $event)"
                    class="csu-form-input"
                    v-bind:class="{'border-danger': this.submitted && !this.form.majorId}">
                </v-select>
                <v-select
							label="major"
							v-else
							v-model="selected"
							:options="selectedMajorsByField"
							@input="updateGrandfatherSelect('majorId', 'majorId', $event)"
							@change="updateGrandfatherSelect('majorId', 'majorId', $event)"
							class="csu-form-input"
							v-bind:class="{'border-danger': this.submitted && !this.form.majorId}">
						</v-select>
            </div>
            <div class="form-group">
                <label 
                    for="age" 
                    v-bind:style="[this.submitted && !this.form.age ? errorLabel : '']">
                    Select an Age Range
                </label>
                <v-select
                    label="age"
                    :options="ageRanges"
                    @input="updateSelect('age', $event)"
                    class="csu-form-input"
                    v-bind:class="{'border-danger': this.submitted && !this.form.age}">
                </v-select>
            </div>
            <div class="form-group">
                    <label class="form-group" for="education" v-bind:style="[this.submitted && !this.form.education ? errorLabel : '']">
                        Select an Education Level
                    </label>
                    <div class="col-12">
                        <div class="form-group row justify-content-between mb-0">
                        <label for="freshman">First Time Freshman:</label>
                        <input for="freshman" type="radio" id="freshman" v-model="form.education" value="FTF" @input="updateSelect('education', $event.target)">
                    </div>
                    <div class="form-group row justify-content-between">
                        <label for="transfer">First Time Transfer</label>
                        <input for="transfer" type="radio" id="transfer" v-model="form.education" value="FTT" @input="updateSelect('education', $event.target)">
                    </div>
                    </div>
            </div>
            <div class="form-group">
                <label for="earnings" v-bind:style="[this.submitted && !this.form.earnings ? errorLabel : '']">
                    Estimated Annual Earnings In School</label>
                <v-select
                label="earn" 
                :options="earningRanges" 
                @input="updateSelect('earnings', $event)" 
                @change="updateSelect('earnings', $event)"
                class="csu-form-input" 
                v-bind:class="{'border-danger': this.submitted && !this.form.earnings}">
                </v-select>
            </div>
            <div class="form-group">
                <label for="financialAid" v-bind:style="[this.submitted && !this.form.financialAid ? errorLabel : '']">
                        Estimated Annual Financial Aid</label>
                    <v-select 
                        label="finAid" 
                        :options="financialAidRanges"
                        @input="updateSelect('financialAid', $event)" 
                        @change="updateSelect('financialAid', $event)"
                        class="csu-form-input" 
                        v-bind:class="{'border-danger': this.submitted && !this.form.financialAid}">
                    </v-select>
            </div>
            <div class="row row--condensed" id="submit-btn-container">
                <div class="py-2">
                    <button id="submit-btn" type="button" class="btn btn-success btn-submit" @click="submitForm()">Submit</button>
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
                form: {
                    majorId: null,
                    age: null,
                    fieldOfStudyId: null,
                    education: null,
                    earnings: null,
                    financialAid: null,
                    university: "northridge"
                },

                errorLabel: {
                    color: "red",
                    fontWeight: "bold"
                },

                ageRanges: [
                    { age: "18-19", value: 1 },
                    { age: "20-24", value: 2 },
                    { age: "24-26", value: 3 },
                    { age: "26 +", value: 4 }
                ],
                earningRanges: [
                    { earn: "0", value: 1 },
                    { earn: "0 - 20,000", value: 2 },
                    { earn: "30,000 - 45,000", value: 3 },
                    { earn: "45,000 - 60,000", value: 4 },
                    { earn: "60,000 +", value: 5 }
                ],
                financialAidRanges: [
                    { finAid: "0", value: 1 },
                    { finAid: "0 - 5,000", value: 2 },
                    { finAid: "5,000 - 15,000", value: 3 },
                    { finAid: "15,000 +", value: 4 }
                ]
            };
        },
        methods: {
            ...mapActions([
                "fetchFreData",
                "fetchIndustryMajorsByField"
            ]),
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
				this.fetchIndustryMajorsByField({form: this.form, school: this.selectedUniversity});
			}
		},
            updateSelect(field, data) {
                if (data) {
                    this.form[field] = data.value;
                } else {
                    this.form[field] = null;
                }
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
                this.submitted = true;
                this.formNotFilled = false;
                if (this.checkForm()) {
                    this.scrollWin();
                    document.getElementById("submit-btn").innerHTML = "Resubmit";
                    this.fetchFreData(this.form);
                }
            },
            checkForm() {
                if (this.$v.$invalid){
                    this.formNotFilled = true;
                    return false;
                }
                else return true
            }
        },
        computed: {
            ...mapGetters([
                "majors",
                "majorNameById",
                "fieldOfStudies",
                "selectedUniversity",
                "industryMajorsByField"
                ]),
            selectedMajorName() {
                if (this.form.majorId == null) {
                    return "";
                } else {
                    return this.majorNameById(this.form.majorId);
                }
            },
            selectedMajorsByField() {
			return this.industryMajorsByField;	
		    },
        },
        validations: {
            form: {
                majorId: { required },
                age: { required },
                education: { required },
                earnings: { required },
                financialAid: { required },
                university: { required }
            }
        },
        components: {
            vSelect
        }
    };
</script>