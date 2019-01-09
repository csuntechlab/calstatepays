<template>
  <div class="card">
    <form v-if="!done" class="container-fluid csu-card__form">
      <fieldset class="csu-card__form-sizing">
        <div class="form-group">
          <label class="font-weight-bold label" for="email">Email</label>
          <v-text-field outline v-model="formdata.email"/>
          <p
            class="label--required"
            v-if="$v.formdata.email.$error"
          >This field requires a valid email!</p>
        </div>
        <div class="form-group">
          <label class="font-weight-bold" for="feedback">Feedback</label>
          <v-textarea outline v-model="formdata.body"/>
          <p class="label--required" v-if="$v.formdata.body.$error">Message is required!</p>
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
    <p v-else>Thank you for your feedback</p>
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
      done: false
    };
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
      if (!this.$v.$invalid) {
        this.postNow();
        this.clearPost();
        this.done = true;
      } else {
        return false;
      }
    },
    postNow() {
      axios.post("api/feedback/post", {
        headers: {
          "Content-type": "application/x-www-form-urlencoded"
        },
        body: this.formdata.body,
        email: this.formdata.email
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
  components: {
    card
  }
};
</script>

