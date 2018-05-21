<template>
<chart :options="polar"></chart>
</template>
<script>
import ECharts from 'vue-echarts/components/ECharts';
import 'echarts/lib/chart/line';
import 'echarts/lib/component/tooltip';
import 'echarts/lib/component/title';
import 'echarts/lib/component/legend';
import { mapGetters } from 'vuex';
export default {
    props: ['majorDataSelected', 'majorId', 'educationLevel'],
    data(){
        return {
            xAxis: ['2', '5', '10'],
        }
    },
    components: {
        'chart': ECharts
    },
    computed: {
        ...mapGetters([
            'majorById'
        ]),
        mastersEarnings(){
            if(this.majorDataSelected.length > 0){
                return this.majorDataSelected[0];
            }
            return null;
        },
        bachelorsEarnings(){
            if(this.majorDataSelected.length > 0){
                return this.majorDataSelected[1];
            }
            return null;
        },
        someCollegeEarnings(){
            if(this.majorDataSelected.length > 0){
                return this.majorDataSelected[2];
            }
        return null;
        },
        selectedMajor(){
            if(this.majorId){
                return this.majorById(this.majorId);
            }  
            return null;
        },
        majorName(){
            if(this.selectedMajor){
                return this.selectedMajor.major;
            }
        },
        toolTipTitles1(){
            let title="Some College"
            if(this.educationLevel !== "allDegrees"){
                title="25th Percentile"
            }
            return title
        },
        toolTipTitles2(){
            let title="Bachelor's Degree"
            if(this.educationLevel !== "allDegrees"){
                title="50th Percentile"
            }
            return title
        },
        toolTipTitles3(){
            let title="Post Bacc"
            if(this.educationLevel !== "allDegrees"){
                title="75th Percentile"
            }
            return title
        },

        polar(){

            if(this.someCollegeEarnings){
                return {
                    title: {
                        text: this.majorName,
                    left: 'center',
                    textStyle: {
                        color: '#777777',
                        fontFamily: 'Montserrat',
                    }
                    },
                    tooltip: {
                        trigger: 'axis',
                        axisPointer: {
                            type: 'cross'
                        }
                    },
                    xAxis: {
                        data: this.xAxis
                    },
                    legend: {
                        data: ['line']
                    },
                    yAxis: {
                        max: 150000
                    },
                    series: [
                        {
                            type: 'line',
                            name: this.toolTipTitles1,
                            data: this.someCollegeEarnings,
                            lineStyle: {
                                color: '#476A6F',
                                width: 4
                            },
                            itemStyle: {
                                color: '#476A6F'
                            },
                        },
                        {
                            type: 'line',
                            name: this.toolTipTitles2,
                            data: this.bachelorsEarnings,
                            lineStyle: {
                                color: '#EDAC17',
                                width: 4
                            },
                            itemStyle: {
                                color: '#EDAC17'
                            }
                        },
                        {
                            type: 'line',
                            name:  this.toolTipTitles3,
                            data:  this.mastersEarnings,
                            lineStyle: {
                                color: '#279D5D',
                                width: 4
                            },
                            itemStyle: {
                                color: '#279D5D'
                            }
                        }
                    ],
                    animationDuration: 2000
                }
            }
            return null;
        }
  }
}
</script>
