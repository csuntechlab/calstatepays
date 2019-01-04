<template>
    <form class="container-fluid csu-card__form">
        <fieldset class="csu-card__form-sizing">
            <div class="form-group">
                <label class="font-weight-bold" for="email">Email</label>      
                <v-text-field/>
            </div>
            <div class="form-group">
                <label class="font-weight-bold" for="feedback">Feedback</label>
                <v-textarea />
            </div>
            <div class="form-group row">
                <button type="button" @click.prevent="submitForm" class="btn btn-success btn-submit">Submit</button>
            </div>
        </fieldset>
    </form>
</template>


