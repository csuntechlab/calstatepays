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
    props: ['index', 'yData'],
    data: function () {
        return {
            major: 'Applied Math',
        }
    },
    components: {
        'chart': ECharts
    },
    computed: {
        ...mapGetters([
            'majorsYears'
        ]),
    polar(){
        return {
            title: {
                text: this.major,
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
                data: this.majorsYears
            },
            legend: {
                data: ['line']
            },
            yAxis: {},
            series: [
            {
                type: 'line',
                name: 'Some College',
                data: this.yData[this.index + 0],
                lineStyle: {
                    color: '#2BAE67',
                    width: 4
                },
                itemStyle: {
                    color: '#2BAE67'
                },
            },
            {
                type: 'line',
                name: "Bachelor's Degree",
                data: this.yData[this.index + 1],
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
                name: 'Post Bacc Degree',
                data: this.yData[this.index + 2],
                lineStyle: {
                    color: '#D00D2D',
                    width: 4
                },
                itemStyle: {
                    color: '#D00D2D'
                }
            }
            ],
                animationDuration: 2000
            }
        }
  }
}
</script>