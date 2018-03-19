<template>
    <div>
        <majors-graph :index="index" :yData="yData"></majors-graph>
    </div>
</template>
<script>
import majorsGraph from './majors-graph.vue';
export default {
    data(){
        return {
            index: 0,
            yData: [
                [20000, 33000, 38000, 41000],
                [35000, 42000, 58000, 72000],
                [65000, 85000, 92000, 99000],
                [10000, 13000, 38000, 41000],
                [35000, 62000, 98000, 102000],
                [90000, 99000, 101000, 130000]
            ]
        }
    },
    methods: {
        changeIndex(){
            if(this.index == 0){
                this.index = 3;
            } else {
                this.index = 0;
            }
        }
    },
    components: {
        majorsGraph
    }
}
</script>
