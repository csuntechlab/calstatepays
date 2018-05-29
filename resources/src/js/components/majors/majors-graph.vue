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
    props: ['majorData', 'educationLevel'],
    data(){
        return {
            xAxis: ['2', '5', '10'],
            graphColors: {
               color1: '#000',
               color2: '#000',
               color3: '#FFF',
            }
        }
    },
    components: {
        'chart': ECharts
    },
    computed: {
        mastersEarnings(){
            if(this.majorData.length > 0){
                return this.majorData[0];
            }
            return null;
        },
        bachelorsEarnings(){
            if(this.majorData.length > 0){
                return this.majorData[1];
            }
            return null;
        },
        someCollegeEarnings(){
            if(this.majorData.length > 0){
                return this.majorData[2];
            }
            return null;
        },
        majorName(){
            return "Testarino";
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
        toolColors1(){
            let color='#476A6F'
                if(this.educationLevel === 'someCollege'){
                    color='#A1F0FB'
                }
                if(this.educationLevel === 'bachelors'){
                    color='#F2C55C'
                }
                if(this.educationLevel === 'postBacc'){
                    color='#3EFA94'
                }
            return color
        },
        toolColors2(){
            let color='#EDAC17'
                if(this.educationLevel === 'someCollege'){
                    color='#476A6F'
                }
                if(this.educationLevel === 'bachelors'){
                    color='#ECA400'

                }
                if(this.educationLevel === 'postBacc'){
                    color='#2BAE67'

                }
            return color
        },
        toolColors3(){
            let color='#279D5D'
                if(this.educationLevel === 'someCollege'){
                    color='#375255'
                }
                if(this.educationLevel === 'bachelors'){
                    color='#6C4B00'
                }
                if(this.educationLevel === 'postBacc'){
                    color='#1B6E41'
                }
            return color
        },

        polar(){
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
                            color: this.toolColors1,
                            width: 4
                        },
                        itemStyle: {
                            color: this.toolColors1
                        },
                    },
                    {
                        type: 'line',
                        name: this.toolTipTitles2,
                        data: this.bachelorsEarnings,
                        lineStyle: {
                            color: this.toolColors2,
                            width: 4
                        },
                        itemStyle: {
                            color: this.toolColors2
                        }
                    },
                    {
                        type: 'line',
                        name:  this.toolTipTitles3,
                        data:  this.mastersEarnings,
                        lineStyle: {
                            color: this.toolColors3,
                            width: 4
                        },
                        itemStyle: {
                            color: this.toolColors3
                        }
                    }
                ],
                animationDuration: 2000
            }
            return null;
        }
  }
}
</script>
