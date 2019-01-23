<template>
	<div>
		<csu-data-img-banner>
			<h3 class="CSUDataImgBanner__dataTitle" slot="title">
				<span>Financial Return on Education</span>
			</h3>
			<p
				class="CSUDataImgBanner__dataCopy"
				slot="copy"
			>Education costs money and takes time. In return, it increases earnings after graduation. Financial return is an interest-rate-like number describing the monetary rewards to education that you can compare to financial investments.</p>
		</csu-data-img-banner>
		<sub-nav/>
		<div class="graphContent">
			<div class="container">
				<div class="row pt-md-2">
					<aside class="col-lg-3 col-12">
						<pfre-form/>
					</aside>
					<div class="col-lg-9 col-12">
						<pfre-progress class="bar-graph-card mt-md-3 mt-lg-0"/>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
import csuDataImgBanner from "../../../components/global/csu-data-img-banner";
import subNav from "../../../components/global/sub-nav.vue";
import card from "../../../components/global/card";
import pfreForm from "../../../components/pfre/pfre-form.vue";
import pfreInfo from "../../../components/pfre/pfre-info.vue";
import pfreProgress from "../../../components/pfre/pfre-progress.vue";
import { mapGetters } from "vuex";
export default {
	components: {
		csuDataImgBanner,
		card,
		pfreForm,
		pfreInfo,
		pfreProgress,
		subNav
	}
};
</script>