<template>
  <div class="card">
    <form class="container-fluid csu-card__form">
      <fieldset class="csu-card__form-sizing">
        <div class="form-group">
          <label class="font-weight-bold label" for="email">Email</label>
          <v-text-field outline v-model="formdata.email" @blur="$v.formdata.email.$touch()"/>
          <p
            class="label--required"
            v-if="$v.formdata.email.$error"
          >This field requires a valid email!</p>
        </div>
        <div class="form-group">
          <label class="font-weight-bold" for="feedback">Feedback</label>
          <v-textarea outline v-model="formdata.message" @blur="$v.formdata.message.$touch()"/>
          <p class="label--required" v-if="$v.formdata.message.$error">Message is required!</p>
          <p
            class="label--required"
            v-if="!$v.formdata.message.maxLength"
          >Must not be greater {{ $v.formdata.message.$params.maxLength.max }} characters!</p>
        </div>
        <div class="form-group row">
          <button
            type="button"
            @click.prevent="submitForm"
            class="btn btn-success btn-submit"
          >Submit</button>
        </div>
      </fieldset>
    </form>
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
        message: ""
      }
    };
  },
  validations: {
    formdata: {
      email: {
        email,
        required
      },
      message: {
        required,
        maxLength: maxLength(400)
      }
    }
  },
  methods: {
    submitForm() {
      if (!this.$v.$invalid) {
        this.postNow();
        this.clearPost();
      }
    },
    postNow() {
      axios.post("api/feedback/post", {
        headers: {
          "Content-type": "application/x-www-form-urlencoded"
        },
        body: this.formdata.message,
        email: this.formdata.email
      });
    },
    clearPost() {
      this.$refs.myFileInput.value = "";
      this.$v.$reset();
      this.formdata = {
        email: "",
        message: ""
      };
    }
  },
  components: {
    card
  }
};
</script>

