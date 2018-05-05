<template>
    <div>
        <majors-graph :majorDataSelected="majorDataSelected" :majorId="form.majorId"></majors-graph>
        <button @click="changeIndex">Switch</button>
    </div>
</template>
<script>
import majorsGraph from './majors-graph.vue';
import { mapGetters, mapActions } from 'vuex';
export default {    
    props: ['form'],
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
            'majorById',
        ]),
        majorDataByMajor(){
            if (this.form.majorId && this.majorData.length > 0){
                return this.majorData.filter((dataSet) => dataSet.major_id == this.form.majorId);
            }
            return [];
        },
        majorDataSelected(){
            if(this.majorDataByMajor.length > 0 && this.form.majorId){
                if(this.form.educationLevel == "allDegrees"){
                    return [
                        this.majorDataByMajor.filter((dataSet) => dataSet.education_level == 'some_college').map((dataSet) => dataSet.average_income),
                        this.majorDataByMajor.filter((dataSet) => dataSet.education_level == 'bachelors').map((dataSet) => dataSet.average_income),
                        [40000, 50000, 90000],
                        //TODO: REPLACE THESE HARDCODED VALUES WITH ADV DEGREE VALUES WHEN WE GET DATA --TONY
                    ]
                } else if(this.form.educationLevel == "bachelors"){
                    return [
                        [20000,30000,50000],
                        //TODO: REPLACE THESE HARDCODED VALUES WITH 25th percentile VALUES WHEN WE GET DATA --TONY
                        this.majorDataByMajor.filter((dataSet) => dataSet.education_level == 'bachelors').map((dataSet) => dataSet.average_income),
                        //TODO: REPLACE THESE HARDCODED VALUES WITH 25th percentile VALUES WHEN WE GET DATA --TONY
                        [50000,70000,100000]
                    ]
                }
                else if(this.form.educationLevel == "someCollege"){
                    return [
                        [10000,20000,40000],
                        //TODO: REPLACE THESE HARDCODED VALUES WITH 25th percentile VALUES WHEN WE GET DATA --TONY
                        this.majorDataByMajor.filter((dataSet) => dataSet.education_level == 'some_college').map((dataSet) => dataSet.average_income),
                        //TODO: REPLACE THESE HARDCODED VALUES WITH 25th percentile VALUES WHEN WE GET DATA --TONY
                        [40000,60000,90000]
                    ]
                }
            } 
            return [
                    [0,0,0],
                    [0,0,0],
                    [0,0,0]
                ];
        },
        major(){
            if(this.form.majorId){
                return this.majorById(this.form.majorId);
            }  
            return null;
        },
    },
    components: {
        majorsGraph
    }
}
</script>
