<template>
    <div class="card-add col col-lg-10 d-flex flex-row container row align-items-center">
        <div class="col col-1">

            <button class="btn-add" @click="onPlus()" v-if="previousFormsWereSubmitted">
                <i class="fa fa-plus-circle"></i>
            </button>
            <button class="btn-add__disabled" v-else>
                <i class="fa fa-plus-circle"></i>
            </button>
        </div>
    </div>
</template>
<script>
import { mapGetters } from 'vuex';

export default {
    computed: {
        ...mapGetters([
            'previousFormsWereSubmitted'
        ])
    },
    methods: {
        onPlus(){
            this.$store.dispatch('addMajorCard');
        }
    }
}
</script>
