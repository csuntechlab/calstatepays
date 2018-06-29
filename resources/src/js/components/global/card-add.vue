<template>
    <div>
        <button class="btn-add" id="compare-major-button" @click="onPlus()" v-if="indexOfUnsubmittedCard == -1">
            <i class="fa add-icon">+<span class="tooltiptext">Compare Major</span></i>
        </button>
        <button class="btn-add__disabled" id="compare-major-button" @click="cardPlusError()" v-else>
            <i class="fa add-icon">+<span class="tooltiptext">Complete Form</span></i>
        </button>
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
