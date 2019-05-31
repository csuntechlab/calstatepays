<template>
	<figure>
			<h3 class="sr-only" v-if='this.educationLevel === "allDegrees"'>All Degrees Level Data for {{ majorTitle }}</h3>
			<h3 class="sr-only" v-else-if='this.educationLevel == "postBacc"'>Post Bacc Level Data for {{ majorTitle }}</h3>
			<h3 class="sr-only" v-else-if='this.educationLevel == "bachelors"'>Bachelors Level Data for {{ majorTitle }}</h3>
			<h3 class="sr-only" v-else-if='this.educationLevel == "someCollege"'>Some College Level Data for {{ majorTitle }}</h3>
		<chart :options="polar" :aria-label='"Line Graph for " + majorTitle'></chart>
		<figcaption class="sr-only">
			<h4>Data Table</h4>
			<table>
				<thead class="table-header">
					<tr v-if='this.educationLevel === "allDegrees"'>
						<th>Years</th>
						<th>Post Bacc</th>
						<th>Bachelors</th>
						<th>Some College</th>
					</tr>
					<tr v-else>
						<th>Years</th>
						<th>75th</th>
						<th>50th</th>
						<th>25th</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(item, index) in majorData[0]" :key="index">
						<td v-if="index === 0">2</td>
						<td v-if="index === 1">5</td>
						<td v-if="index === 2">10</td>
						<td v-if="index === 3">15</td>
						<td v-for="(item, val) in majorData" :key="val">
							<template v-if=" majorData[val][index] !== null">
								${{ majorData[val][index] }}
							</template>
							<template v-else>
								No Data
							</template>
						</td>
					</tr>
				</tbody>
			</table>
		</figcaption>		
	</figure>
</template>
<script>
import ECharts from "vue-echarts/components/ECharts";
import "echarts/lib/chart/line";
import "echarts/lib/component/tooltip";
import "echarts/lib/component/title";
import "echarts/lib/component/legend";
import { mapGetters } from "vuex";
export default {
	props: ["majorData", "educationLevel", "windowWidth", "majorTitle"],
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
	components: {
		chart: ECharts
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
		mobileYAxis() {
			let currentWidth = window.innerWidth;
			if (currentWidth <= 750) {
				return 90;
			} else {
				return 0;
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
				color = "#EDAC17";
			}
			if (this.educationLevel === "postBacc") {
				color = "#55BE85";
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
						padding: [15, 0, 0, 0],
						fontSize: 14
					},
					data: this.xAxis,
					axisLabel: {
						fontSize: 14
					},
					axisTick: {
						show: false
					},
					axisLine: {
						show: false
					}
				},
				aria:{
					show: false,
					// description: 'line chart',
					general: {
						withTitle: 'A line Chart with annual earning for {title}.'
						// withoutTitle: 'A line Chart '
					},
					series: {
						multiple:{
							prefix: '',
							withName: '',
							separator: {
								middle: '',
								end: ''
							}
						},
						separator: {
							middle: '',
							end: ''
						}
					},
					data: {
						allData: '',
						withName: '{name} years out ${value}',
						separator: {
							end: '. '
						}
					}
				},
				yAxis: {
					name: 'Annual Salary',
					nameLocation: 'middle',
					nameTextStyle: {
						fontSize: 14,
						padding: [0, 0, 35, 0]
					},
					axisLabel: {
						rotate: this.mobileYAxis,
						formatter: function(value) {
							if (value > 999) {
								let strVal = value.toString();
								strVal = strVal.slice(0, -3);
								return "$" + strVal + "k";
							} else return "$" + value;
						},
						fontSize: 14
					},
					min: 0,
					max: 150000,
					axisLine: {
						show: false
					},
					splitNumber: 5,
					axisTick: {
						show: false
					}
				},
				series: [
					{
						type: "line",
						symbol: 'path://M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z',
						symbolSize: 13,
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
						symbol: 'square',
						symbolSize: 11,
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
						symbol: 'circle',
						symbolSize: 13,
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
	}
};
</script>
