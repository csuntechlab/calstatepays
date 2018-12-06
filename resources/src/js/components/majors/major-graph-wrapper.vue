<template>
    <div>
        <majors-graph-mobile v-if="isMobile" :majorData="parsedMajorData" :educationLevel="this.educationLevel" :windowWidth="windowWidth" style="width:auto"/>
        <majors-graph v-else :majorData="parsedMajorData" :educationLevel="this.educationLevel" :windowWidth="windowWidth"/>
    </div>
</template>

<script>
    import majorsGraph from './majors-graph.vue';
    import majorsGraphMobile from './majors-graph-mobile.vue';    

    export default {
        props: ['majorData', 'educationLevel', 'windowWidth'],
        computed: {
            isMobile() {
                return this.windowWidth < 1000 ? true : false;
            },
            parsedMajorData() {
                if(this.majorData.length == 0) {
                    return []
                }
                if(this.educationLevel == "allDegrees") {
                    return [
                        [
                            this.majorData.postBacc['2']._50th,
                            this.majorData.postBacc['5']._50th,
                            this.majorData.postBacc['10']._50th,
                            this.majorData.postBacc['15']._50th,
                        ],
                        [
                            this.majorData.bachelors['2']._50th,
                            this.majorData.bachelors['5']._50th,
                            this.majorData.bachelors['10']._50th,
                            this.majorData.bachelors['15']._50th,
                        ],
                        [
                            this.majorData.someCollege['2']._50th,
                            this.majorData.someCollege['5']._50th,
                            this.majorData.someCollege['10']._50th,
                            this.majorData.someCollege['15']._50th,
                        ],
                    ]
                } else {
                    return [
                        [
                            this.majorData[this.educationLevel]['2']._75th,
                            this.majorData[this.educationLevel]['5']._75th,
                            this.majorData[this.educationLevel]['10']._75th,
                            this.majorData[this.educationLevel]['15']._75th,
                        ],
                        [
                            this.majorData[this.educationLevel]['2']._50th,
                            this.majorData[this.educationLevel]['5']._50th,
                            this.majorData[this.educationLevel]['10']._50th,
                            this.majorData[this.educationLevel]['15']._50th,
                        ],
                        [
                            this.majorData[this.educationLevel]['2']._25th,
                            this.majorData[this.educationLevel]['5']._25th,
                            this.majorData[this.educationLevel]['10']._25th,
                            this.majorData[this.educationLevel]['15']._25th,
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