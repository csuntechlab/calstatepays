<template>
    <div>
        <majors-graph :majorDataSelected="majorDataSelected" :sampleData="sampleData"></majors-graph>
        <button @click="changeIndex">Switch</button>
    </div>
</template>
<script>
import majorsGraph from './majors-graph.vue';
import { mapGetters, mapActions } from 'vuex';
export default {    
    props: ['majorId'],
    data(){ 
        return {
            yearsAfter: 2,
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
    computed: {
        ...mapGetters([
            'majorData',
        ]),
        majorDataSelected(){
            if(this.majorData.length > 0){
                return this.majorData.filter((dataSet) => dataSet.education_level == 'some_college');
            }
            return [{
                average_income: 0,
                education_level: "some_college",
                major_id: "10021",
                school_id:"1153",
                years_after:"2"
            },
            {
                average_income: 0,
                education_level: "some_college",
                major_id: "10021",
                school_id:"1153",
                years_after:"2"
            },
            {
                average_income: 0,
                education_level: "some_college",
                major_id: "10021",
                school_id:"1153",
                years_after:"2"
            }
            ]
        },
        sampleData(){
            return [20000,40000,60000]
        },
        major(){
            if(this.majorId){
                return this.majorById(this.majorId);
            }  
            return null;
        },
    },
    components: {
        majorsGraph
    }
}
</script>
