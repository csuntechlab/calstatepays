<template>
    <div class="row wrapper graph-content card-padding">
        <div class="col col-md-12">
            <major-card v-if="windowWidth > 800" class="my-2" v-for="(majorCard, index) in majorCards" :key="index" :index=index></major-card>
            <major-card-mobile v-else class="my-2" v-for="(majorCard, index) in mobileCards" :key="index" :index=index></major-card-mobile>
            <card-add :onPlus="onPlus"></card-add>
        </div>
    </div>
</template>
<script>
import cardAdd from '../../../components/global/card-add.vue';
import majorCard from "../../../components/majors/major-card.vue";
import majorCardMobile from "../../../components/majors/major-card-mobile.vue";
import { mapGetters } from 'vuex';

export default {
    computed: {
        ...mapGetters([
            'majorCards'
        ]),
        mobileCards() {
            return this.majorCards;
        },
        windowWidth() {
            return window.innerWidth;
        }
    },
    components: { 
        majorCard,
        majorCardMobile,
        cardAdd,
    },
    methods: {
        onPlus(){
            this.$store.dispatch('addMajorCard');
        }
    }
}
</script>
