<template>
	<div class="wrapper">
		<div class="row">
			<h1 class="pt-3 home__heading text-gray">FAQ</h1>
		</div>
		<div class="row">
			<div class="col col-md-9">
				<v-container>
					<v-layout row wrap>
						<v-flex xs12 lg5 mb-3>
							<v-expansion-panel popout>
								<v-expansion-panel-content>
									<div slot="header" >I can not find my CSU.</div>
									<div class="p-sm-4">The initial study relies on students enrolled at California State University, Northridge. We are currently working on collecting data for an additional six CSU campuses in the Greater Los Angeles Area.</div>
								</v-expansion-panel-content>
							</v-expansion-panel>
							<v-expansion-panel popout>
								<v-expansion-panel-content>
									<div slot="header">How many students were followed-up in this study?</div>
									<div class="p-sm-4">Over 95,000 students, all of whom entered CSU Northridge as first-time freshmen, transfer students, or post-baccalaureate students between 1995 and 2005.</div>
								</v-expansion-panel-content>
							</v-expansion-panel>
							<v-expansion-panel popout>
								<v-expansion-panel-content>
									<div slot="header">Were all students found?</div>
									<div class="p-sm-4">No. Only students who remained in California, and whose earnings were covered by Unemployment Insurance at 2, 5, and 10 years after education exit are included in the study. As a result, students who have moved out of state or are out of the labor market are excluded, as are those in the military, federal employment, or self-employed. Further, the study population was limited to students who, in any given period, had no more than two (2) consecutive quarters without reported earnings. You can view a copy of the All University Earnings Data report (.pdf), which includes the percentage of students found during the study.</div>
								</v-expansion-panel-content>
							</v-expansion-panel>
							<v-expansion-panel popout>
								<v-expansion-panel-content>
									<div slot="header">I can not find my major.</div>
									<div class="p-sm-4">Only majors pursued by more than a minimum number of students are reported. Furthermore, newly added or modified majors have not been pursued by students who entered before 2005.</div>
								</v-expansion-panel-content>
							</v-expansion-panel>
							<v-expansion-panel popout>
								<v-expansion-panel-content>
									<div slot="header">I can not find an industry I’m interested in.</div>
									<div class="p-sm-4">Employment data are provided by industry, in keeping with 2-digit North American Industry Classification System (NAICS) classifications, rather than by occupation. Only industries employing a minimum number of students are reported.</div>
								</v-expansion-panel-content>
							</v-expansion-panel>
							<v-expansion-panel popout>
								<v-expansion-panel-content>
									<div slot="header">Are lapses in employment included?</div>
									<div class="p-sm-4">Yes. However, individuals who have more than two (2) consecutive quarters without earnings in a given time period are excluded from consideration.</div>
								</v-expansion-panel-content>
							</v-expansion-panel>
							<v-expansion-panel popout>
								<v-expansion-panel-content>
									<div slot="header">What does "After Education Exit" mean?</div>
									<div class="p-sm-4">"After Education Exit" indicates that students were no longer enrolled in a college or university at the time of the study, regardless of whether they had completed a degree.</div>
								</v-expansion-panel-content>
							</v-expansion-panel>
						</v-flex>
						<v-flex xs12 lg5 offset-lg2>
							<v-expansion-panel popout>
								<v-expansion-panel-content>
									<div slot="header">What does "Some College" mean?</div>
									<div class="p-sm-4">"Some College" indicates that a student attended the university in question, but has yet to complete a four-year degree anywhere.</div>
								</v-expansion-panel-content>
							</v-expansion-panel>
							<v-expansion-panel popout>
								<v-expansion-panel-content>
									<div slot="header">What does "Data Not Available" mean?</div>
									<div class="p-sm-4">"Data Not Available" indicates that we were not able to find any data for the major or industry at the time of the initial study.</div>
								</v-expansion-panel-content>
							</v-expansion-panel>
							<v-expansion-panel popout>
								<v-expansion-panel-content>
									<div slot="header">Do the Master’s Degree data include all Bachelor’s Degree recipients?</div>
									<div class="p-sm-4">No. The Master’s Degree data are confined to Bachelor’s Degree recipients who went on to pursue and complete a post-baccalaureate degree or certificate. Further, such degree recipients have been removed from the earnings data for the Bachelor’s Degree recipients.</div>
								</v-expansion-panel-content>
							</v-expansion-panel>
							<v-expansion-panel popout>
								<v-expansion-panel-content>
									<div slot="header">Why are the annual earnings data of Master’s Degree recipients in the same degree field lower than those shown for Some College and/or Bachelor's Degree recipients in some cases?</div>
									<div class="p-sm-4">When the number of students in any given subgroup is quite small, their average earnings can be misleading. As a result, they may appear to be lower than those of students with less advanced degrees.</div>
								</v-expansion-panel-content>
							</v-expansion-panel>
							<v-expansion-panel popout>
								<v-expansion-panel-content>
									<div slot="header">Are the earnings shown adjusted for inflation?</div>
									<div class="p-sm-4">Yes, they are adjusted to 2012 dollars.</div>
								</v-expansion-panel-content>
							</v-expansion-panel>
							<v-expansion-panel popout>
								<v-expansion-panel-content>
									<div slot="header">Where did the earnings data come from?</div>
									<div class="p-sm-4">Earnings are reported for California workers whose earnings are covered by Unemployment Insurance at 2, 5, and 10 years after education exit. As a result, students who have moved out of state or are out of the labor market are excluded, as are those in the military, federal employment, or self-employed.</div>
								</v-expansion-panel-content>
							</v-expansion-panel>
						</v-flex>
					</v-layout>
				</v-container>

			</div>
		</div>
	</div>
</template>
<script>
	export default {
	}
</script>