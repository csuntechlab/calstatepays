<template>
    <div class="row wrapper graph-content card-padding">
        <div class="col col-md-12">
            <major-card v-if="isDesktop" class="my-2 card-item" v-for="(majorCard, index) in desktopCards" :key="index" :index=index :windowWidth=windowWidth></major-card>
            <major-card-mobile v-if="isMobile"  class="my-2" v-for="(majorCard, index) in mobileCards" :key="index" :index=index :windowWidth=windowWidth></major-card-mobile>
            <card-add id="plus" :onPlus="onPlus"></card-add>
        </div>
    </div>
</template>
<script>
import cardAdd from '../../../components/global/card-add.vue';
import majorCard from "../../../components/majors/major-card.vue";
import majorCardMobile from "../../../components/majors/major-card-mobile.vue";
import { mapGetters } from 'vuex';

export default {
    data() {
        return {
            windowWidth: 0,
            isDesktop: true,
            isMobile: false,
        }
    },
    computed: {
        ...mapGetters([
            'majorCards'
        ]),
        desktopCards() {
            return (this.isDesktop ? this.majorCards : null);
        },
        mobileCards() {
            return (this.isDesktop ? null : this.majorCards);
        },
    },
    updated: function(){
        //Only run if more than one card exists
        var lastCardIndex = this.majorCards.length - 1;
        if(lastCardIndex > 0){
            this.scrollToNextCard(lastCardIndex);
        }
    },
    methods: {
        getWindowWidth(event) {
            this.windowWidth = document.documentElement.clientWidth;
            this.windowWidth < 1000 ? (this.isDesktop = false, this.isMobile = true) : (this.isDesktop = true, this.isMobile = false);
        },
        onPlus(){
            this.$store.dispatch('addMajorCard');
        },
        scrollToNextCard(lastCardIndex){
            var progressBar = document.getElementById("majorCardHasIndex-" + lastCardIndex);
            progressBar.scrollIntoView({
                behavior: "smooth",
                block: "end",
                inline: "nearest"
            });
        }
    },
    mounted() {
        this.$nextTick(function() {
            window.addEventListener('resize', this.getWindowWidth);
            this.getWindowWidth();
        });
    },
    beforeDestroy() {
        window.removeEventListener('resize', this.getWindowWidth);
    },
    components: { 
        majorCard,
        majorCardMobile,
        cardAdd,
    },
}
</script>
