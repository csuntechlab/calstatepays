<template>
    <div class="card-add col col-lg-10 d-flex flex-row container row align-items-center">
        <div class="col col-1">

            <button class="btn-add" @click="onPlus()" v-if="indexOfUnsubmittedCard == -1">
                <i class="fa fa-plus-circle"></i>
            </button>
            <button class="btn-add__disabled" @click="cardPlusError()" v-else>
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
            'indexOfUnsubmittedCard'
        ])
    },
    methods: {
        onPlus(){
            this.$store.dispatch('addMajorCard');
        },
        cardPlusError() {
            this.$emit('cardPlusError', this.indexOfUnsubmittedCard);
        }
    }
}
</script>
