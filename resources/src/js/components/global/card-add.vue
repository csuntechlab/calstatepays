<template>
    <div style="position: relative">
        <button class="btn-add" id="compare-major-button" @click="onPlus()" v-if="majorCards[0].submittedOnce">
            <img :src="this.url + '/img/majorsPage/add-btn.svg'" alt="Compare Major Button">
        </button>
        <button class="btn-add__disabled" id="compare-major-button" @click="cardPlusError()" v-else>
            <i class="fa add-icon">+<span class="tooltiptext">Complete Form</span></i>
        </button>
    </div>
</template>
<script>
import { mapGetters } from 'vuex';

export default {
    data () {
        return {
            url: '',
            isShowing: false,
        }
    },
    created () {
        this.url = window.baseUrl;
    },
    computed: {
        ...mapGetters([
            'majorCards',
            'indexOfUnsubmittedCard'
        ])
    },
    methods: {
        onPlus() {
            this.$store.dispatch('addMajorCard');
        },
        cardPlusError() {
            this.$emit('cardPlusError', this.indexOfUnsubmittedCard);
        }
    }
}
</script>
