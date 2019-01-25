<template>
	<div>
		<power-banner/>
		<main class="row">
			<div class="container" style="min-height:100vh">
				<div class="row">
					<div class="col-12">
						<router-link to="research" class="returnToCampusSelection">
							<h2>
								<i class="fa fa-arrow-left"></i> Return to CSU Campus Selection
							</h2>
						</router-link>
					</div>
				</div>
				<div class="row">
					<div id="viz1541533460014" class="tableauPlaceholder text-center position-relative">
						<noscript>
							<a href="#">
								<img
									alt=" "
									src="https://public.tableau.com/static/images/CS/CSU7LaborMarketOutcomes-ByMajor/CSU7AggregareEarningsData/1_rss.png"
									style="border: none"
								>
							</a>
						</noscript>
						<object class="tableauViz" style="display:none;">
							<param name="host_url" value="https%3A%2F%2Fpublic.tableau.com%2F">
							<param name="embed_code_version" value="3">
							<param name="site_root" value>
							<param name="name" value>
							<param name="tabs" value="no">
							<param name="toolbar" value="yes">
							<param
								name="static_image"
								value="https://public.tableau.com/static/images//CSU7LaborMarketOutcomes-ByMajor/CSU7AggregareEarningsData/1.png"
							>
							<param name="animate_transition" value="yes">
							<param name="display_static_image" value="yes">
							<param name="display_spinner" value="yes">
							<param name="display_overlay" value="yes">
							<param name="display_count" value="yes">
						</object>
					</div>
				</div>
			</div>
		</main>
	</div>
</template>
<script>
import powerBanner from "../../../components/research/power-banner";
import { mapGetters } from "vuex";
export default {
	components: {
		powerBanner
	},
	beforeRouteEnter(to, from, next) {
		next(vm => {
			if (vm.tableauValue === "") {
				vm.$router.push("research");
			} else next();
		});
	},
	mounted() {
		this.$nextTick(function() {
			var divElement = document.getElementById("viz1541533460014");
			console.log(this.tableauValue);
			console.log(this.tableauServer);
			if (this.tableauValue === "" || this.tableauValue === null || this.tableauServer == null || this.tableauServer == "") {
				divElement.style.width = "1000px";
				divElement.style.height = "5rem";
				divElement.style.backgroundColor = "lightgray";
				var heading = document.createElement("h1");
				heading.innerText = "Tableau visual is not available";
				divElement.appendChild(heading);
			} else {
				var vizElement = divElement.getElementsByTagName("object")[0];
				vizElement.style.width = "1016px";
				vizElement.style.height = "991px";
				var scriptElement = document.createElement("script");
				scriptElement.src = this.tableauServer;
				vizElement.parentNode.insertBefore(scriptElement, vizElement);
				var vizEl = vizElement.getElementsByTagName("param");
				vizEl[3].value = this.tableauValue;
			}
		});
	},
	computed: {
		...mapGetters(["tableauValue","tableauServer"])
		
	}
};
</script>