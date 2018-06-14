<template>
    <div>
        <majors-graph-mobile v-if="isMobile" :majorData="parsedMajorData" :educationLevel="this.educationLevel" :majorId="majorData.majorId" :windowWidth="windowWidth"></majors-graph-mobile>
        <majors-graph v-else :majorData="parsedMajorData" :educationLevel="this.educationLevel" :majorId="majorData.majorId" :windowWidth="windowWidth"></majors-graph>
    </div>
</template>

<script>
    import majorsGraph from './majors-graph.vue';
    import majorsGraphMobile from './majors-graph-mobile.vue';    

    export default {
        props: ['majorData', 'educationLevel', 'windowWidth'],
        computed: {
            isMobile() {
                return this.windowWidth < 800 ? true : false;
            },
            parsedMajorData() {
                if(this.majorData.length == 0) {
                    return []
                }
                if(this.educationLevel == "allDegrees") {
                    return [
                        [
                            this.majorData.postBacc['2'].avg_annual_wage,
                            this.majorData.postBacc['5'].avg_annual_wage,
                            this.majorData.postBacc['10'].avg_annual_wage,
                        ],
                        [
                            this.majorData.bachelors['2'].avg_annual_wage,
                            this.majorData.bachelors['5'].avg_annual_wage,
                            this.majorData.bachelors['10'].avg_annual_wage,
                        ],
                        [
                            this.majorData.someCollege['2'].avg_annual_wage,
                            this.majorData.someCollege['5'].avg_annual_wage,
                            this.majorData.someCollege['10'].avg_annual_wage,
                        ],
                    ]
                } else {
                    return [
                        [
                            this.majorData[this.educationLevel]['2']._75th,
                            this.majorData[this.educationLevel]['5']._75th,
                            this.majorData[this.educationLevel]['10']._75th,
                        ],
                        [
                            this.majorData[this.educationLevel]['2']._50th,
                            this.majorData[this.educationLevel]['5']._50th,
                            this.majorData[this.educationLevel]['10']._50th,
                        ],
                        [
                            this.majorData[this.educationLevel]['2']._25th,
                            this.majorData[this.educationLevel]['5']._25th,
                            this.majorData[this.educationLevel]['10']._25th,
                        ],
                    ]
                }
            }
        },
        components: {
            majorsGraph,
            majorsGraphMobile
        }
    }
</script>