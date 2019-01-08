<template>
  <div class="card">
    <form class="container-fluid csu-card__form">
      <fieldset class="csu-card__form-sizing">
        <div class="form-group">
          <label class="font-weight-bold label" for="email">Email</label>
          <v-text-field outline v-model="formdata.email" @blur="$v.formdata.email.$touch()"/>
          <p
            class="label--required"
            v-if="!$v.formdata.email.email"
          >The input must be a proper email!</p>
        </div>
        <div class="form-group">
          <label class="font-weight-bold" for="feedback">Feedback</label>
          <v-textarea outline v-model="formdata.message" @blur="$v.formdata.message"/>
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
import { email, required } from "vuelidate/lib/validators";
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
      message: {}
    }
  },
  methods: {
    submitForm() {},
    postNow() {
      axios.post("api/feedback/post", {
        headers: {
          "Content-type": "application/x-www-form-urlencoded"
        },
        body: this.formdata.message,
        email: this.formdata.email
      });
    }
  },
  components: {
    card
  }
};
</script>

