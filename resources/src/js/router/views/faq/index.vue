<template>
	<div>
		<div class="banner faq-banner align-items-center">
			<h1 class="home__heading faq-header">Frequently Asked Questions</h1>
		</div>
		<div class="container">
			<div class="row justify-content-start align-items-center">		
				<v-expansion-panel popout class="col-12 col-lg-6 px-3">
					<v-expansion-panel-content>
						<div slot="header" >I can not find my CSU.</div>
						<div class="p-sm-4 faq-panel">The initial study relies on students enrolled at California State University, Northridge. We are currently working on collecting data for an additional six CSU campuses in the Greater Los Angeles Area.</div>
					</v-expansion-panel-content>
				</v-expansion-panel>
				<v-expansion-panel popout class="col-12 col-lg-6 px-3">
					<v-expansion-panel-content>
						<div slot="header">How many students were followed-up in this study?</div>
						<div class="p-sm-4 faq-panel">Over 600,000 students, all of whom entered one of the seven participating CSU campuses as first-time freshmen, transfer students, or post-baccalaureate students between 1995 and 2014.</div>
					</v-expansion-panel-content>
				</v-expansion-panel>
				<v-expansion-panel popout class="col-12 col-lg-6 px-3">
					<v-expansion-panel-content>
						<div slot="header">Were all students found?</div>
						<div class="p-sm-4 faq-panel">No. Only students who remained in California, and whose earnings were covered by Unemployment Insurance at 2, 5, and 10 years after education exit are included in the study. As a result, students who have moved out of state or are out of the labor market are excluded, as are those in the military, federal employment, or self-employed. Further, the study population was limited to students who, in any given period, had no more than two (2) consecutive quarters without reported earnings. You can view a copy of the All University Earnings Data report (.pdf), which includes the percentage of students found during the study.</div>
					</v-expansion-panel-content>
				</v-expansion-panel>
				<v-expansion-panel popout class="col-12 col-lg-6 px-3">
					<v-expansion-panel-content>
						<div slot="header">I can not find my major.</div>
						<div class="p-sm-4 faq-panel">Only majors pursued by more than a minimum number of students are reported.</div>
					</v-expansion-panel-content>
				</v-expansion-panel>
				<v-expansion-panel popout class="col-12 col-lg-6 px-3">
					<v-expansion-panel-content>
						<div slot="header">I can not find an industry I’m interested in.</div>
						<div class="p-sm-4 faq-panel">Employment data are provided by industry, in keeping with 2-digit North American Industry Classification System (NAICS) classifications, rather than by occupation. Only industries employing a minimum number of students are reported.</div>
					</v-expansion-panel-content>
				</v-expansion-panel>
				<v-expansion-panel popout class="col-12 col-lg-6 px-3">
					<v-expansion-panel-content>
						<div slot="header">Are lapses in employment included?</div>
						<div class="p-sm-4 faq-panel">Yes. However, individuals who have more than two (2) consecutive quarters without earnings in a given time period are excluded from consideration.</div>
					</v-expansion-panel-content>
				</v-expansion-panel>
				<v-expansion-panel popout class="col-12 col-lg-6 px-3">
					<v-expansion-panel-content>
						<div slot="header">What does "After Education Exit" mean?</div>
						<div class="p-sm-4 faq-panel">"After Education Exit" indicates that students were no longer enrolled in a college or university at the time of the study, regardless of whether they had completed a degree.</div>
					</v-expansion-panel-content>
				</v-expansion-panel>
				<v-expansion-panel popout class="col-12 col-lg-6 px-3">
					<v-expansion-panel-content>
						<div slot="header">What does "Some College" mean?</div>
						<div class="p-sm-4 faq-panel">"Some College" indicates that a student attended the university in question, but has yet to complete a four-year degree anywhere.</div>
					</v-expansion-panel-content>
				</v-expansion-panel>
				<v-expansion-panel popout class="col-12 col-lg-6 px-3">
					<v-expansion-panel-content>
						<div slot="header">What does "Data Not Available" mean?</div>
						<div class="p-sm-4 faq-panel">"Data Not Available" indicates that we were not able to find any data for the major or industry at the time of the initial study.</div>
					</v-expansion-panel-content>
				</v-expansion-panel>
				<v-expansion-panel popout class="col-12 col-lg-6 px-3">
					<v-expansion-panel-content>
						<div slot="header">Do the Master’s Degree data include all Bachelor’s Degree recipients?</div>
						<div class="p-sm-4 faq-panel">No. The Master’s Degree data are confined to Bachelor’s Degree recipients who went on to pursue and complete a post-baccalaureate degree or certificate. Further, such degree recipients have been removed from the earnings data for the Bachelor’s Degree recipients.</div>
					</v-expansion-panel-content>
				</v-expansion-panel>
				<v-expansion-panel popout class="col-12 col-lg-6 px-3">
					<v-expansion-panel-content>
						<div slot="header">Why are the annual earnings data of Master’s Degree recipients in the same degree field lower than those shown for Some College and/or Bachelor's Degree recipients in some cases?</div>
						<div class="p-sm-4 faq-panel">When the number of students in any given subgroup is quite small, their average earnings can be misleading. As a result, they may appear to be lower than those of students with less advanced degrees.</div>
					</v-expansion-panel-content>
				</v-expansion-panel>
				<v-expansion-panel popout class="col-12 col-lg-6 px-3">
					<v-expansion-panel-content>
						<div slot="header">Are the earnings shown adjusted for inflation?</div>
						<div class="p-sm-4 faq-panel">Yes, they are adjusted to 2016 dollars.</div>
					</v-expansion-panel-content>
				</v-expansion-panel>
				<v-expansion-panel popout class="col-12 col-lg-6 px-3">
					<v-expansion-panel-content>
						<div slot="header">Where did the earnings data come from?</div>
						<div class="p-sm-4 faq-panel">Earnings are reported for California workers whose earnings are covered by Unemployment Insurance at 2, 5, and 10 years after education exit. As a result, students who have moved out of state or are out of the labor market are excluded, as are those in the military, federal employment, or self-employed.</div>
					</v-expansion-panel-content>
				</v-expansion-panel>
				<v-expansion-panel popout class="col-12 col-lg-6 px-3">
					<v-expansion-panel-content>
						<div slot="header">What factors affect your personal financial return?</div>
						<div class="p-sm-4 faq-panel">Your PFRE changes when:
							<ul class="pt-4">
								<li>The younger you start, the longer you get higher post-graduation earnings--increasing PFRE.</li>
								<li>The more you could earn without a Bachelor's Degree, the more post-graduation income you give up to get it--decreasing PFRE.</li>
								<li>The more you earn while obtaining a Bachelor's Degree, the less income you give up to get it--increasing PFRE.</li>
								<li>The more financial aid money you receive (excluding loans), the less you pay to get a Bachelor's Degree--increasing PFRE.</li>
								<li>The longer it takes you to graduate, the higher your education costs--decreasing PFRE.</li>
								<li>Majors that produce higher post-graduation earnings will get a higher PFRE.</li>
							</ul>
						</div>
					</v-expansion-panel-content>
				</v-expansion-panel>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
	}
</script>
