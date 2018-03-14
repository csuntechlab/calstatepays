<template>
<chart :options="polar"></chart>
</template>
<script>
import ECharts from 'vue-echarts/components/ECharts';
import 'echarts/lib/chart/line';
import 'echarts/lib/component/tooltip';
import 'echarts/lib/component/title';
import 'echarts/lib/component/legend';
export default {
  data: function () {
    return {
        major: 'Applied Math',
        xData: ['2', '5', '10', '15']
    }
  },
  components: {
      'chart': ECharts
  },
  computed: {
      polar(){
         return {
                title: {
                    text: this.major,
                    textStyle: {
                        color: '#777777',
                    }
                },
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'cross'
                    }
                },
                xAxis: {
                    data: this.xData
                },
                legend: {
                    data: ['line']
                },
                yAxis: {},
                series: [
                        {
                    type: 'line',
                    name: 'Some College',
                    data: [20000, 33000, 38000, 41000],
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
                    data: [35000, 42000, 58000, 72000],
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
                    data: [65000, 85000, 92000, 99000],
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
<style>
.echarts {
  min-height: 500px;
  min-width: 100%;
  color: blue;
}
</style>