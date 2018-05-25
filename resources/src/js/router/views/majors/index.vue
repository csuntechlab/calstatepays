<template>
    <div class="wrapper graph-content">
        <div class="col col-md-12">
            <major-card class="my-2" v-for="item in cards" :key="item.major"></major-card>
            <card-add :onPlus="onPlus"></card-add>
        </div>
    </div>
</template>
<script>
import cardAdd from '../../../components/global/card-add.vue';
import majorCard from "../../../components/majors/major-card.vue";

export default {
    data(){
        return {
            cards: [
                {
                    major: null
                },
            ]
        }
    },
    components: { 
        majorCard,
        cardAdd,
    },
    methods: {
        onPlus(){
            this.cards.push({major: null});
        }
    }
}
</script>
