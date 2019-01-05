<template>
    <form class="container-fluid csu-card__form">
        <fieldset class="csu-card__form-sizing">
            <div class="form-group">
                <label class="font-weight-bold" for="email">Email</label>      
                <v-text-field v-model="formdata.email" @blur="$v.formdata.email.$touch()"/>
                <p v-if="!$v.formdata.email.email">The input must be a proper email!</p>
            </div>
            <div class="form-group">
                <label class="font-weight-bold" for="feedback">Feedback</label>
                <v-textarea v-model="formdata.message" @blur="$v.formdata.message"/>
            </div>
            <div class="form-group row">
                <button type="button" @click.prevent="submitForm" class="btn btn-success btn-submit">Submit</button>
            </div>
        </fieldset>
    </form>
</template>

<script>
import { email, required } from "vuelidate/lib/validators";

export default {
    data() {
        return {
            formdata:{
                email:'',
                message:''
            }
        }
    },
    validations: {
        formdata: {
            email: {
                email,
                required
            },
            message: {

            }
        }
    },
    methods: {
        submitForm(){
            console.log('hello world')
            console.log(this.formdata.email)
            console.log(this.formdata.message)
        }
    }
}
</script>

