<template>
	<chart :initOptions="chartDimensions" :options="polar"></chart>
</template>

<script>
import ECharts from "vue-echarts/components/ECharts";
import "echarts/lib/chart/line";
import "echarts/lib/component/tooltip";
import "echarts/lib/component/title";
import "echarts/lib/component/legend";
import { mapGetters } from "vuex";
export default {
	props: ["majorData", "educationLevel", "windowWidth"],
	data() {
		return {
			xAxis: ["2", "5", "10", "15"],
			graphColors: {
				color1: "#000",
				color2: "#000",
				color3: "#FFF"
			}
		};
	},
	computed: {
		mastersEarnings() {
			if (this.majorData.length > 0) {
				return this.majorData[0];
			}
			return null;
		},
		bachelorsEarnings() {
			if (this.majorData.length > 0) {
				return this.majorData[1];
			}
			return null;
		},
		someCollegeEarnings() {
			if (this.majorData.length > 0) {
				return this.majorData[2];
			}
			return null;
		},
		chartDimensions() {
			let currentWidth = window.innerWidth;
			if (this.windowWidth >= 768 && this.windowWidth < 1000) {
				return {
					height: 400,
					width: 710
					// width: this.windowWidth / 1.75
				};
			} else if (this.windowWidth >= 540 && this.windowWidth < 768) {
				return {
					height: 400,
					width: 490
				};
			} else {
				return {
					height: 400,
					width: this.windowWidth - 48
					// width: document.getElementById('majorCardHasIndex-0').clientWidth - 35,
				};
			}
		},
		toolTipTitles1() {
			let title = "Some College";
			if (this.educationLevel !== "allDegrees") {
				title = "25th Percentile";
			}
			return title;
		},
		toolTipTitles2() {
			let title = "Bachelor's Degree";
			if (this.educationLevel !== "allDegrees") {
				title = "50th Percentile";
			}
			return title;
		},
		toolTipTitles3() {
			let title = "Post Bacc";
			if (this.educationLevel !== "allDegrees") {
				title = "75th Percentile";
			}
			return title;
		},
		toolColors1() {
			let color = "#476A6F";
			if (this.educationLevel === "someCollege") {
				color = "#7E969A";
			}
			if (this.educationLevel === "bachelors") {
				color = "#F2C55C";
			}
			if (this.educationLevel === "postBacc") {
				color = "#3EFA94";
			}
			return color;
		},
		toolColors2() {
			let color = "#EDAC17";
			if (this.educationLevel === "someCollege") {
				color = "#476A6F";
			}
			if (this.educationLevel === "bachelors") {
				color = "#ECA400";
			}
			if (this.educationLevel === "postBacc") {
				color = "#2BAE67";
			}
			return color;
		},
		toolColors3() {
			let color = "#279D5D";
			if (this.educationLevel === "someCollege") {
				color = "#2c4144";
			}
			if (this.educationLevel === "bachelors") {
				color = "#987100";
			}
			if (this.educationLevel === "postBacc") {
				color = "#1B6E41";
			}
			return color;
		},
		polar() {
			return {
				tooltip: {
					trigger: "axis",
					axisPointer: {
						type: "cross"
					},
					position: function(pos, params, dom, rect, size) {
						// tooltip will be fixed on the right if mouse hovering on the left,
						// and on the left if hovering on the right.
						var obj = { top: "10%" };
						obj[
							["left", "right"][+(pos[0] < size.viewSize[0] / 2)]
						] = 5;
						return obj;
					},
					formatter: function(params) {
						var colorSpan = color =>
							'<span style="display:inline-block;margin-right:5px;border-radius:10px;width:9px;height:9px;background-color:' +
							color +
							'"></span>';
						let rez =
							"<h6>" + params[0].axisValue + " Years Out</h6>";
						params.forEach(item => {
							let val = "";
							//format data
							if (item.data > 999) {
								let strVal = item.data.toString();
								let first = strVal.slice(0, -3);
								let second = strVal.slice(-3);
								val = "$" + first + "," + second;
							} else if (item.data === null) val = "No Data";
							else val = "$" + item.data;

							var xx =
								"<h6>" +
								colorSpan(item.color) +
								" " +
								item.seriesName +
								": " +
								val +
								"</h6>";
							rez += xx;
						});
						return rez;
					}
				},
				xAxis: {
					name: "Years Out of College",
					nameLocation: "middle",
					nameTextStyle: {
						padding: [10, 0, 0, 0]
					},
					data: this.xAxis,
					axisTick: {
						show: false
					},
					axisLine: {
						show: false
					}
				},
				toolbox: {show: true},
				name: "Years Out of College",
				nameLocation: "middle",
				nameTextStyle: {
					padding: [10, 0, 0, 0]
				},
				legend: {
					data: ["line"]
				},
				yAxis: {
					axisLabel: {
						rotate: 90,
						formatter: function(value) {
							if (value > 999) {
								let strVal = value.toString();
								strVal = strVal.slice(0, -3);
								return "$" + strVal + "k";
							} else return "$" + value;
						}
					},
					splitNumber: 5,
					min: 0,
					max: 150000,
					splitLine: {
						show: true
					},

					axisTick: {
						show: false
					},
					axisLine: {
						show: false
					}
				},
				series: [
					{
						type: "line",
						name: this.toolTipTitles3,
						data: this.mastersEarnings,
						lineStyle: {
							color: this.toolColors3,
							width: 4
						},
						itemStyle: {
							color: this.toolColors3
						}
					},
					{
						type: "line",
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
						type: "line",
						name: this.toolTipTitles1,
						data: this.someCollegeEarnings,
						lineStyle: {
							color: this.toolColors1,
							width: 4
						},
						itemStyle: {
							color: this.toolColors1
						}
					}
				],
				animationDuration: 2000
			};
			return null;
		}
	},
	components: {
		chart: ECharts
	}
};
</script>