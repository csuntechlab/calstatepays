<template>
	<div class="row">
		<div class="col-12">
			<form class="container-fluid csu-card csu-card__feedback">
				<div v-show="submitted">
					<h3 class="csu-card__title--center py-5">Thank you for your feedback!</h3>
					<router-link class="text-center" to="/">
						<p>Return to the Home Page</p>
					</router-link>
				</div>
				<fieldset v-show="!submitted">
					<div class="row">
						<h3 class="csu-card__title--center pb-4">Send Us Your Feedback</h3>
						<p v-show="showError" class="red--text">Something went wrong please try again.</p>
					</div>
					<div class="form-group">
						<v-text-field
							outline
							v-model="formdata.email"
							:label="'Enter Your Email'"
							:hint="'example@email.com'"
						/>
						<p class="label--required" v-if="$v.formdata.email.$error">This field requires a valid email!</p>
					</div>
					<div class="form-group">
						<v-textarea outline v-model="formdata.body" :label="'Enter Your Message'"/>
						<p class="label--required" v-if="$v.formdata.body.$error">Message is required!</p>
					</div>
					<div class="form-group">
						<div class="g-recaptcha" id="feedback-recaptcha" :data-sitekey="this.site_key"></div>
					</div>
					<div class="form-group row">
						<button type="button" @click.prevent="submitForm" class="btn btn-success btn-submit">Submit</button>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</template>

<script>
import { email, required, maxLength } from "vuelidate/lib/validators";
import card from "./../global/card";
import { mapGetters, mapActions } from "vuex";

export default {
	data() {
		return {
			formdata: {
				email: "",
				body: ""
			},
			submitted: false,
			site_key: process.env.MIX_RE_CAP_SITE_KEY,
			showError: false
		};
	},
	beforeCreate() {
		let fileref=document.createElement('script');
		fileref.setAttribute("type","text/javascript");
		fileref.setAttribute("src", "https://www.google.com/recaptcha/api.js");
		document.getElementsByTagName("head")[0].appendChild(fileref);
	},
	validations: {
		formdata: {
			email: {
				email,
				required
			},
			body: { required }
		}
	},
	methods: {
		submitForm() {
			this.$v.$touch();
			if (!this.$v.$invalid && (this.recaptcha !== undefined)) {
				this.postNow();
			}
		},
		postNow() {
			axios.post("api/feedback/post", {
				headers: {
					"Content-type": "application/x-www-form-urlencoded"
				},
				body: this.formdata.body,
				email: this.formdata.email,
				captcha: this.recaptcha
			}).then((resp) => {
				if (resp.data.success) {
					this.submitted = true;
					this.clearPost();
				} else {
					this.showError = true;
				}
			});
		},
		clearPost() {
			this.$v.$reset();
			this.formdata = {
				email: "",
				message: ""
			};
		}
	},
	computed: {
		recaptcha() {
			return document.getElementById('g-recaptcha-response').value;
		}
	},
	components: {
		card
	}
};
</script>

