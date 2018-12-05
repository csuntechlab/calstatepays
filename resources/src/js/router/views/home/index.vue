<template>
	<div> 
		<home-banner/>
		<div class="container">
			<home-card/>
			<campus-seals/>
		</div>		
		<home-video/>
	</div>
</template>
<script>
import landingPageCarousel from "../../../components/global/landing-page-carousel";
import homeCard from "../../../components/home/home-card.vue"
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
		landingPageCarousel,
		homeCard,
		homeBanner,
		campusSeals,
		homeVideo
	}, 
	methods: {
		...mapActions(['setDataPage'])
	} 
};
</script>