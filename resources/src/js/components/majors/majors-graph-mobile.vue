<template>
<chart style="width: 0" :initOptions="chartDimensions" :options="polar"></chart>
</template>
<script>
import ECharts from 'vue-echarts/components/ECharts';
import 'echarts/lib/chart/line';
import 'echarts/lib/component/tooltip';
import 'echarts/lib/component/title';
import 'echarts/lib/component/legend';
import { mapGetters } from 'vuex';
export default {
    props: ['majorData', 'educationLevel', 'majorId', 'windowWidth'],
    data(){
        return {
            xAxis: ['2', '5', '10'],
            graphColors: {
               color1: '#000',
               color2: '#000',
               color3: '#FFF',
            },
        }
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
        chartDimensions(){
            let currentWidth = window.innerWidth;
            if(this.windowWidth >= 1001) {
                return {
                    height: 400,
                    width: this.windowWidth * .42
                }
               
            }
            else if(this.windowWidth >= 750 && this.windowWidth <= 1000) {
                return {
                    height: 400,
                    width: this.windowWidth - 200
                }
            }
            else {
              return {
                    height: 400,
                    width: this.windowWidth - 125,
                }  
            }
        },
        majorName(){
            if(this.majorData.length > 0){
                return this.$store.getters.majorNameById(this.majorId);
            }
            return null;
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
                    color='#7E969A'
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
                    color='#2c4144'
                }
                if(this.educationLevel === 'bachelors'){
                    color='#987100'
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
                    fontWeight: '600',
                    color: "#777"
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
                    axisLabel: {
                        rotate: 90,
                        formatter: function (value){
                            if(value > 999){
                                let strVal = value.toString();
                                strVal = strVal.slice(0,-3);
                                return '$' + strVal + 'k';
                            }
                            else
                                return '$' + value;
                        }
                    },
                    max: 150000
                },
                series: [
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
                        name: this.toolTipTitles1,
                        data: this.someCollegeEarnings,
                        lineStyle: {
                            color: this.toolColors1,
                            width: 4
                        },
                        itemStyle: {
                            color: this.toolColors1
                        },
                    }
                ],
                animationDuration: 2000
            }
            return null;
        }
    },
    components: {
        'chart': ECharts
    },
}
</script>
