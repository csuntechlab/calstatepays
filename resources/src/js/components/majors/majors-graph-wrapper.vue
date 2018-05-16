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
            'majorDataByMajorId'
        ]),
        majorDataByMajor(){
            if (this.form.majorId && this.majorData.length > 0){
                return this.majorDataByMajorId(this.form.majorId)
            }
            return null;
        },
        majorDataSelected(){
            if(this.majorDataByMajor && this.form.majorId){
                if(this.form.educationLevel == "allDegrees"){
                    return [
                        [
                            this.majorDataByMajor.post_bacc['2'].avg_annual_wage,
                            this.majorDataByMajor.post_bacc['5'].avg_annual_wage,
                            this.majorDataByMajor.post_bacc['10'].avg_annual_wage,
                        ],
                        [
                            this.majorDataByMajor.bachelors['2'].avg_annual_wage,
                            this.majorDataByMajor.bachelors['5'].avg_annual_wage,
                            this.majorDataByMajor.bachelors['10'].avg_annual_wage,
                        ],
                        [
                            this.majorDataByMajor.some_college['2'].avg_annual_wage,
                            this.majorDataByMajor.some_college['5'].avg_annual_wage,
                            this.majorDataByMajor.some_college['10'].avg_annual_wage,
                        ],
                    ]
                } else {
                    return [
                        [
                            this.majorDataByMajor[this.form.educationLevel]['2']._75th,
                            this.majorDataByMajor[this.form.educationLevel]['5']._75th,
                            this.majorDataByMajor[this.form.educationLevel]['10']._75th,
                        ],
                        [
                            this.majorDataByMajor[this.form.educationLevel]['2']._50th,
                            this.majorDataByMajor[this.form.educationLevel]['5']._50th,
                            this.majorDataByMajor[this.form.educationLevel]['10']._50th,
                        ],
                        [
                            this.majorDataByMajor[this.form.educationLevel]['2']._25th,
                            this.majorDataByMajor[this.form.educationLevel]['5']._25th,
                            this.majorDataByMajor[this.form.educationLevel]['10']._25th,
                        ],
                       
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
