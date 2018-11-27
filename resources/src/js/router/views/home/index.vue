<template>
	<div>
		<home-banner/>
		<campus-seals/>
		<home-video/>
	</div>
</template>
<script>
import landingPageCarousel from "../../../components/global/landing-page-carousel";
import csuSelector from "../../../components/global/csu-selector.vue";
import homeBanner from "../../../components/home/home-banner.vue";
import campusSeals from "../../../components/home/campus-seals.vue";
import homeVideo from "../../../components/home/home-video.vue";
import {mapActions} from 'vuex';
export default {
	data() {
		return {
			url: ""
		};
	},
	created() {
		this.url = window.baseUrl;
	},
	components: {
		csuSelector,
		landingPageCarousel,
		homeBanner,
		campusSeals,
		homeVideo
	}, 
	methods: {
		...mapActions(['setDataPage'])
	} 
};
</script>