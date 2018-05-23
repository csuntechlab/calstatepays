<template>
    <div>
        <majors-graph :majorDataSelected="majorDataSelected" :majorId="form.majorId" :educationLevel="form.educationLevel"></majors-graph>
    </div>
</template>
<script>
import majorsGraph from './majors-graph.vue';
import { mapGetters, mapActions } from 'vuex';
export default {    
    props: ['form'],
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
                            this.majorDataByMajor.postBacc['2'].avg_annual_wage,
                            this.majorDataByMajor.postBacc['5'].avg_annual_wage,
                            this.majorDataByMajor.postBacc['10'].avg_annual_wage,
                        ],
                        [
                            this.majorDataByMajor.bachelors['2'].avg_annual_wage,
                            this.majorDataByMajor.bachelors['5'].avg_annual_wage,
                            this.majorDataByMajor.bachelors['10'].avg_annual_wage,
                        ],
                        [
                            this.majorDataByMajor.someCollege['2'].avg_annual_wage,
                            this.majorDataByMajor.someCollege['5'].avg_annual_wage,
                            this.majorDataByMajor.someCollege['10'].avg_annual_wage,
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
