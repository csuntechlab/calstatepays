<template>
    <div class="row wrapper graph-content card-padding">
        <div class="col col-md-12">
            <major-card class="my-2" v-for="(majorCard, index) in majorCards" :key="index" :index=index></major-card>
            <card-add :onPlus="onPlus"></card-add>
        </div>
    </div>
</template>
<script>
import cardAdd from '../../../components/global/card-add.vue';
import majorCard from "../../../components/majors/major-card.vue";
import { mapGetters } from 'vuex';

export default {
    computed: {
        ...mapGetters([
            'majorCards'
        ])
    },
    components: { 
        majorCard,
        cardAdd,
    },
    methods: {
        onPlus(){
            this.$store.dispatch('addMajorCard');
        }
    }
}
</script>
